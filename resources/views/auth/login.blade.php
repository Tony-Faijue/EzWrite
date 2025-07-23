<!-- Extends the main layout -->
@extends('layouts.layout')


@section('content')
    <!-- import of auth.loginform component -->
    <x-auth.loginform />
    @if($errors->any())
        <ul class="text-red-600">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif

@endsection