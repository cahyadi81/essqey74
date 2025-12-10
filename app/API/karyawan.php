<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\Karyawan\Header as KaryawanResources;

use App\API\Karyawan\kry_d1;

class karyawan extends Model
{

	protected $table = 'kry_h';
	protected $primaryKey = 'kode_karyawan';
	public $incrementing = false;
	public $timestamps = false;

	public function kry_d1()
	{	
		return $this->hasOne(\App\API\Karyawan\kry_d1::class, 'kode_karyawan', 'kode_karyawan');
	}

	public function kry_d2()
	{
		return $this->hasOne(\App\API\Karyawan\kry_d2::class, 'kode_karyawan', 'kode_karyawan');
	}

	public function kry_d3()
	{
		return $this->hasOne(\App\API\Karyawan\kry_d3::class, 'kode_karyawan', 'kode_karyawan');
	}

	public function kry_d4()
	{
		return $this->hasOne(\App\API\Karyawan\kry_d4::class, 'kode_karyawan', 'kode_karyawan');
	}

	public function kry_d5()
	{
		return $this->hasOne(\App\API\Karyawan\kry_d5::class, 'kode_karyawan', 'kode_karyawan');
	}

	public function kry_d6()
	{
		return $this->hasOne(\App\API\Karyawan\kry_d6::class, 'kode_karyawan', 'kode_karyawan');
	}

	public function kry_d7()
	{
		return $this->hasOne(\App\API\Karyawan\kry_d7::class, 'kode_karyawan', 'kode_karyawan');
	}

	
	public function getJumlahHariHabisKontrak($kode)
	{
		$karyawan = DB::select(DB::raw("select status_masuk_kerja_kontrak1,status_masuk_kerja_kontrak2 from kry_d1 where kode_karyawan = '".$kode."'"));
		$start_date = date("Ym");
		$end_date = "";
		foreach($karyawan as $kry) {
			if($this->getStatus($kode) == "KONTRAK 1") {
				$end_date = $kry->status_masuk_kerja_kontrak1;
			}else if($this->getStatus($kode) == "KONTRAK 2") {
				$end_date = $kry->status_masuk_kerja_kontrak2;
			}else if($kry->status_masuk_kerja_kontrak1 == "1970-01-01" || $kry->status_masuk_kerja_kontrak1 == "0000-00-00") {
				return 0;
			}else {
				return 0;
			}
		}
		$total_days = round(abs(strtotime($end_date) - strtotime($start_date)) / 86400, 0) + 1;
		$total = 0;
		if ($end_date >= $start_date)
		{
		  for ($day = 0; $day < $total_days; $day++)
		  {
			$total = $day;
		  }
		}
		return [
		'tanggal_habis_kontrak'=>$end_date,
		'jumlah_hari'=>$total
		];
	}

	public function getKode($nik)
	{
		$karyawan = DB::table('kry_h')->where("nik",$nik)->first();
		if(!$karyawan){
				return "";
		}
		return $karyawan->kode_karyawan;
	}
	
	public function getDetailStatus($kode)
	{
		$karyawan = DB::select(DB::raw("select b.nik,a.status_karyawan,
		DATE_FORMAT(a.tanggal_masuk_kerja, '%d-%m-%Y') as tanggal_masuk_kerja,
		IF(a.status_masuk_kerja_kontrak1 = '1970-01-01' OR '0000-00-00','-',a.status_masuk_kerja_kontrak1) as tanggal_habis_kontrak1,
		IF(a.status_masuk_kerja_kontrak2 = '1970-01-01' OR '0000-00-00','-',a.status_masuk_kerja_kontrak2) as tanggal_habis_kontrak2,
		IF(a.status_masuk_kerja_tetap = '1970-01-01' OR '0000-00-00','-',a.status_masuk_kerja_tetap) as tanggal_pengangkatan
		from kry_d1 as a
		left join kry_h as b on a.kode_karyawan = b.kode_karyawan
		where a.kode_karyawan = '".$kode."'"));
		return $karyawan;
	}
	
	public function getStatus($kode)
	{
		
		$karyawan = DB::select(DB::raw("select 
		a.status_masuk_kerja_kontrak1,
		a.status_masuk_kerja_kontrak2,
		b.nik,a.status_karyawan,
		DATE (now()) as start_date,
		
		#tanggal kontrak habis
		IF(a.status_karyawan = 'KONTRAK 1',a.status_masuk_kerja_kontrak1,
		IF(a.status_karyawan = 'KONTRAK 2',a.status_masuk_kerja_kontrak2,
		IF(a.status_masuk_kerja_kontrak1 = '1970-01-01' || a.status_masuk_kerja_kontrak1 = '0000-00-00',a.status_masuk_kerja_tetap,
		IF(a.status_masuk_kerja_kontrak2 = '1970-01-01' || a.status_masuk_kerja_kontrak2 = '0000-00-00',a.status_masuk_kerja_tetap,'0000-00-00')))) as end_date,
		
		#jumlah hari kontrak habis
		DATEDIFF(
			IF(a.status_karyawan = 'KONTRAK 1',a.status_masuk_kerja_kontrak1,
				IF(a.status_karyawan = 'KONTRAK 2',a.status_masuk_kerja_kontrak2,
					IF(a.status_masuk_kerja_kontrak1 = '1970-01-01' || a.status_masuk_kerja_kontrak1 = '0000-00-00',a.status_masuk_kerja_tetap,
						IF(a.status_masuk_kerja_kontrak2 = '1970-01-01' || a.status_masuk_kerja_kontrak2 = '0000-00-00',a.status_masuk_kerja_tetap,
							'0000-00-00')
						)
					)
				),
			DATE (now())
		)
		as jumlah_hari,

		#detail status
		DATE_FORMAT(a.tanggal_masuk_kerja, '%d-%m-%Y') as tanggal_masuk_kerja,
		IF(a.status_masuk_kerja_kontrak1 = '1970-01-01' OR '0000-00-00','-',a.status_masuk_kerja_kontrak1) as tanggal_habis_kontrak1,
		IF(a.status_masuk_kerja_kontrak2 = '1970-01-01' OR '0000-00-00','-',a.status_masuk_kerja_kontrak2) as tanggal_habis_kontrak2,
		IF(a.status_masuk_kerja_tetap = '1970-01-01' OR '0000-00-00','-',a.status_masuk_kerja_tetap) as tanggal_pengangkatan,

		#jumlah hari masa kerja
		DATEDIFF(NOW(), a.tanggal_masuk_kerja) as jumlah_masa_kerja

		from kry_d1 as a
		left join kry_h as b on a.kode_karyawan = b.kode_karyawan
		where a.kode_karyawan = '".$kode."'"));
		$start_date = date("Ym");
		foreach($karyawan as $kar) {
			$end_date = ($kar->end_date == "0000-00-00" || $kar->end_date == "1970-01-01") ? '0':$kar->end_date ;
			$total = ($kar->jumlah_hari < 1) ? 0:$kar->jumlah_hari;
			$jumlah_masa_kerja = ($kar->jumlah_masa_kerja < 1) ? 0 : $kar->jumlah_masa_kerja;


			// $masa_kerja = ($kar->status_masa_kerja_ko == "0000-00-00" || $kar->end_date == "1970-01-01") ? '0':$kar->end_date ;
			return [
				'nik'=>$kar->nik,
				'status'=>$kar->status_karyawan,
				'tanggal_habis_kontrak'=>$end_date,
				'jumlah_hari'=>$this->convert($total),
				'jumlah_masa_kerja'=>$this->convert($jumlah_masa_kerja),
				'tanggal_masuk_kerja'=>$kar->tanggal_masuk_kerja,
				'tanggal_habis_kontrak1'=>$kar->tanggal_habis_kontrak1,
				'tanggal_habis_kontrak2'=>$kar->tanggal_habis_kontrak2,
				'tanggal_pengangkatan'=>$kar->tanggal_pengangkatan,
			];
		}
	}

	function convert($sum) {
		$years = floor($sum / 365);
		$months = floor(($sum - ($years * 365))/30.5);
		$days = ($sum - ($years * 365) - ($months * 30.5));
		//echo “Days received: ” . $sum . “ days <br />”;
		return $years . " tahun " . $months . " bulan " . $days . " hari";
}
	
	public function getHR($kode)
	{
		$karyawan = DB::select(DB::raw("select b.*, 
		IF(b.tanggal_terminasi = '1970-01-01','0000-00-00',b.tanggal_terminasi) as tanggal_terminasi,
		IF(b.tanggal_mutasi = '1970-01-01','0000-00-00',b.tanggal_mutasi) as tanggal_mutasi,
		IF(b.status_masuk_kerja_tetap = '1970-01-01','0000-00-00',b.status_masuk_kerja_tetap) as status_masuk_kerja_tetap, 
		IF(b.status_masuk_kerja_kontrak1 = '1970-01-01','0000-00-00',b.status_masuk_kerja_kontrak1) as status_masuk_kerja_kontrak1,
		IF(b.status_masuk_kerja_kontrak2 = '1970-01-01','0000-00-00',b.status_masuk_kerja_kontrak2) as status_masuk_kerja_kontrak2,
		IF(b.status_masuk_kerja_tetap = '1970-01-01','0000-00-00',b.status_masuk_kerja_tetap) as status_masuk_kerja_tetap,
		IF(b.tanggal_promosi = '1970-01-01','0000-00-00',b.tanggal_promosi) as tanggal_promosi,
		(SELECT nama_lengkap FROM kry_h as bb WHERE bb.nik = b.nik_atasan) as nama_atasan,
		g.nm_customer as nm_customer,
		h.nm_pma as nm_lokasi_kerja,h.type_pma as type_lokasi_kerja,
		i.nm_jabatan as jabatan,
		j.nm_departement_ina as departemen
		from kry_d1 as b 
		left JOIN kry_h as a ON a.kode_karyawan = b.kode_karyawan
		LEFT JOIN hir_prop as c ON c.PROP_ID = b.id_prop
		LEFT JOIN hir_kec as d ON d.KEC_ID2 = b.id_kec
		LEFT JOIN hir_kab as e ON e.KAB_ID2 = b.id_kab
		LEFT JOIN hir_kel as f ON f.KEL_ID2 = b.id_kel
		LEFT JOIN customer as g ON g.kd_customer = b.kd_customer
		LEFT JOIN pma as h ON h.kd_pma = a.lokasi_kerja
		LEFT JOIN jabatan as i ON i.kd_jabatan = b.jabatan
		LEFT JOIN departement as j ON j.kd_departement = b.departemen
		where a.kode_karyawan = '".$kode."'
		group by a.nik"));
		// dd($karyawan);
		return $karyawan;
	}

	public function getKaryawan($nik)
	{
		$ds = config('database.default');
	
		$us = karyawan::where('nik',$nik)->first();
		//return "../foto_karyawan/".$ds."/thumb_".$us->kode_karyawan.".jpg";
		$imagepath = "thumb_".$us->kode_karyawan.".jpg";

		$kode = $us->kode_karyawan;
		$directoryPath = public_path("foto_karyawan/".$ds."/".$imagepath);

		// return $directoryPath;

		if(file_exists($directoryPath)){
			$file = "CONCAT(CONCAT('foto_karyawan/$ds/thumb_',a.kode_karyawan),'.jpg')";
		}else{
			$file =  "'foto_karyawan/thumb_default.png'";
		}

		$karyawan = DB::select(DB::raw("select a.*,
		$file as imgProfile,
		IFNULL(c.PROPINSI,'-') as propinsi,
		IFNULL(d.KECAMATAN,'-') as kecamatan,
		IFNULL(e.KABUPATEN,'-') as kabupaten,
		IFNULL(f.KELURAHAN,'-') as kelurahan,
		IFNULL(b.nm_pma,'-') as lokasi_kerja,
		aa.id_kec,aa.id_prop,aa.id_kab,aa.id_kel,
		IF(a.tanggal_nikah = '1970-01-01','0000-00-00',a.tanggal_nikah) as tanggal_nikah,
		IF(a.tanggal_lahir = '1970-01-01','0000-00-00',a.tanggal_lahir) as tanggal_lahir,
		IF(a.kadaluarsa_sim_a = '1970-01-01','0000-00-00',a.kadaluarsa_sim_a) as kadaluarsa_sim_a,
		IF(a.kadaluarsa_sim_b = '1970-01-01','0000-00-00',a.kadaluarsa_sim_b) as kadaluarsa_sim_b,
		IF(a.kadaluarsa_sim_c = '1970-01-01','0000-00-00',a.kadaluarsa_sim_c) as kadaluarsa_sim_c,
		IF(a.kadaluarsa_ktp = '1970-01-01','0000-00-00',a.kadaluarsa_ktp) as kadaluarsa_ktp,
		IF(a.kadaluarsa_passport = '1970-01-01','0000-00-00',a.kadaluarsa_passport) as kadaluarsa_passport
		from kry_h as a 
		LEFT JOIN pma as b ON b.kd_pma = a.lokasi_kerja
		LEFT JOIN kry_d1 as aa ON a.kode_karyawan = aa.kode_karyawan
		LEFT JOIN hir_prop as c ON c.PROP_ID = aa.id_prop
		LEFT JOIN hir_kec as d ON d.KEC_ID2 = aa.id_kec
		LEFT JOIN hir_kab as e ON e.KAB_ID2 = aa.id_kab
		LEFT JOIN hir_kel as f ON f.KEL_ID2 = aa.id_kel
		where a.kode_karyawan = '".$kode."'
		"));
	
		return [
			new KaryawanResources($karyawan[0])
		];
		
		// return $karyawan;
	}
	
	public function getKeluarga($kode)
	{
		$karyawan = DB::select(DB::raw("select * from kry_d2 where kode_karyawan = '".$kode."'"));
		
		return $karyawan;
	}

	public function getPendidikan($kode)
	{
		$karyawan = DB::select(DB::raw("select * from kry_d3 where kode_karyawan = '".$kode."'"));
		
		return $karyawan;
	}

	public function getOrganisasi($kode)
	{
		$karyawan = DB::select(DB::raw("select * from kry_d5 where kode_karyawan = '".$kode."'"));
		
		return $karyawan;
	}
	
	public function getPengalamanKerja($kode)
	{
		
		$karyawan = DB::select(DB::raw("
		select a.*,
		IFNULL(a.kode_karyawan,'-') as kode_karyawan, 
		IFNULL(a.nama_perusahaan,'-') as nama_perusahaan,
		IFNULL(a.alamat_perusahaan,'-') as alamat_perusahaan,
		IFNULL(a.kota,'-') as kota,
		IFNULL(a.telepon,'-') as telepon,
		IFNULL(a.jabatan_terakhir,'-') as jabatan_terakhir,
		IFNULL(a.tanggal_masuk,'-') as tanggal_masuk,
		IFNULL(a.tanggal_keluar,'-') as tanggal_keluar,
		IFNULL(a.alasan_keluar,'-') as alasan_keluar,
		FORMAT(IFNULL(a.gaji_terakhir,0), 0,'id_ID') as gaji_terakhir,
		IFNULL(a.nama_atasan,'-') as nama_atasan,
		IFNULL(a.last_update,'-') as last_update,
		IFNULL(a.user_update,'-') as user_update,
		
		IFNULL(b.job,'-') as job
		from kry_d6 as a
		LEFT JOIN kry_d7 as b ON b.kode_karyawan = a.kode_karyawan AND a.nama_perusahaan = b.nama_perusahaan
		where
		a.kode_karyawan = '".$kode."'
		group by 
		a.nama_perusahaan,
		a.tanggal_masuk"));
		
		return $karyawan;
	}
	
	public function getSkill($kode)
	{
		$karyawan = DB::select(DB::raw("select * from kry_d4 where kode_karyawan = '".$kode."'"));

		
		return $karyawan;
	}

	public function getEmployeeJourney($nik)
	{
		$karyawan = DB::select(DB::raw("select 
		DATE_FORMAT(a.tanggal_mutasi, '%d-%m-%Y') as tanggal_mutasi,
		IFNULL(d.nm_jabatan,'-') as nm_jabatan,
		IFNULL(c.nm_customer,'-') as nm_customer
		from journey_mutasi as a
		left join kry_h as b on a.nik = b.nik
		left join kry_d1 as e on e.kode_karyawan = b.kode_karyawan
		left join customer as c on e.kd_customer = c.kd_customer
		left join jabatan as d on d.kd_jabatan = a.jabatan_mutasi
		
		where b.nik = '".$nik."'"));
  		return $karyawan;
		/*$karyawan = [[
			'tanggal_mutasi'=>'00-00-0000',
			'nm_jabatan'=>'IT Developer Muda Bnaget',
   			'nm_customer'=>'PT. Pinus Merah Abadi',
		],[
			'tanggal_mutasi'=>'00-00-0000',
			'nm_jabatan'=>'IT Developer Muda Bnaget',
   			'nm_customer'=>'PT. Pinus Merah Abadi',
		],[
			'tanggal_mutasi'=>'00-00-0000',
			'nm_jabatan'=>'IT Developer Muda Bnaget',
   			'nm_customer'=>'PT. Pinus Merah Abadi',
		]];
		return $karyawan;*/
	}

}
