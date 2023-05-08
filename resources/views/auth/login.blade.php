@extends('layouts.auth')

@section('page-title', 'Login')

@push('style')
@endpush

@section('content')
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            @livewire('auth.login-form')
        </div>
@endsection
