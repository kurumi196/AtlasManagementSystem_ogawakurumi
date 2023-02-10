@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 d-flex pl-3">
    <div class="w-75">
        <p class="w-100 title">ユーザー検索</p>
        <div class="w-100 reserve_users_area">
            @foreach($users as $user)
            <div class="border one_person pt-4">
                <div class="d-flex">
                    <span class="person_status">ID : </span><span>{{ $user->id }}</span>
                </div>
                <div class="d-flex person_link">
                    <span class="person_status">名前 : </span>
                    <a class="content" href="{{ route('user.profile', ['id' => $user->id]) }}">                    </a>
                    <span class="person_name">{{ $user->over_name }}</span>
                    <span class="person_name">{{ $user->under_name }}</span>
                </div>
                <div class="d-flex">
                    <span class="person_status">カナ : </span>
                    <span>({{ $user->over_name_kana }}</span>
                    <span>{{ $user->under_name_kana }})</span>
                </div>
                <div class="d-flex">
                    @if($user->sex == 1)
                    <span class="person_status">性別 : </span><span>男</span>
                    @else
                    <span class="person_status">性別 : </span><span>女</span>
                    @endif
                </div>
                <div class="d-flex">
                    <span class="person_status">生年月日 : </span><span>{{ $user->birth_day }}</span>
                </div>
                <div class="d-flex">
                    @if($user->role == 1)
                    <span class="person_status">権限 : </span><span>教師(国語)</span>
                    @elseif($user->role == 2)
                    <span class="person_status">権限 : </span><span>教師(数学)</span>
                    @elseif($user->role == 3)
                    <span class="person_status">権限 : </span><span>講師(英語)</span>
                    @else
                    <span class="person_status">権限 : </span><span>生徒</span>
                    @endif
                </div>
                <div class="d-flex">
                    @if($user->role == 4)
                    <span class="person_status">選択科目 :</span>
                    @foreach($user->subjects as $subject)
                    <span class="mr-2">{{ $subject->subject }}</span>
                    @endforeach

                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- 検索欄 -->
    <div class="search_area w-25 border p-3">
        <div class="mt-5">
            <div class="mb-3">
                <input type="text" class="free_word w-100" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
            </div>
            <div class="mb-2">
                <label>カテゴリ</label><br>
                <select class="h-100 w-50" form="userSearchRequest" name="category">
                <option value="name">名前</option>
                <option value="id">社員ID</option>
                </select>
            </div>
            <div class="mb-3">
                <label>並び替え</label><br>
                <select class="h-100 w-50" name="updown" form="userSearchRequest">
                <option value="ASC">昇順</option>
                <option value="DESC">降順</option>
                </select>
            </div>
            <div class="">
                <p class="m-0 search_conditions d-flex">
                    <span>検索条件の追加</span>
                </p>
                <div class="search_conditions_inner">
                    <div>
                        <label class="mr-2">性別</label>
                        <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
                        <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
                    </div>
                    <div class="my-3">
                        <label class="mr-2">権限</label>
                        <select class="h-100 w-50" name="role" form="userSearchRequest" class="engineer">
                        <option selected disabled>----</option>
                        <option value="1">教師(国語)</option>
                        <option value="2">教師(数学)</option>
                        <option value="3">教師(英語)</option>
                        <option value="4">生徒</option>
                        </select>
                    </div>
                    <div class="selected_engineer d-flex">
                        <label class="mr-2">選択科目</label>
                        <div>
                        @foreach($subjects as $subject)
                        <div>
                            <label>{{ $subject->subject }}</label>
                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" form="userSearchRequest">
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex mt-4">
                <div class="m-auto">
                    <input class="reset_btn" type="reset" value="リセット" form="userSearchRequest">
                </div>
                <div class="ml-auto mr-3">
                    <input class="user_search_btn" type="submit" name="search_btn" value="検索" form="userSearchRequest">
                </div>
            </div>
        </div>
        <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
    </div>
</div>
@endsection
