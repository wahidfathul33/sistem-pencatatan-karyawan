@extends('layouts._skeleton')

@section('body')
    <body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center"
             style="background-image: url({{ asset('assets/media/misc/symphony.png') }}); background-repeat: repeat; background-attachment: fixed;">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                @include('layouts.partials.auth._logo')
                @yield('content')
            </div>
            @include('layouts.partials.auth._footer')
        </div>
    </div>
@endsection
