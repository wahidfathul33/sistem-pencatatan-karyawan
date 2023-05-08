@if(session()->has('error'))
    @php
        $flashMessage = session('error');
        $style = 'danger';
    @endphp
@elseif(session()->has('success'))
    @php
        $flashMessage = session('success');
        $style = 'success';
    @endphp
@endif

@if(session()->has('success') or session()->has('error'))
    <div class="alert alert-dismissible bg-light-{{ $style }} border border-{{ $style }} d-flex flex-column flex-sm-row p-5 mb-10">

        @if(isset($flashMessage['title']))
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <h5 class="mb-1">{{ $flashMessage['title'] }}</h5>
                <span>{{ $flashMessage['message'] }}</span>
            </div>
        @else
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <p>{{ $flashMessage }}</p>
            </div>
        @endif

        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <i class="bi bi-x fs-1 text-{{ $style }}"></i>
        </button>
    </div>

@endif
