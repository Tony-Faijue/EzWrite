@extends('layouts.layout')

@push('scripts')
    <script src="{{ asset('js/flash-success.js') }}"></script>
@endpush

@section('content')
    <div class="bg-grad-2 flex">
        <!-- import user side-nav and user dashboard component -->
        <x-user.side-nav />
        <div class="flex-1 flex flex-col">
            <!-- Success Message -->
            @if(session('Success'))
                <div id="flash"
                    class=" flash-success p-4 text-center bg-emerald-200 text-emerald-800 place-self-end rounded-lg w-1/4 mt-4 mr-2">
                    {{session('Success')}}
                </div>
            @endif
            <x-user.dashboard />
        </div>
@endsection