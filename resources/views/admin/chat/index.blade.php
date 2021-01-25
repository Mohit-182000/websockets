@extends('admin.layout.app')

@section('title','Chat')

@push('css')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@section('content')

    <chat-component :user="{{ auth()->user() }}"></chat-component>

@endsection