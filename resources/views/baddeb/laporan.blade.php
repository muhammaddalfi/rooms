@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <form action="{{ route('report.search') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div id="daterange" class="input-group">
                                                <span class="input-group-text"><i class="ph-calendar"></i></span>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-8">
                                <a href='{{ route('export.raw') }}' class="btn btn-light"><i
                                        class="ph-microsoft-excel-logo me-2"></i>Export
                                    Data</a>
                            </div>

                        </div>


                    </div>
                    <table class="table datatable-laporan-baddeb">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>ID Pelanggan</th>
                                <th>Layanan</th>
                                <th>Status</th>
                                <th>Petugas</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Basic responsive configuration -->



        <!-- /basic responsive configuration -->
    </div>
    @include('baddeb.modals.view')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/baddebt/laporan.js') }}"></script>
@endpush
