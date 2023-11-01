<?php

namespace App\Http\Controllers;
use App\Models\Baddeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardPiutang extends Controller
{
    public function home() {
        if(Auth::user()->hasRole(['admin','management'])){
               // Kategori Pie
            $kategori_query = "SELECT d.name, COUNT(b.id) AS jumlah
                                FROM debts d
                                LEFT JOIN baddebs b ON b.kategori_debt = d.id
                                GROUP BY d.name
                                ORDER BY d.name";
            $kategori_count = DB::select($kategori_query);
                $count_kategori = [];
                foreach ($kategori_count as $value) {
                    $count_kategori[] = [
                        "name" => $value->name,
                        "value" => $value->jumlah
                    ];
                }
            $data['jumlah_kategori'] = $count_kategori;
            // Kategori Pie

            // Kategori Pie
            $issue_query = "SELECT b.issue_bayar, COUNT(b.id) AS jumlah
                    FROM baddebs b
                    WHERE b.issue_bayar is NOT NULL
                    GROUP BY b.issue_bayar
                    ORDER BY b.issue_bayar";
            $issue_count = DB::select($issue_query);
                $count_issue = [];
                foreach ($issue_count as $value) {
                    $count_issue[] = [
                        "name" => $value->issue_bayar,
                        "value" => $value->jumlah
                    ];
                }
            $data['jumlah_issue'] = $count_issue;
            // Kategori Pie

            $pending = Baddeb::where('status_bayar', 'pending');
            $data['total_pending'] = $pending->count();

            $close = Baddeb::where('status_bayar', 'close');
            $data['total_close'] = $close->count();

            return view('dashboard.piutang.index',$data);
        }
    }
}
