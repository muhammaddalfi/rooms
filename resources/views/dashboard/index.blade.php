@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="row">
            <!-- Left fixed column -->
            <div class="card">
                <?php
                $last_date = date('t', strtotime($tahun . '-' . $bulan . '-01'));
                ?>
                <div class="card-body">
                    {{-- <a href='#' class="btn btn-light add_rooms" data-toggle="modal" data-target="#modal_daily"><i
                            class="ph-plus-circle me-2"></i>Tambah Dokumentasi Harian</a> --}}
                    <form action="{{ route('home.cari') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <select class="form-control tahun" name="tahun" id="tahun"
                                    data-minimum-results-for-search="Infinity" data-fouc>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>

                                </select>
                            </div>

                            <div class="col-lg-3">
                                <select class="form-control bulan" name="bulan" id="bulan"
                                    data-minimum-results-for-search="Infinity" data-fouc>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>

                                </select>
                            </div>

                            <div class="col-lg -3">

                                <button type="submit" class="btn btn-primary" id="save">
                                    <img src='{{ asset('assets/spinner.gif') }}' id="spinner">
                                    Cari
                                </button>
                            </div>

                        </div>
                    </form>


                </div>

                <table class="table datatable-cluster">
                    <thead>
                        <tr>
                            <th colspan="14" style="text-align:center;">Hari Ke-</th>
                        </tr>
                        <tr>
                            <th>Nama Cluster</th>
                            <?php
                            for ($i = 1; $i <= $last_date; $i++) {
                                echo '<th>' . $i . ' </th>';
                            }
                            ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $no = 1;
                        $total = 0;
                        foreach ($daily as $key => $value) {
                            echo '<tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' .
                                $key .
                                '</td>';
                            $total = 0;
                        
                            for ($i = 1; $i <= $last_date; $i++) {
                                $date_loop = date('Y-m-d', strtotime($tahun . '-' . $bulan . '-' . $i));
                                // echo '<td>' . $date_loop . '</td>';
                                if (!empty($value[$date_loop])) {
                                    echo '<td>' . $value[$date_loop] . '</td>';
                                    $total += $value[$date_loop];
                                } else {
                                    echo '<td>0</td>';
                                }
                            }
                            echo '<td>' . $total . '</td></tr>';
                        
                            # code...
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /left fixed column -->
        </div>

        <div class="row">
            <!-- Left fixed column -->
            <div class="card">

                <table class="table datatable-kegiatan">
                    <thead>
                        <tr>
                            <th colspan="14" style="text-align:center;">Jenis Kegiatan</th>
                        </tr>
                        <tr>
                            <th>Nama Cluster</th>
                            @foreach ($jenis_kegiatan as $item)
                                <th>
                                    {{ $item->jenis_kegiatan }}
                                </th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $no = 1;
                        $total = 0;
                        foreach ($kegiatan as $key => $value) {
                            echo '<tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' .
                                $key .
                                '</td>';
                            $total = 0;
                            foreach ($jenis_kegiatan as $key_k => $value_k) {
                                if (!empty($value[$value_k->id])) {
                                    echo '<td>' . $value[$value_k->id] . '</td>';
                                    $total += $value[$value_k->id];
                                } else {
                                    echo '<td>0</td>';
                                }
                            }
                        
                            echo '<td>' . $total . '</td></tr>';
                        
                            # code...
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <!-- /left fixed column -->
        </div>


    </div>
@endsection

@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/fixed_columns.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
