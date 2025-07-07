@extends('layouts.layout')

@section('header')
    <x-nav />
@endsection

@section('content')
    <x-auth.registerform />
    @if($errors->any())
        <ul class="text-red-600">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif

@endsection

@section('footer')
    <x-footer />
@endsection