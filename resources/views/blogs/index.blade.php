@extends('layouts.layout')

@push('scripts')
    @livewireScripts
@endpush

@section('content')
    <div class="bg-grad-2 flex min-h-screen">
        <div class="flex-1 flex flex-col space-y-4">
            <div class="flex-1 overflow-auto space-y-6 place-self-center mt-10 text-slate-900">
                <!-- Live Wire Search Form Component -->
                <div>
                    <livewire:search-form />
                </div>
            </div>

        </div>
    </div>


@endsection