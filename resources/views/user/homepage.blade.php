@extends('layouts.layout')



@section('content')
    <div class="bg-grad-2 flex">
        <x-user.side-nav />
        <x-user.dashboard />
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection