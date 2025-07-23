<!-- Extends the main layout -->
@extends('layouts.layout')


@section('content')
    <!-- import of auth.registerform component -->
    <x-auth.registerform />
    @if($errors->any())
        <ul class="text-red-600">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif
@endsection