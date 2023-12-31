@extends('layouts.master')

@section('content')
    @can('piutang read')
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-4">
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

                        <div class="col-sm-4">
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
                        <div class="col-lg-4">
                            <div class="card card-body">
                                <div class="d-flex align-items-center">
                                    <i class="ph-phone-x ph-2x text-danger me-3"></i>
                                    <div class="flex-fill text-end">
                                        <h4 class="mb-0">{{ $total_no_call }}</h4>
                                        <span class="text-muted">Tidak Terjawab</span>
                                    </div>
                                </div>
                            </div>
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
                                <div class="chart has-fixed-height" id="pie_kategori_debt"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /basic pie -->
                </div>
                <div class="col-lg-4">
                    <!-- Daily financials -->
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="mb-0">Hari Ini : {{ $jumlah_total[0]->jumlah_total }} Pelanggan</h5>
                        </div>

                        <div class="card-body">
                            <div class="chart mb-3" id="bullets"></div>
                            @foreach ($jumlah_user_fu as $item)
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <div class="bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-2">
                                            <i class="ph-users"></i>
                                        </div>
                                    </div>
                                    <div class="flex-fill">
                                        {{ $item->nama_collection }}
                                        <div class="text-muted fs-sm">Hari Ini ->
                                            {{ $item->jumlah_harian ? $item->jumlah_harian : '0' }} Pelanggan</div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <!-- /daily financials -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Basic pie -->
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="columns_basic"></div>
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

                var columns_basic_element = document.getElementById('columns_basic');
                var columns_basic = echarts.init(columns_basic_element, null, {
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

                columns_basic.setOption({

                    // Define colors
                    color: ['#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80'],

                    // Global text styles
                    textStyle: {
                        fontFamily: 'var(--body-font-family)',
                        color: 'var(--body-color)',
                        fontSize: 14,
                        lineHeight: 22,
                        textBorderColor: 'transparent'
                    },

                    // Chart animation duration
                    animationDuration: 750,

                    // Setup grid
                    grid: {
                        left: 0,
                        right: 45,
                        top: 35,
                        bottom: 0,
                        containLabel: true
                    },

                    // Add legend
                    legend: {
                        data: ['Jumlah Follow Up'],
                        itemHeight: 8,
                        itemGap: 30,
                        textStyle: {
                            color: 'var(--body-color)',
                            padding: [0, 5]
                        }
                    },

                    // Add tooltip
                    tooltip: {
                        trigger: 'axis',
                        className: 'shadow-sm rounded',
                        backgroundColor: 'var(--white)',
                        borderColor: 'var(--gray-400)',
                        padding: 15,
                        textStyle: {
                            color: '#000'
                        },
                        axisPointer: {
                            type: 'shadow',
                            shadowStyle: {
                                color: 'rgba(var(--body-color-rgb), 0.025)'
                            }
                        }
                    },

                    // Horizontal axis
                    xAxis: [{
                        type: 'category',
                        barPercentage: '0.1',
                        data: <?= json_encode($tgl_fu) ?>,
                        axisLabel: {
                            color: 'rgba(var(--body-color-rgb), .65)'
                        },
                        axisLine: {
                            lineStyle: {
                                color: 'var(--gray-500)'
                            }
                        },
                        splitLine: {
                            show: true,
                            lineStyle: {
                                color: 'var(--gray-300)',
                                type: 'dashed'
                            }
                        }
                    }],

                    // Vertical axis
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            color: 'rgba(var(--body-color-rgb), .65)'
                        },
                        axisLine: {
                            show: true,
                            lineStyle: {
                                color: 'var(--gray-500)'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: 'var(--gray-300)'
                            }
                        },
                        splitArea: {
                            show: true,
                            areaStyle: {
                                color: ['rgba(var(--white-rgb), .01)', 'rgba(var(--black-rgb), .01)']
                            }
                        }
                    }],

                    // Add series
                    series: [{
                        name: 'Jumlah Follow Up',
                        type: 'bar',
                        data: <?= json_encode($jumlah_fu_daily) ?>,
                        itemStyle: {
                            normal: {
                                barBorderRadius: [4, 4, 0, 0],
                                label: {
                                    show: true,
                                    position: 'top',
                                    fontWeight: 500,
                                    fontSize: 11,
                                    color: 'var(--body-color)'
                                }
                            }
                        },
                        markLine: {
                            data: [{
                                type: 'average',
                                name: 'Average'
                            }],
                            label: {
                                color: 'var(--body-color)'
                            }
                        }
                    }]
                });


                // Resize function
                var triggerChartResize = function() {
                    kategori_debt_element && kategori_debt.resize();
                    issue_bayar_element && issue_bayar.resize();
                    columns_basic_element && columns_basic.resize();
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
