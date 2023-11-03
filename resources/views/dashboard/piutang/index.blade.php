@extends('layouts.master')

@section('content')
    @can('piutang read')
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="ph-hourglass ph-2x text-warning me-3"></i>

                            <div class="flex-fill text-end">
                                <a href="{{ route('baddeb.index') }}">
                                    <h4 class="mb-0">{{ $total_pending }}</h4>
                                </a>
                                <span class="text-muted">Follow Up</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-xl-3">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="ph-hands-clapping ph-2x text-teal me-3"></i>
                            <div class="flex-fill text-end">
                                <h4 class="mb-0">{{ $total_close }}</h4>
                                <span class="text-muted">Close</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-xl-4">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="ph-phone-x ph-2x text-danger me-3"></i>
                            <div class="flex-fill text-end">
                                <h4 class="mb-0">{{ $total_no_call }}</h4>
                                <span class="text-muted">Tidak Dapat Dihubungi</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Basic pie -->
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="pie_kategori_debt"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /basic pie -->
                </div>

            </div>


        </div>
    @endcan
@endsection

@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/fixed_columns.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/visualization/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/auth/auth.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @can('piutang read')
        <script src="{{ asset('assets/js/dashboard/admin.js') }}"></script>
        <script>
            $(document).ready(function() {
                var kategori_debt_element = document.getElementById('pie_kategori_debt');
                var kategori_debt = echarts.init(kategori_debt_element, null, {
                    renderer: 'svg'
                });

                // Kategori
                kategori_debt.setOption({
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
                        text: 'Alasan Telat Bayar',
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
                        name: 'Kategori',
                        type: 'pie',
                        radius: '70%',
                        center: ['50%', '57.5%'],
                        itemStyle: {
                            borderColor: 'var(--card-bg)'
                        },
                        label: {
                            color: 'var(--body-color)'
                        },
                        data: <?= json_encode($jumlah_kategori) ?>
                    }]
                });

                // Resize function
                var triggerChartResize = function() {
                    kategori_debt_element && kategori_debt.resize();
                    issue_bayar_element && issue_bayar.resize();
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
    @endcan


@endpush
