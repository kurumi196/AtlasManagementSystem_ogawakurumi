@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
    <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
        <div class="w-75 m-auto border" style="border-radius:5px;">
            <p class="text-center title my-2">{{ $calendar->getTitle() }}</p>
            <div class="">
                {!! $calendar->render() !!}
            </div>
        </div>
        <div class="text-right w-75 m-auto">
            <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
        </div>
    </div>
</div>
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <form action="/delete/calendar" method="post" id="deleteParts">
        <div class="w-100">
            <div class="d-flex">
                <p>予約日：</p>
                <input type="hidden" id="data" name="data" form="deleteParts">
                <output class="modal-inner-day">
            </div>
            <div class="d-flex">
                <p>時間：</p>
                <input type="hidden" id="part" name="part" form="deleteParts">
                <output class="modal-inner-part">
            </div>
            <p>上記の予約をキャンセルしてもよろしいですか？</p>
            <div class="w-50 m-auto edit-modal-btn d-flex">
                <a class="btn btn-primary d-block js-modal-close" href="">閉じる</a>
                <input type="submit" class="btn btn-danger d-inline-block" value="キャンセル" form="deleteParts">
            </div>
        </div>
        @csrf
        </form>
    </div>
</div>
@endsection
