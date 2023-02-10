@extends('layouts.sidebar')

@section('content')
<div class="post_create_container d-flex">
    <div class="post_create_area border w-50 m-5 p-5">
        <div class="">
        <p class="mb-0">カテゴリー</p>
        <select class="w-100" form="postCreate" name="post_category_id">
            @foreach($main_categories as $main_category)
            <optgroup label="{{ $main_category->main_category }}"></optgroup>
            <!-- サブカテゴリー表示 -->
                @foreach($sub_categories as $sub_category)
                @if($main_category->id == $sub_category->main_category_id)
                <option label="{{ $sub_category->sub_category }}"  value="{{ $sub_category->id }}"></option>
                @endif
                @endforeach
            @endforeach
        </select>
        @if($errors->first('post_category_id'))
        <span class="error_message">{{ $errors->first('post_category_id') }}</span>
        @endif
        </div>
        <div class="mt-3">
            <p class="mb-0">タイトル</p>
            <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
            @if($errors->first('post_title'))
            <span class="error_message">{{ $errors->first('post_title') }}</span>
            @endif
        </div>
        <div class="mt-3">
            <p class="mb-0">投稿内容</p>
            <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
            @if($errors->first('post_body'))
            <span class="error_message">{{ $errors->first('post_body') }}</span>
            @endif
        </div>
        <div class="mt-3 text-right">
        <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
        </div>
        <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
    </div>
    @can('admin')
    <div class="w-25 ml-auto mr-auto">
        <div class="category_area mt-5 p-5">
            <div class="">
                <p class="m-0">メインカテゴリー</p>
                <input type="text" class="w-100" name="main_category_name" form="mainCategoryRequest">
                <input type="submit" value="追加" class="w-100 btn btn-primary py-1 mb-3 mt-1" form="mainCategoryRequest">
            </div>
            @if($errors->first('main_category_name'))
            <span class="error_message">{{$errors->first('main_category_name')}}</span><br>
            @endif
            <form action="{{ route('main.category.create') }}" method="post" id="mainCategoryRequest">{{ csrf_field() }}</form>
            <!-- サブカテゴリー追加 -->
            <div>
                <p class="m-0">サブカテゴリー</p>
                <select class="w-100" form="subCategoryRequest" name="main_category_id">
                @foreach($main_categories as $main_category)
                <option label="{{ $main_category->main_category }}" value="{{ $main_category->id }}"></option>
                @endforeach
                </select>
                @if($errors->first('main_category_id'))
                <span class="error_message">{{$errors->first('main_category_id')}}</span><br>
                @endif
                <input type="text" class="w-100" name="sub_category_name" form="subCategoryRequest">
                @if($errors->first('sub_category_name'))
                <span class="error_message">{{$errors->first('sub_category_name')}}</span><br>
                @endif
                <input type="submit" value="追加" class="w-100 btn btn-primary py-1 mt-1" form="subCategoryRequest">
            </div>
            <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">{{ csrf_field() }}</form>
        </div>
    </div>
    @endcan
</div>
@endsection
