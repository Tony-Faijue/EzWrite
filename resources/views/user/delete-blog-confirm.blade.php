@extends('layouts.layout')

@section('content')
    <!-- Error Handling -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-grad-2 flex">

        <!-- import user side-nav component -->
        <x-user.side-nav />
        <div class="user-form-bg mx-auto mt-10 mb-10 h-80 justify-items-center">
            <!-- Deletion Form -->
            <form action="{{ route('user-blogs-delete', [$blog]) }}" method="POST" class="w-85 p-6">
                @csrf
                @method('DELETE')
                <div class="w-auto">
                    <div class="w-auto flex flex-col p-4 space-y-4">
                        <p class="text-3xl text-purple-600">Are you sure you want to DELETE this blog?</p>
                        <div class="flex justify-between text-slate-100">
                            <button type="submit"
                                class="bg-emerald-500 rounded-lg border border-purple-800 hover:bg-emerald-700 w-25 text-center text-lg">Confirm</button>
                            <button
                                class="bg-red-600 rounded-lg border border-purple-800 hover:bg-red-800 w-25 text-center text-lg">
                                <a href="{{route('user-blogs-index')}}">Cancel</a>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

@endsection