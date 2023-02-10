@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
    <div class="top_area w-75 m-auto pt-5">
        <p class="title">
            <span>{{ $user->over_name }}</span>
            <span class="ml-1">{{ $user->under_name }}さんのプロフィール</span>
        </p>
        <div class="user_status p-3">
            <div class="d-flex">
                <p>名前：</p>
                <span>{{ $user->over_name }}</span>
                <span class="ml-1">{{ $user->under_name }}</span>
            </div>
            <div class="d-flex">
                <p>カナ：</p>
                <span>{{ $user->over_name_kana }}</span>
                <span class="ml-1">{{ $user->under_name_kana }}</span>
            </div>
            <div class="d-flex">
                <p>性別：</p>
                @if($user->sex == 1)
                <span>男</span>
                @else
                <span>女</span>
                @endif
            </div>
            <div class="d-flex">
                <p>生年月日：</p>
                <span>{{ $user->birth_day }}</span>
            </div>
            <div class="d-flex">
                <p>選択科目：</p>
                @foreach($user->subjects as $subject)
                <span>{{ $subject->subject }}</span>
                @endforeach
            </div>
            <div class="d-flex">
                @can('admin')
                <span class="subject_edit_btn ml-3 mr-5">選択科目の編集</span>
                <div class="subject_inner">
                    <div class="d-flex">
                        <div>
                            @foreach($subject_lists as $subject_list)
                            <div class="one_subject">
                                <label class="mb-0 mt-2 mx-2" for="{{ $subject_list->id }}">{{ $subject_list->subject }}</label>
                                <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}" id="{{ $subject_list->id }}">
                            </div>
                            @endforeach
                        </div>
                        <div class="ml-5 mt-auto mb-0">
                            <input type="submit" value="編集" class="btn btn-primary py-0 px-1" style="font-size:small;">
                        </div>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <form action="{{ route('user.edit') }}" method="post">{{ csrf_field() }}</form>
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>

@endsection
