@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
    <div class="post_view w-75 mt-5">
        <p class="w-75 m-auto pb-3 title">投稿一覧</p>
        <div class="post_area m-auto w-75">
            @foreach($posts as $post)
            <div class="border-bottom p-3 post_individual">
                <p class="contributor">
                    <span>{{ $post->user->over_name }}</span>
                    <span class="ml-3">{{ $post->user->under_name }}</span>
                    さん
                </p>
                <p class="post_title">
                    <a class="post_a" href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a>
                </p>
                <div class="post_bottom_area d-flex">
                    <div class="">
                        @foreach($post->subCategories as $sub_category)
                        <p class='category_btn'>{{ $sub_category->sub_category}}</p>
                        @endforeach
                    </div>
                    <div class="d-flex post_status">
                        <div class="mr-5">
                            <i class="fa fa-comment"></i>
                            <span class="comment_counts{{$post->id}}">{{ \App\Models\Posts\PostComment::where('post_id',$post->id)->count() }}</span>
                        </div>
                        <div>
                            @if(Auth::user()->is_Like($post->id))
                            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ \App\Models\Posts\Like::where('like_post_id',$post->id)->count() }}</span></p>
                            @else
                            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ \App\Models\Posts\Like::where('like_post_id',$post->id)->count() }}</span></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="other_area border w-25">
        <div class="m-4 p-2">
            <div class="post_btn mt-3">
                <button class="w-100 mb-3 p-1"><a class="d-block w-100" href="{{ route('post.input') }}">投稿</a></button>
            </div>
            <div class="mb-3 d-flex" style="height: 45px;">
                <input class="w-75 mr-1" type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
                <!-- <input class="w-25" type="submit" value="検索" form="postSearchRequest"> -->
                <button type="submit" class="w-25 btn btn-primary ml-1" form="postSearchRequest">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
            <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
            <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
            <ul class="mt-3">
                @foreach($categories as $category)
                <li class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}<span></li>
                <div class="">
                    @foreach($sub_categories as $sub_category)
                    @if($category->id == $sub_category->main_category_id)
                    <input type="submit" name="category_word" class='category_btn ml-3' value="{{ $sub_category->sub_category }}" form="postSearchRequest"></input><br>
                    @endif
                    @endforeach
                </div>
                @endforeach
            </ul>
        </div>
    </div>
    <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
