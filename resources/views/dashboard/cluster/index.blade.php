@extends('layouts.master')

@section('content')
    @hasanyrole('admin|management|super admin')
        <div class="content">
            @if (request()->route()->uri() != '/dashboard/cluster/search')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-icon-start alert-dismissible fade show mt-2">
                            <span class="alert-icon bg-info text-white">
                                <i class="ph-warning-circle"></i>
                            </span>
                            <span class="fw-semibold">Data yang ditampilkan adalah bulan {{ date('F') }}
                                {{ date('Y') }}</span>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-3 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="ph-broadcast ph-2x text-success me-3"></i>

                            <div class="flex-fill text-end">
                                <h4 class="mb-0">{{ $total_cluster }}</h4>
                                <span class="text-muted">Cluster</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-sm-3 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="ph-broadcast ph-2x text-success me-3"></i>

                            <div class="flex-fill text-end">
                                <h4 class="mb-0">{{ $jumlah_cluster_no }}</h4>
                                <span class="text-muted">Belum dikunjungi</span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-sm-3 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="ph-activity ph-2x text-indigo me-3"></i>
                            <div class="flex-fill text-end">
                                <a href="{{ route('daily.dashboard') }}">
                                    <h4 class="mb-0">{{ $total_kegiatan }}</h4>
                                </a>
                                <span class="text-muted">Total Kegiatan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <h4 class="mb-0">{{ $total_mpi }}</h4>

                                <span class="text-muted">Total MPI</span>
                            </div>

                            <i class="ph-user ph-2x text-primary ms-3"></i>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <h4 class="mb-0">{{ $total_mpp }}</h4>
                                <span class="text-muted">Total MPP</span>
                            </div>

                            <i class="ph-user-list ph-2x text-danger ms-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Basic pie -->
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="pie_kegiatan"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /basic pie -->
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <table class="table datatable-sales-input">
                            <thead>
                                <th>Sales belum Input Data hari ini</th>
                            </thead>
                            <tbody>
                                @foreach ($sales as $item)
                                    <tr>
                                        <td>
                                            {{ $item->nama_sales }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Left fixed column -->
                    <div class="card">
                        <?php
                        $last_date = date('t', strtotime($tahun . '-' . $bulan . '-01'));
                        ?>
                        <div class="card-body">
                            <form action="{{ route('cluster.cari') }}" method="POST">
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

                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary" id="save">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table class="table datatable-cluster-admin">
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
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Left fixed column -->
                    <div class="card">
                        <?php
                        $last_date = date('t', strtotime($tahun . '-' . $bulan . '-01'));
                        ?>

                        <table class="table datatable-cluster-jenis_kegiatan">
                            <thead>
                                <tr>
                                    <th colspan="{{ $jenis_kegiatan->count() + 2 }}" style="text-align:center;">Jenis
                                        Kegiatan
                                    </th>
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

            <div class="row">
                <div class="col-lg-12">
                    <!-- Left fixed column -->
                    <div class="card">
                        <?php
                        $last_date = date('t', strtotime($tahun . '-' . $bulan . '-01'));
                        ?>

                        <table class="table datatable-cluster-sales">
                            <thead>
                                <tr>
                                    <th colspan="14" style="text-align:center;">Hari Ke-</th>
                                </tr>
                                <tr>
                                    <th>Petugas</th>
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
                                foreach ($daily_user as $key => $value) {
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
            </div>

        </div>
    @endhasanyrole

    @role('sales')
        <div class="content">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="ph-broadcast ph-2x text-success me-3"></i>

                            <div class="flex-fill text-end">
                                <h4 class="mb-0">{{ $total_cluster }}</h4>
                                <span class="text-muted">Total cluster</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <h4 class="mb-0">{{ $total_mpi }}</h4>
                                <span class="text-muted">Total MPI</span>
                            </div>

                            <i class="ph-user ph-2x text-primary ms-3"></i>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <h4 class="mb-0">{{ $total_keluhan }}</h4>
                                <span class="text-muted">Keluhan Hari Ini</span>
                            </div>

                            <i class="ph-smiley-sad ph-2x text-warning ms-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Basic pie -->
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="pie_kegiatan_sales"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /basic pie -->
                </div>

                <div class="col-lg-6">
                    <!-- Basic pie -->
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="pie_kegiatan"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /basic pie -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Left fixed column -->
                    <div class="card">
                        <table class="table datatable-kegiatan-sales">
                            <thead>
                                <tr>
                                    <th colspan="{{ $jenis_kegiatan->count() + 2 }}" style="text-align:center;">Jenis
                                        Kegiatan
                                    </th>
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
                                    echo '<tr><td>' . $key . '</td>';
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
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /left fixed column -->
                </div>
            </div>

        </div>
    @endrole

    @role('mitra')
        <div class="content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="card card-body">
                            <div class="d-flex align-items-center">
                                <i class="ph-activity ph-2x text-success me-3"></i>

                                <div class="flex-fill text-end">
                                    <h4 class="mb-0">{{ $tampil_jumlah }}</h4>
                                    <span class="text-muted">Kegiatan Hari Ini</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <table class="table datatable-cluster-user">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-center">Maps</th>
                                    <th>Nama Cluster</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@endsection

@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/fixed_columns.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/visualization/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/auth/auth.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @hasanyrole(['admin', 'management', 'super admin'])
        <script src="{{ asset('assets/js/dashboard/admin.js') }}"></script>
        <script>
            $(document).ready(function() {
                var kegiatan_element = document.getElementById('pie_kegiatan');
                var kegiatan = echarts.init(kegiatan_element, null, {
                    renderer: 'svg'
                });


                // Options
                kegiatan.setOption({
                    // Colors
                    color: [
                        '#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
                        '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
                        '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
                        '#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
                    ],

                    // Global text styles
                    textStyle: {
                        fontFamily: 'var(--body-font-family)',
                        color: 'var(--body-color)',
                        fontSize: 14,
                        lineHeight: 22,
                        textBorderColor: 'transparent'
                    },

                    // Add title
                    title: {
                        text: 'Jenis Kegiatan (Count)',
                        left: 'center',
                        textStyle: {
                            fontSize: 18,
                            fontWeight: 500,
                            color: 'var(--body-color)'
                        },
                        subtextStyle: {
                            fontSize: 12,
                            color: 'rgba(var(--body-color-rgb), 0.5)'
                        }
                    },

                    // Add tooltip
                    tooltip: {
                        trigger: 'item',
                        className: 'shadow-sm rounded',
                        backgroundColor: 'var(--white)',
                        borderColor: 'var(--gray-400)',
                        padding: 15,
                        textStyle: {
                            color: '#000'
                        },
                        formatter: "{a} <br/>{b}: {c} ({d}%)"
                    },

                    // Add legend


                    // Add series
                    series: [{
                        name: 'Jumlah Kegiatan',
                        type: 'pie',
                        radius: '70%',
                        center: ['50%', '57.5%'],
                        itemStyle: {
                            borderColor: 'var(--card-bg)'
                        },
                        label: {
                            color: 'var(--body-color)'
                        },
                        data: <?= json_encode($jumlah_kegiatan) ?>
                    }]
                });

                // Resize function
                var triggerChartResize = function() {
                    kegiatan_element && kegiatan.resize();
                };


                // On sidebar width change
                var sidebarToggle = document.querySelectorAll('.sidebar-control');
                if (sidebarToggle) {
                    sidebarToggle.forEach(function(togglers) {
                        togglers.addEventListener('click', triggerChartResize);
                    });
                }

                // On window resize
                var resizeCharts;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeCharts);
                    resizeCharts = setTimeout(function() {
                        triggerChartResize();
                    }, 200);
                });
            });
        </script>
    @endhasanyrole

    @role('sales')
        <script src="{{ asset('assets/js/dashboard/leader.js') }}"></script>
        <script>
            $(document).ready(function() {
                var kegiatan_sales_element = document.getElementById('pie_kegiatan_sales');
                var kegiatan_sales = echarts.init(kegiatan_sales_element, null, {
                    renderer: 'svg'
                });


                // Options
                kegiatan_sales.setOption({
                    // Colors
                    color: [
                        '#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
                        '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
                        '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
                        '#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
                    ],

                    // Global text styles
                    textStyle: {
                        fontFamily: 'var(--body-font-family)',
                        color: 'var(--body-color)',
                        fontSize: 14,
                        lineHeight: 22,
                        textBorderColor: 'transparent'
                    },

                    // Add title
                    title: {
                        text: 'Jumlah Kegiatan Hari Ini',
                        left: 'center',
                        textStyle: {
                            fontSize: 18,
                            fontWeight: 500,
                            color: 'var(--body-color)'
                        },
                        subtextStyle: {
                            fontSize: 12,
                            color: 'rgba(var(--body-color-rgb), 0.5)'
                        }
                    },

                    // Add tooltip
                    tooltip: {
                        trigger: 'item',
                        className: 'shadow-sm rounded',
                        backgroundColor: 'var(--white)',
                        borderColor: 'var(--gray-400)',
                        padding: 15,
                        textStyle: {
                            color: '#000'
                        },
                        formatter: "{a} <br/>{b}: {c} ({d}%)"
                    },

                    // Add legend


                    // Add series
                    series: [{
                        name: 'Jumlah',
                        type: 'pie',
                        radius: '70%',
                        center: ['50%', '57.5%'],
                        itemStyle: {
                            borderColor: 'var(--card-bg)'
                        },
                        label: {
                            color: 'var(--body-color)'
                        },
                        data: <?= json_encode($jumlah_kegiatan_sales) ?>
                    }]
                });

                // Resize function
                var triggerChartResize = function() {
                    kegiatan_sales_element && kegiatan_sales.resize();
                };


                // On sidebar width change
                var sidebarToggle = document.querySelectorAll('.sidebar-control');
                if (sidebarToggle) {
                    sidebarToggle.forEach(function(togglers) {
                        togglers.addEventListener('click', triggerChartResize);
                    });
                }

                // On window resize
                var resizeCharts;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeCharts);
                    resizeCharts = setTimeout(function() {
                        triggerChartResize();
                    }, 200);
                });
            });
            $(document).ready(function() {
                var kegiatan_element = document.getElementById('pie_kegiatan');
                var kegiatan = echarts.init(kegiatan_element, null, {
                    renderer: 'svg'
                });


                // Options
                kegiatan.setOption({
                    // Colors
                    color: [
                        '#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
                        '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
                        '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
                        '#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
                    ],

                    // Global text styles
                    textStyle: {
                        fontFamily: 'var(--body-font-family)',
                        color: 'var(--body-color)',
                        fontSize: 14,
                        lineHeight: 22,
                        textBorderColor: 'transparent'
                    },

                    // Add title
                    title: {
                        text: 'Jumlah Kegiatan',
                        left: 'center',
                        textStyle: {
                            fontSize: 18,
                            fontWeight: 500,
                            color: 'var(--body-color)'
                        },
                        subtextStyle: {
                            fontSize: 12,
                            color: 'rgba(var(--body-color-rgb), 0.5)'
                        }
                    },

                    // Add tooltip
                    tooltip: {
                        trigger: 'item',
                        className: 'shadow-sm rounded',
                        backgroundColor: 'var(--white)',
                        borderColor: 'var(--gray-400)',
                        padding: 15,
                        textStyle: {
                            color: '#000'
                        },
                        formatter: "{a} <br/>{b}: {c} ({d}%)"
                    },

                    // Add legend


                    // Add series
                    series: [{
                        name: 'Jumlah',
                        type: 'pie',
                        radius: '70%',
                        center: ['50%', '57.5%'],
                        itemStyle: {
                            borderColor: 'var(--card-bg)'
                        },
                        label: {
                            color: 'var(--body-color)'
                        },
                        data: <?= json_encode($jumlah_kegiatan) ?>
                    }]
                });

                // Resize function
                var triggerChartResize = function() {
                    kegiatan_element && kegiatan.resize();
                };


                // On sidebar width change
                var sidebarToggle = document.querySelectorAll('.sidebar-control');
                if (sidebarToggle) {
                    sidebarToggle.forEach(function(togglers) {
                        togglers.addEventListener('click', triggerChartResize);
                    });
                }

                // On window resize
                var resizeCharts;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeCharts);
                    resizeCharts = setTimeout(function() {
                        triggerChartResize();
                    }, 200);
                });
            });
        </script>
    @endrole

    @role('mitra')
        <script src="{{ asset('assets/js/dashboard/user.js') }}"></script>
    @endrole

@endpush
