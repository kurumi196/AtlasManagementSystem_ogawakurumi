@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto">
  <div class="w-100">
    <p class="title mt-3 mb-2">{{ $calendar->getTitle() }}</p>
    <div class="p-3" style="border-radius:10px; background:#FFF;">
      {!! $calendar->render() !!}
    </div>
  </div>
</div>
@endsection
