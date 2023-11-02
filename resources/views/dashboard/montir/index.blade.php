@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xl-3">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="ph-calendar-plus ph-2x text-warning me-3"></i>

                    <div class="flex-fill text-end">
                        <a href="{{ route('pm.index') }}">
                            <h4 class="mb-0">{{ $plan_pm }}</h4>
                        </a>
                        <span class="text-muted">Rencana PM</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-xl-3">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="ph-calendar-check ph-2x text-teal me-3"></i>
                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $plan_pm }}</h4>
                        <span class="text-muted">Total Kegiatan PM</span>
                    </div>
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
                        <div class="chart has-fixed-height" id="pie_cluster_pm"></div>
                    </div>
                </div>
            </div>
            <!-- /basic pie -->
        </div>

        <div class="col-lg-6">
            <!-- Daily financials -->
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Preventive Retail</h5>
                </div>

                <div class="card-body">
                    <div class="chart mb-3" id="bullets"></div>


                    @foreach ($petugas_pm as $item)
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <div class="bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-2">
                                    <i class="ph-users"></i>
                                </div>
                            </div>
                            <div class="flex-fill">
                                {{ $item->lokasi }}
                                <div class="text-muted fs-sm">{{ $item->nama_petugas }}</div>
                                <div class="text-muted fs-sm">{{ date('d M Y', strtotime($item->tgl_mulai)) }}</div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <!-- /daily financials -->

        </div>
    </div>
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
        <script>
            $(document).ready(function() {
                var cluster_pm_element = document.getElementById('pie_cluster_pm');
                var cluster_pm = echarts.init(cluster_pm_element, null, {
                    renderer: 'svg'
                });


                // Options
                cluster_pm.setOption({
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
                        text: 'Cluster Paling Banyak Di PM',
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
                        data: <?= json_encode($jumlah_cluster_pm) ?>
                    }]
                });

                // Resize function
                var triggerChartResize = function() {
                    cluster_pm_element && cluster_pm.resize();
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
@endpush
