@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center gap-4 p-6">
        @livewire('lottery-page')
        @livewire('result-card')
        @livewire('winning-list-modal')
    </div>
@endsection
