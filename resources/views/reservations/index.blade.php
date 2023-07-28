@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="row">
            @foreach ($room as $rooms)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions mb-3">
                                <img class="card-img img-fluid" src="{{ asset("storage/files/$rooms->images") }}"
                                    alt="" style="height: auto; width: auto;">
                            </div>

                            <h5 class="card-title">
                                {{ $rooms->name }}
                            </h5>

                            <div class="row">
                                <p>Facility : <i>{{ $rooms->facility }}</i></p>
                                <p>Capacity : <i>{{ $rooms->capacity }} Participans</i></p>
                            </div>

                        </div>

                        <div class="card-footer d-flex">
                            <a href="{{ route('calendars.dashboard') }}"
                                class="d-inline-flex align-items-center ms-auto">Book Now <i
                                    class="ph-hand-pointing ms-2"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /basic responsive configuration -->
    </div>
@endsection
@push('js_page')
    {{-- <script src="{{ asset('assets/js/rooms/index.js') }}"></script> --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
