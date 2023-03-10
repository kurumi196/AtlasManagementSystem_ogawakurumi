<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments','subCategories')->get();
        $categories = MainCategory::get();
        $sub_categories=SubCategory::get();
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            $posts = Post::with('user', 'postComments','subCategories')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhereHas('subCategories',function($q)use($request){
                $q->where('sub_category',$request->keyword);
            })
            ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
        }else if($request->category_word){
            $category_word = $request->category_word;
            $posts = Post::with('user', 'postComments','subCategories')->whereHas('subCategories',function($q)use($category_word){
                $q->where('sub_category',$category_word);
            })->get();
        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments','subCategories')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments','subCategories')
            ->where('user_id', Auth::id())->get();
        }
        // dd($posts);
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories','sub_categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        $sub_category=$post->subCategories()->first();
        return view('authenticated.bulletinboard.post_detail', compact('post','sub_category'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        $sub_categories=SubCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories','sub_categories'));
    }

    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);
        $this->validate($request,[
            'post_category_id'=>'required|exists:sub_categories,id']);
        $post_category_id=$request->post_category_id;
        $sub_category = Post::findOrFail($post->id);
        $sub_category->subCategories()->attach($post_category_id);
        return redirect()->route('post.show');
    }

    public function postEdit(PostFormRequest $request){
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    public function mainCategoryCreate(Request $request){
        $this->validate($request,['main_category_name'=>'required|max:100|string|unique:main_categories,main_category']);
        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }

    public function subCategoryCreate(Request $request){
        $this->validate($request,[
            'main_category_id'=>'required|exists:main_categories,id',
            'sub_category_name'=>'required|max:100|string|unique:sub_categories,sub_category']);
        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category_name]);
        return redirect()->route('post.input');
    }

    public function commentCreate(Request $request){
        $this->validate($request,[
            'comment'=>'required|string|max:2500']);
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        Auth::user()->likes()->attach($request->post_id);
        return response()->json();
    }

    public function postUnLike(Request $request){
        Auth::user()->likes()->detach($request->post_id);
        return response()->json();
    }
}
