@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <!-- Basic pie -->
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="pie_keluhan"></div>
                        </div>
                    </div>
                </div>
                <!-- /basic pie -->
            </div>
            {{-- <div class="col-lg-6">
                <div class="card">
                    <table class="table datatable-perusahaan">
                        <thead>
                            <th>Nama Cluster</th>
                            <th>Jumlah Keluhan</th>
                        </thead>
                        <tbody>
                            @foreach ($keluhan_count as $item)
                                <tr>
                                    <td>
                                        {{ $item->nama_olt }}
                                    </td>
                                    <td>
                                        {{ $item->jumlah_keluhan }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Left fixed column -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('cari.keluhan') }}" method="POST">
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
                    <table class="table datatable-keluhan">
                        <thead>
                            <tr>
                                <th colspan="{{ $jenis_keluhan->count() + 2 }}" style="text-align:center;">Jenis Keluhan
                                </th>
                            </tr>
                            <tr>
                                <th>Nama Cluster</th>
                                @foreach ($jenis_keluhan as $item)
                                    <th>
                                        {{ $item->jenis_keluhan }}
                                    </th>
                                @endforeach
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $no = 1;
                            $total = 0;
                            foreach ($keluhan as $key => $value) {
                                echo '<tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <td>' .
                                    $key .
                                    '</td>';
                                $total = 0;
                                foreach ($jenis_keluhan as $key_k => $value_k) {
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


    </div>
@endsection

@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/fixed_columns.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/visualization/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/keluhan.js') }}"></script>

    <script>
        $(document).ready(function() {
            var keluhan_element = document.getElementById('pie_keluhan');
            var keluhan = echarts.init(keluhan_element, null, {
                renderer: 'svg'
            });


            // Options
            keluhan.setOption({
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
                    text: 'Total Keluhan',
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
                    name: 'Jumlah Keluhan',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        borderColor: 'var(--card-bg)'
                    },
                    label: {
                        color: 'var(--body-color)'
                    },
                    data: <?= json_encode($jumlah_keluhan) ?>
                }]
            });

            // Resize function
            var triggerChartResize = function() {
                keluhan_element && keluhan.resize();
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
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
