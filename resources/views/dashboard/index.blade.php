@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="row">

            <!-- Left fixed column -->
            <div class="card">
                <?php
                $last_date = date('t', strtotime($tahun . '-' . $bulan . '-01'));
                ?>

                <table class="table datatable-fixed-left">
                    <thead>
                        <tr>
                            <th colspan="14" style="text-align:center;">Bulan Ke-</th>
                        </tr>
                        <tr>
                            <th>Nama</th>
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
                        
                            for ($i = 1; $i <= $last_date; $i++) {
                                $date_loop = date('Y-m-d', strtotime($tahun . '-' . $bulan . '-' . $i));
                                // echo '<td>' . $date_loop . '</td>';
                                if (!empty($value[$date_loop])) {
                                    echo '<td>' . $value[$date_loop] . '</td>';
                                    $total += $value[$date_loop];
                                } else {
                                    echo '<td>-</td>';
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
    <script src="{{ asset('assets/js/dashboard/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
