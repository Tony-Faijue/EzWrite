@extends('layouts.layout')

@section('header')
    <x-user.nav />
@endsection

@section('content')
    <div class="bg-grad-2 flex">
        <x-user.side-nav />
        <x-user.dashboard />
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection