@extends('layouts.master')

@section('content')
    <div class="content">
        @can('admin read')
            <div class="row">



            </div>

            <div class="row">

            </div>
        @endcan

    </div>
@endsection

@push('js_page')
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
