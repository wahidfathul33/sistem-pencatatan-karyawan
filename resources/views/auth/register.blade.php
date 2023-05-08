@extends('layouts.auth')

@section('page-title', 'Register')

@push('style')
@endpush

@section('content')
        <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            @livewire('auth.register-form')
        </div>
@endsection
