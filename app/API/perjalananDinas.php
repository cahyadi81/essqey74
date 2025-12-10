<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\API\karyawan;
use App\API\Karyawan\kry_d1;
use App\API\Dinas\header;


class perjalananDinas extends Model
{

    //get jumlah data yang harus di approve
    public function getJumlah($nik)
    {
        // $pd = DB::select(DB::raw("select count(b.nik_atasan) as jumlah
		// 	from perjalanan_dinas as a
		// 	left join kry_h as c ON c.nik = a.nik
		// 	left join kry_d1 as b ON b.kode_karyawan = c.kode_karyawan
        // 	where b.nik_atasan = '" . $nik . "' && a.approval = '0' "));
        // $pd = DB::select(DB::raw("select count(a.id) as jumlah
        // from dinas_h as a
        // left join kry_h as c ON c.nik = a.nik
        // left join kry_d1 as b ON b.kode_karyawan = c.kode_karyawan
        // where b.nik_atasan = '$nik' && status = '0' "));

        // $data = header::select("kry_h.nik")
        //     ->leftJoin('dinas_hotel', 'dinas_hotel.id_dinas', '=', 'dinas_h.id')
        //     ->leftJoin('dinas_transportasi', 'dinas_transportasi.id_dinas', '=', 'dinas_h.id')
        //     ->leftJoin('kry_h', 'kry_h.nik', '=', 'dinas_h.nik')
        //     ->leftJoin('kry_d1', 'kry_h.kode_karyawan', '=', 'kry_d1.kode_karyawan')
        //     ->where("kry_d1.nik_atasan","=",$nik)
        //     ->groupBy('dinas_h.nik')
        //     ->get();

        $datav = header::where('status','!=',1)->with('hotel','transportasi','approval')->get(); 

        // return $datav;
        $dataa = collect();
        if($datav){
            foreach($datav as $data1){
                if($data1->approval['atasan'] == $nik || $data1->approval['atasan2'] == $nik){
                    $dataa->push($data1);
                }
            }
        }

        $header = $dataa;

        // $nik_t = "";
        // // return $data;
        // $header = header::where('nik',$nik_t)->whereIn('status',['0','10'])->with('karyawan')->get();
        // if($data."" != "[]"){
        //     $nik_t = $data[0];
        //     $header = header::whereIn('nik',$nik_t)->whereIn('status',['0','10'])->with('karyawan')->get();
        // }
        
        //return $nik_t;

        //return $nik_t;
        // $datav = header::whereIn("nik",$nik_t)->with('hotel','transportasi')
        //     ->orderBy('status','asc')->orderBy('created_at','desc')->get(); 
        
        
        // $nik_atasan = $header[0]->kry_d1->nik_atasan;
        // $pds = count(header::where('nik',$nik_atasan)->with('hotel','transportasi'));
        // if ($pd == 0) {
        //     return 0;
        // }
        // return $pd;
        return $pd = array(['jumlah'=>count($header)]);
    }

    //get list data pengajuan
    public function getList($nik)
    {
        $date = date("Y");
        $pd = DB::select(DB::raw("select a.id,a.nik,c.nama_lengkap,b.nik_atasan,
			IFNULL((SELECT nama_lengkap FROM kry_h as bb WHERE bb.nik = b.nik_atasan),'-') as nama_atasan,
			a.kota_tujuan,a.tgl_from,a.tgl_to,
			a.approval, IF(a.approval = 0,'diproses',IF(a.approval = 1,'diterima',IF(a.approval = 2,'ditolak',''))) as status_approval
			from perjalanan_dinas as a
			left join kry_h as c ON c.nik = a.nik
			left join kry_d1 as b ON b.kode_karyawan = c.kode_karyawan where a.nik = '" . $nik . "'
			&& DATE_FORMAT(a.tgl_from, '%Y') = '$date'
			order by created_at DESC
			"));
        return $pd;
    }

    //get list data yang harus di approv
    public function getListApproval($nik)
    {
        $date = date("Y");
        $pd = DB::select(DB::raw("select a.id,a.nik,c.nama_lengkap,
			b.nik_atasan,
			IFNULL((SELECT nama_lengkap FROM kry_h as bb WHERE bb.nik = b.nik_atasan),'-') as nama_atasan,
			a.kota_tujuan,a.tgl_from,a.tgl_to,
			a.approval, IF(a.approval = 0,'diproses',IF(a.approval = 1,'diterima',IF(a.approval = 2,'ditolak',''))) as status_approval
			from perjalanan_dinas as a
			left join kry_h as c ON c.nik = a.nik
			left join kry_d1 as b ON b.kode_karyawan = c.kode_karyawan
			where b.nik_atasan = '" . $nik . "'
			&& a.approval = '0'
			&& DATE_FORMAT(a.tgl_from, '%Y') = '$date'
			order by created_at DESC
			"));
        return $pd;
    }

    //get detail data
    public function getDetail($id)
    {
        $pd = DB::select(DB::raw("select a.id,a.nik,c.nama_lengkap,
			b.nik_atasan,
			(SELECT nama_lengkap FROM kry_h as bb WHERE bb.nik = b.nik_atasan) as nama_atasan,
			b.departemen,
			c.lokasi_kerja,b.grade,a.kota_tujuan,a.tgl_from,a.tgl_to,a.penginapan,
			a.penginapan_biaya,a.transportasi_tipe,a.transportasi_ket,a.transportasi_biaya,
			b.nik_atasan,
			(SELECT aa.nama_lengkap from kry_h as aa where aa.nik = b.nik_atasan) as nama_atasan,
			a.approval, IF(a.approval = 0,'diproses',IF(a.approval = 1,'diterima',IF(a.approval = 2,'ditolak',''))) as status_approval,
			h.nm_pma as lokasi_kerja,
			i.nm_jabatan as jabatan,
			IFNULL(IF(j.nm_departement_ina='BLANK','-',j.nm_departement_ina),'-') as departemen
			from perjalanan_dinas as a
			left join kry_h as c ON c.nik = a.nik
			left join kry_d1 as b ON b.kode_karyawan = c.kode_karyawan
			left join pma as h ON h.kd_pma = c.lokasi_kerja
			left join jabatan as i ON i.kd_jabatan = b.jabatan
			left join departement as j ON j.kd_departement = b.departemen
			where a.id = '" . $id . "'"));
        return $pd;
    }

    //get atasan
    public function getAtasan($nik)
    {
        //return ($nik);
        $pd = DB::select(DB::raw("select nik_atasan
			from kry_h as a
			left join kry_d1 as b ON a.kode_karyawan = b.kode_karyawan
			where nik = '$nik'"));

        if ($pd == null) {
            return "";
		}
		foreach($pd as $p){
			return $p->nik_atasan;
		}
        
    }

    

    //get total from range tgl from & tgl to
    public function getTotal($tgl_from, $tgl_to)
    {
        $start_date = $tgl_from;
        $end_date = $tgl_to;
        $total_days = round(abs(strtotime($end_date) - strtotime($start_date)) / 86400, 0) + 1;
        $total = 0;
        if ($end_date >= $start_date) {
            for ($day = 0; $day < $total_days; $day++) {
                $total = $day;
            }
        }
        return $total;
    }

    public function getMin($nik)
    {
        $cuti = DB::select(DB::raw("SELECT min(tgl_from) as tgl_min FROM perjalanan_dinas WHERE nik = '$nik'"));
        if ($cuti == null) {return 0;}
        foreach ($cuti as $cut) {
            return $cut->tgl_min;
        }
    }

    public function getMax($nik)
    {
        $cuti = DB::select(DB::raw("SELECT min(tgl_to) as tgl_max FROM perjalanan_dinas WHERE nik = '$nik'"));
        if ($cuti == null) {return 0;}
        foreach ($cuti as $cut) {
            return $cut->tgl_max;
        }
    }

    public function cek($nik, $tgl_to, $tgl_from)
    {
        //if($this->cekDataCuti($nik)) {
        $tgl_min = $this->getMin($nik);
        $tgl_max = $this->getMax($nik);
        $pd = DB::select(
            DB::raw("SELECT * FROM perjalanan_dinas WHERE nik = '$nik' AND (tgl_from >= '$tgl_min' AND tgl_from <= '$tgl_max')
						AND (tgl_to >= '$tgl_min' AND tgl_to <= '$tgl_max')
						AND ((tgl_from between '$tgl_from' AND '$tgl_to') OR (tgl_to between '$tgl_from' AND '$tgl_to'))"));
        if (empty($cuti)) {
            return false;
        } else {
            return true;
        }
        //}else {
        //    return false;
        //}
    }

    public function cekId($id)
    {
        $cuti = DB::select(
            DB::raw("select * from perjalanan_dinas where id = '$id'"));
        if (!empty($cuti)) {
            return true;
        } else {
            return false;
        }
    }

    //get data nik
    public function getDataNik($nik)
    {
        $cuti = DB::select(DB::raw("SELECT b.nik_atasan, a.nik, a.nama_lengkap, b.kode_karyawan,c.kd_departement, 			c.nm_departement_ina, d.kd_jabatan, d.nm_jabatan
                                                FROM kry_h a
                                                LEFT JOIN kry_d1 b on a.kode_karyawan = b.kode_karyawan
                                                LEFT JOIN departement c on b.departemen = c.kd_departement
                                                LEFT JOIN jabatan d on b.jabatan = d.kd_jabatan
                                                WHERE a.nik = '$nik'"));
        return $cuti;
    }

    public function cekNikApproval($nik, $id)
    {
        $pd = DB::select(
            DB::raw("select b.nik_atasan
			from perjalanan_dinas as a
			left join kry_h as c ON c.nik = a.nik
			left join kry_d1 as b ON b.kode_karyawan = c.kode_karyawan
			where b.nik_atasan = '" . $nik . "' AND a.id = '" . $id . "'"));
        if (!empty($pd)) {
            return true;
        } else {
            return false;
        }
    }

    public function approve($id)
    {
        $sql = "UPDATE perjalanan_dinas SET approval = '1' WHERE id = '$id'";
        $appr = DB::update(DB::raw($sql));
        //$appr = DB::table('cuti_tbl')
        //                    ->where('id_cuti', $id_cuti)
        //                    ->update(['app_atsn' => 1]);
        if ($appr == 1) {
            return true;
        }
        return false;
    }

    public function decline($id)
    {
        $sql = "UPDATE perjalanan_dinas SET approval = '2' WHERE id = '$id'";
        $appr = DB::update(DB::raw($sql));
        //$appr = DB::table('cuti_tbl')
        //                    ->where('id_cuti', $id_cuti)
        //
        if ($appr) {
            return true;
        }
        return false;
    }

   

}
