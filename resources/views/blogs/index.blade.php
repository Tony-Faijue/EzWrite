@extends('layouts.layout')

@section('header')
    <x-nav />
@endsection

@section('content')
    <div class="bg-grad-2 flex">
        <div class="flex-1 flex justify-center items-center">
            <ul>
                @foreach ($blogs as $blog)
                    <div class="user-form-bg my-4">
                        <li>
                            <x-card.blog-cards>
                                <h1>{{ $blog->name }}</h1>
                                <p><i>{{ $blog->author }}</i></p>
                                <p>{{$blog->hero_title}}</p>
                            </x-card.blog-cards>
                        </li>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection