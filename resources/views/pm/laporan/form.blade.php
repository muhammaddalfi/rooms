<!DOCTYPE html>
<html>

<head>
</head>

<body>

    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-color: #ccc;
            border-spacing: 0;
        }

        .tg td {
            background-color: #fff;
            border-color: #ccc;
            border-style: solid;
            border-width: 1px;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 7px 5px;
            word-break: normal;
        }

        .tg th {
            background-color: #f0f0f0;
            border-color: #ccc;
            border-style: solid;
            border-width: 1px;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 7px 5px;
            word-break: normal;
        }

        .tg .tg-cope {
            border-color: #000000;
            font-size: 24px;
            font-weight: bold;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-4w8t {
            border-color: #000000;
            font-size: xx-small;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-73oq {
            border-color: #000000;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-qr5b {
            border-color: #000000;
            font-size: xx-small;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-m68c {
            border-color: #000000;
            font-size: xx-small;
            font-weight: bold;
            text-align: center;
            vertical-align: top
        }
    </style>
    <table class="tg" style="undefined;table-layout: fixed; width: 718px">
        <colgroup>
            <col style="width: 140.333333px">
            <col style="width: 94.333333px">
            <col style="width: 145.333333px">
            <col style="width: 44.333333px">
            <col style="width: 293.333333px">
        </colgroup>
        <thead>
            <tr>
                <th class="tg-cope" colspan="5">FORM CHECKLIST PM OSP RITEL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-73oq" colspan="5">PT INDONESIA COMNETS PLUS<br>SBU REGIONAL SUMATERA BAGIAN UTARA<br>
                </td>
            </tr>
            <tr>
                <td class="tg-qr5b">Nama</td>
                <td class="tg-qr5b">{{ $user['name'] }}<br></td>
                <td class="tg-qr5b" colspan="3">Lokasi Cluster : {{ $olt['nama_olt'] }}</td>
            </tr>
            <tr>
                <td class="tg-qr5b">Tanggal Preventive<br></td>
                <td class="tg-qr5b">{{ date('d M Y', strtotime($tgl_mulai)) }}<br></td>
                <td class="tg-qr5b" colspan="3">Koordinat{{ $olt['lat'] }} ,{{ $olt['lng'] }}<br></td>
            </tr>
            <tr>
                <td class="tg-m68c">No</td>
                <td class="tg-m68c">Kategori</td>
                <td class="tg-m68c">Item Pengecekan</td>
                <td class="tg-m68c">Status</td>
                <td class="tg-m68c">Keterangan</td>
            </tr>
            <tr>
                <td class="tg-4w8t">1</td>
                <td class="tg-4w8t" rowspan="7">OLT<br></td>
                <td class="tg-qr5b">Kondisi Modul OLT</td>
                <td class="tg-qr5b">{{ $kondisi_modul_olt }}</td>
                <td class="tg-qr5b">{{ $catatan_modul_olt }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">2<br></td>
                <td class="tg-qr5b">Kondisi Port OLT</td>
                <td class="tg-qr5b">{{ $kondisi_port_olt }}</td>
                <td class="tg-qr5b">{{ $catatan_port_olt }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">3<br></td>
                <td class="tg-qr5b">Kondisi All SPF OLT</td>
                <td class="tg-qr5b">{{ $kondisi_all_sfp_olt }}</td>
                <td class="tg-qr5b">{{ $catatan_all_sfp_olt }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">5</td>
                <td class="tg-qr5b">Kondisi Power Supply OLT</td>
                <td class="tg-qr5b">{{ $kondisi_ps_olt }}</td>
                <td class="tg-qr5b"></td>
            </tr>
            <tr>
                <td class="tg-4w8t">6</td>
                <td class="tg-qr5b">Kondisi Battery OLT</td>
                <td class="tg-qr5b">{{ $kondisi_bat_olt }}</td>
                <td class="tg-qr5b">{{ $catatan_bat_olt }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">7</td>
                <td class="tg-qr5b">Battery Terbackup</td>
                <td class="tg-qr5b">{{ $kondisi_bat_bck_olt }}</td>
                <td class="tg-qr5b">{{ $catatan_bat_bck_olt }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">8</td>
                <td class="tg-qr5b">Suhu Dalam Kabinet</td>
                <td class="tg-qr5b">{{ $kondisi_suhu_kabinet }}</td>
                <td class="tg-qr5b">{{ $catatan_suhu_kabinet }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">9</td>
                <td class="tg-4w8t" rowspan="10">KABEL FEEDER<br></td>
                <td class="tg-qr5b">Pengecekan Kabel Feeder</td>
                <td class="tg-qr5b">{{ $kabel_jatuh }}</td>
                <td class="tg-qr5b">{{ $catatan_kabel_jatuh }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">10</td>
                <td class="tg-qr5b">Ada Andongan</td>
                <td class="tg-qr5b">{{ $kabel_andongan }}</td>
                <td class="tg-qr5b">{{ $catatan_kabel_andongan }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">11</td>
                <td class="tg-qr5b">Ada Kabel Putus</td>
                <td class="tg-qr5b">{{ $kabel_putus }}</td>
                <td class="tg-qr5b">{{ $catatan_kabel_putus }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">12</td>
                <td class="tg-qr5b">Kondisi Kabel Bagus</td>
                <td class="tg-qr5b">{{ $kondisi_kabel }}</td>
                <td class="tg-qr5b">{{ $catatan_kondisi_kabel }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">13</td>
                <td class="tg-qr5b">Accessories Terpasang Semua</td>
                <td class="tg-qr5b">{{ $kabel_acc }}</td>
                <td class="tg-qr5b">{{ $catatan_kabel_acc }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">14</td>
                <td class="tg-qr5b">Accessories Kondisi Bagus</td>
                <td class="tg-qr5b">{{ $kondisi_acc }}</td>
                <td class="tg-qr5b">{{ $catatan_kondisi_acc }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">15</td>
                <td class="tg-qr5b">Terdapat JB</td>
                <td class="tg-qr5b">{{ $jb }}</td>
                <td class="tg-qr5b">{{ $catatan_jb }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">16</td>
                <td class="tg-qr5b">Kondisi JB</td>
                <td class="tg-qr5b">{{ $kondisi_jb }}</td>
                <td class="tg-qr5b">{{ $catatan_kondisi_jb }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">17</td>
                <td class="tg-qr5b">Semua Core Tersambung</td>
                <td class="tg-qr5b">{{ $core_jb }}</td>
                <td class="tg-qr5b">{{ $catatan_core_jb }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">18</td>
                <td class="tg-qr5b">Posisi JB Terpasang Rapi</td>
                <td class="tg-qr5b">{{ $posisi_jb }}</td>
                <td class="tg-qr5b">{{ $catatan_posisi_jb }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">19</td>
                <td class="tg-4w8t" rowspan="4">FDT<br></td>
                <td class="tg-qr5b">Box FDT Tertutup Rapat</td>
                <td class="tg-qr5b">{{ $box_fdt }}</td>
                <td class="tg-qr5b">{{ $catatan_box_fdt }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">20</td>
                <td class="tg-qr5b">Box FDT Keadaan Bersih</td>
                <td class="tg-qr5b">{{ $kebersihan_fdt }}</td>
                <td class="tg-qr5b">{{ $catatan_kebersihan_fdt }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">21</td>
                <td class="tg-qr5b">All Port FDT Berfungsi ada redaman</td>
                <td class="tg-qr5b">{{ $all_port_fdt }}</td>
                <td class="tg-qr5b">{{ $catatan_all_port_fdt }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">22</td>
                <td class="tg-qr5b">Ada Port FDT Redaman Tinggi</td>
                <td class="tg-qr5b">{{ $port_fdt_redaman }}</td>
                <td class="tg-qr5b">{{ $catatan_port_fdt_redaman }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">23</td>
                <td class="tg-4w8t" rowspan="4">FAT</td>
                <td class="tg-qr5b">Box FAT Tertutup Rapat</td>
                <td class="tg-qr5b">{{ $box_fat }}</td>
                <td class="tg-qr5b">{{ $catatan_box_fat }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">24</td>
                <td class="tg-qr5b">Box FAT Keadaan Bersih/Rapih</td>
                <td class="tg-qr5b">{{ $kebersihan_fat }}</td>
                <td class="tg-qr5b">{{ $catatan_kebersihan_fat }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">25</td>
                <td class="tg-qr5b">All Port FAT Berfungsi ada redaman</td>
                <td class="tg-qr5b">{{ $all_port_fat }}</td>
                <td class="tg-qr5b">{{ $catatan_all_port_fat }}</td>
            </tr>
            <tr>
                <td class="tg-4w8t">26</td>
                <td class="tg-qr5b">Ada Port FAT Redaman Tinggi</td>
                <td class="tg-qr5b">{{ $port_fat_redaman }}</td>
                <td class="tg-qr5b">{{ $catatan_port_fat_redaman }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
