@extends('layouts.app')

@section('content')
    <div class="min-h-screen sm:flex sm:justify-center sm:items-center">

        <div class="p-6 mx-auto max-w-7xl lg:p-8">
            <div class="flex justify-center">
                <img src="{{ asset('lottery-logo.svg') }}" alt="lottery-log" class="w-64 h-64">
            </div>

            @livewire('lottery-page')
        </div>
    </div>
@endsection
