@extends('layouts.base')

@section('body')
    @include('components.drawer')

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
