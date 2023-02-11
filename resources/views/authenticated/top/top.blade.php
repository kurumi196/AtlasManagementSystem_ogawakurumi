@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
    <div class="top_area w-75 m-auto pt-5">
        <p class="title">マイページ</p>
        <div class="user_status p-3">
            <div class="d-flex">
                <p>名前：</p>
                <span>{{ Auth::user()->over_name }}</span>
                <span class="ml-1">{{ Auth::user()->under_name }}</span>
            </div>
            <div class="d-flex">
                <p>カナ：</p>
                <span>{{ Auth::user()->over_name_kana }}</span>
                <span class="ml-1">{{ Auth::user()->under_name_kana }}</span>
            </div>
            <div class="d-flex">
                <p>性別：</p>
                @if(Auth::user()->sex == 1)
                <span>男</span>
                @else
                <span>女</span>@endif
            </div>
            <div class="d-flex">
                <p>生年月日：</p>
                <span>{{ Auth::user()->birth_day }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
