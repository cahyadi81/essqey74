<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class izin extends Model
{

	public function getIzin($nik)
	{
		$izin = DB::select(DB::raw("select nik from atd_izin where tgl_izin >= '2018-02-01' AND tgl_izin_to <= now() AND nik = '".$nik."'"));
		if($izin == NULL) {
			return 0;
		}
		return count($izin);
	}

	public function getListIzin($nik)
	{
		$izin = DB::select(DB::raw("select a.id_izin,b.nik_atasan,
		(SELECT nama_lengkap FROM kry_h where nik = b.nik_atasan) as nama_atasan,
		a.tgl_izin,a.tgl_izin_to,
		a.flag_izin,
		IF(a.flag_izin='0','tidak masuk',
		IF(a.flag_izin='1','datang terlambat',
		IF(a.flag_izin='2','meninggalkan kantor','tidak absen'))) as kategori_izin,
		a.type_alasan,
		IF(a.type_alasan='0','sakit','lainnya') as nm_type_alasan,
		CONCAT(a.flag_approve1,'') as flag_status,
		IF(a.flag_approve1='0','pending',
		IF(a.flag_approve1='1','approved',
		IF(a.flag_approve1='2','rejected','not defined'))) as status
		from atd_izin as a
		LEFT JOIN kry_h as c ON c.nik = a.nik
		LEFT JOIN kry_d1 as b ON c.kode_karyawan = b.kode_karyawan
		where tgl_izin >= '2018-02-01' AND a.nik = '".$nik."'"));
		if($izin == NULL) {
			return 0;
		}
		return $izin;
	}
	
	public function getListIzinTerpakai($nik)
	{
		$izin = DB::select(DB::raw("select a.id_izin,b.nik_atasan,
		(SELECT nama_lengkap FROM kry_h where nik = b.nik_atasan) as nama_atasan,
		a.tgl_izin,a.tgl_izin_to,
		a.flag_izin,
		IF(a.flag_izin='0','tidak masuk',
		IF(a.flag_izin='1','datang terlambat',
		IF(a.flag_izin='2','meninggalkan kantor','tidak absen'))) as kategori_izin,
		a.type_alasan,
		IF(a.type_alasan='0','sakit','lainnya') as nm_type_alasan,
		CONCAT(a.flag_approve1,'') as flag_status,
		IF(a.flag_approve1='0','pending',
		IF(a.flag_approve1='1','approved',
		IF(a.flag_approve1='2','rejected','not defined'))) as status
		from atd_izin as a
		LEFT JOIN kry_h as c ON c.nik = a.nik
		LEFT JOIN kry_d1 as b ON c.kode_karyawan = b.kode_karyawan
		where a.tgl_izin >= '2018-02-01' AND a.tgl_izin_to <= now() AND flag_approve1 = '1' AND a.nik = '".$nik."'"));
		if($izin == NULL) {
			return 0;
		}
		return $izin;
	}
	
	public function getListApprovalIzin($nik)
	{
		$izin = DB::select(DB::raw("select a.id_izin,b.nik_atasan,a.tgl_izin,a.tgl_izin_to,
		a.flag_izin.
		IF(a.flag_izin='0','tidak masuk',
		IF(a.flag_izin='1','datang terlambat',
		IF(a.flag_izin='2','meninggalkan kantor','tidak absen'))) as kategori_izin,
		a.type_alasan,
		IF(a.type_alasan='0','sakit','lainnya') as nm_type_alasan,
		CONCAT(a.flag_approve1,'') as flag_status,
		IF(a.flag_approve1='0','pending',
		IF(a.flag_approve1='1','approved',
		IF(a.flag_approve1='2','rejected','not defined'))) as status		
		from atd_izin as a
		LEFT JOIN kry_h as c ON c.nik = a.nik
		LEFT JOIN kry_d1 as b ON c.kode_karyawan = b.kode_karyawan
		where tgl_izin >= '2018-02-01' AND b.nik_atasan = '".$nik."'"));
		if($izin == NULL) {
			return 0;
		}
		return $izin;
	}
	
	public function getDetailIzin($id)
	{
		$izin = DB::select(DB::raw("select 
		CONCAT(a.id_izin,'') as id_izin,b.nik_atasan,
		(SELECT nama_lengkap FROM kry_h where nik = b.nik_atasan) as nama_atasan,
		a.tgl_izin,a.tgl_izin_to,
		a.flag_izin,
		IF(a.flag_izin='0','tidak masuk',
		IF(a.flag_izin='1','datang terlambat',
		IF(a.flag_izin='2','meninggalkan kantor','tidak absen'))) as kategori_izin,
		a.type_alasan,
		IF(a.type_alasan='0','sakit','lainnya') as nm_type_alasan,
        a.jam_tk_from,
        a.jam_tk_to,
        a.alasan,
		IF(a.type_alasan='0','ada keterangan dokter',
		IF(a.type_alasan='1','tidak ada keterangan dokter',
		IF(a.type_alasan='','',''))) as ket_alasan,
        a.alasan_sub,
        CONCAT(a.potongan_cuti,'') as potongan_cuti,
        CONCAT(a.flag_approve1,'') as flag_status,
		IF(a.flag_approve1='0','pending',
		IF(a.flag_approve1='1','approved',
		IF(a.flag_approve1='2','rejected','not defined'))) as status,
        CONCAT(a.s,'') as sakit,
        CONCAT(a.i,'') as izin,
        CONCAT(a.period_gaji,'') as periode_gaji
		from atd_izin as a
		LEFT JOIN kry_h as c ON c.nik = a.nik
		LEFT JOIN kry_d1 as b ON c.kode_karyawan = b.kode_karyawan
		where id_izin = '".$id."'"));
		if($izin == NULL) {
			return 0;
		}
		return $izin;
	}
	
	public function checkAccessNik($nik,$id)
	{
		$izin = DB::select(DB::raw("select c.nik_atasan from atd_izin as a
		left join kry_h as b on b.nik = a.nik
		left join kry_d1 as c on c.kode_karyawan = b.kode_karyawan
		where a.id_izin = '".$id."' AND c.nik_atasan = '$nik'"));
		if($izin == NULL) {
			return false;
		}
		if(count($izin) != 0) {
			return true;
		}
		return false;
	}

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing("atd_izin");
    }
	
	public function getTotal($tgl_from,$tgl_to)
	{
		$start_date = $tgl_from;
		$end_date = $tgl_to;
		$total_days = round(abs(strtotime($end_date) - strtotime($start_date)) / 86400, 0) + 1;
		$total = 0;
		if ($end_date >= $start_date)
		{
		  for ($day = 0; $day < $total_days; $day++)
		  {
			$total = $day;
		  }
		}
		return $total;
	}
	
	public function approve($id_izin)
	{	
		$sql = "UPDATE atd_izin SET flag_approve1 = '1' WHERE id_izin = '$id_izin'";
		$appr = DB::update(DB::raw($sql));
		//$appr = DB::table('cuti_tbl')
		//					->where('id_cuti', $id_cuti)
		//					->update(['app_atsn' => 1]);
		if($appr == 1) {
			return true;
		}
		return false;
	}
	
	public function reject($id_izin)
	{	
		$sql = "UPDATE atd_izin SET flag_approve1 = '2' WHERE id_izin = '$id_izin'";
		$appr = DB::update(DB::raw($sql));
		//$appr = DB::table('cuti_tbl')
		//					->where('id_cuti', $id_cuti)
		//					->update(['app_atsn' => 1]);
		if($appr == 1) {
			return true;
		}
		return false;
	}
	
	public function pending($id_izin)
	{	
		$sql = "UPDATE atd_izin SET flag_approve1 = '0' WHERE id_izin = '$id_izin'";
		$appr = DB::update(DB::raw($sql));
		//$appr = DB::table('cuti_tbl')
		//					->where('id_cuti', $id_cuti)
		//					->update(['app_atsn' => 1]);
		if($appr == 1) {
			return true;
		}
		return false;
	}
}
