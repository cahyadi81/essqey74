<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class cuti extends Model
{

	protected $table = 'izin_cuti';
	protected $primaryKey = 'id';
	public $incrementing = false;
	public $timestamps = false;

	public function getJumlahIzinCuti($nik)
	{
		$date = date("Y");
		//$cuti = DB::select(DB::raw("select nik from cuti_tbl where atsn = '$nik'"));
		$izin = DB::select(DB::raw("select count(a.id) as jumlah
		from izin_cuti as a
		left join kry_h as b on b.nik = a.nik
		left join kry_d1 as c on c.kode_karyawan = b.kode_karyawan
		where a.atasan = '$nik' && a.status = '10' || a.atasan2 = '$nik' && a.status = '0'
                && DATE_FORMAT(a.tgl_from, '%Y') = '$date'"));
		//$jml = count($izin) + count($cuti);		
		//dd($izin);
		return $izin;
	}

	public function getSisaCuti($nik)
	{
		//tipe_pengajuan 0 = cuti , tipe_pengajuan 1 = izin
		$date1 = Date("Y");$date2 = Date("Y")-1;$date3 = Date("Y")+1;

		$izin = DB::select(DB::raw("select
		concat((12 - 0),'') as saldo_awal_cuti, 
		concat(sisa,'') as sisa_cuti,
		concat(hutang_cuti) as hutang_cuti,
		IFNULL(concat(cut_off_cuti,''),'') as cut_off_cuti,
		concat(tahun,'') as tahun_cuti,
		concat((12 - sisa),'') as cuti_terpakai,
		concat((5 - 0),'') as cuti_massal 
		
		from cuti_sisa
		where nik='$nik' && tahun IN('$date1','$date2','$date3')
		order by tahun asc
		"));
		// if(!$izin){
		// 	$izin = array([
		// 		'sisa_cuti'=> '0',
		// 		'saldo_awal_cuti'=> '0',
		// 		'hutang_cuti'=> '0',
		// 		'cut_off_cuti'=> '-',
		// 		'tahun_cuti'=> '-',
		// 		'cuti_terpakai'=>'0',
		// 		'cuti_massal'=>'0'
		// 	]);
		// }

		// if(!$izin){
		// 	$izin = [
		// 		'saldo_awal_cuti'
		// 		'sisa_cuti'
		// 	];
		// }
		return $izin;
	}

	public function getListIzin($nik)
	{
		$date = date("Y");
		$izin = DB::select(DB::raw("select a.nik,b.nama_lengkap,CONCAT(a.id,'') as id,tgl_from,alasan
		from izin_cuti as a
		LEFT JOIN kry_h as b on a.nik = b.nik
		where nik = '$nik'
		&& status = '1'
		&& tipe_pengajuan = '1'
		&& SUBSTR(tgl_from,0,4) <= '$date'
		ORDER BY created_at DESC"));
		return $izin;
	}

	public function getListCuti($nik)
	{
		$date = date("Y");
		$izin = DB::select(DB::raw("select a.nik,b.nama_lengkap,CONCAT(a.id,'') as id,tgl_from,alasan from izin_cuti as a
		LEFT JOIN kry_h as b on a.nik = b.nik
		where nik = '$nik'
		&& status = '1'
		&& tipe_pengajuan = '0'
		&& SUBSTR(tgl_from,0,4) <= '$date' ORDER BY created_at DESC"));
		return $izin;
	}

	public function getListIzinCuti($nik)
	{
		if(config('database.default') != "test"){
			return $this->getListIzinCutiTesting($nik);
		}

		$date = date("Y");$date2 = date("Y");$date3 = date("Y")+1;
		$nm_status = 'belum di proses oleh anda';

		$izin = DB::select(DB::raw("select a.nik,a.atasan,a.atasan2, b.nama_lengkap,
		CONCAT(a.id,'') as id,tgl_from,tgl_to,
		CONCAT(tipe_pengajuan,'') as tipe_pengajuan,
		IF(tipe_pengajuan = '0','cuti','izin') as nm_tipe_pengajuan,
		CONCAT(status,'') as status,
	  IF(status = '0' && atasan2 = '-',CONCAT('sedang diproses atasan ',atasan),
		IF(status = '0',CONCAT('sedang diproses atasan kedua ',''),
		IF(status = '10',CONCAT('sedang diproses atasan pertama ',''),
		IF(status = '1','diterima','ditolak')))) as nm_status
		from izin_cuti as a
		LEFT JOIN kry_h as b on a.nik = b.nik
		where a.nik = '$nik'
		&& DATE_FORMAT(tgl_from, '%Y') IN( '$date','$date2','$date3' ) 

		ORDER BY 
			
		#	CASE status
		#	WHEN 10 THEN 4
		#	WHEN 0 THEN 3
		#	WHEN 1 THEN 2
		#	ELSE 1
		#	END DESC, 
		#	tgl_from DESC,
			created_at DESC,
			b.nama_lengkap ASC"));
		// $order = array(10, 0, 1, 2);
    // $izin = $izin->sort(function ($a, $b) use ($order) {
    //             $pos_a = array_search($a['status'], $order);
    //             $pos_b = array_search($b['status'], $order);
    //             return $pos_a - $pos_b;
		// });
		
		return $izin;
	}

	public function getListIzinCutiApproval($nik)
	{
		if(config('database.default') != "test"){
			return $this->getListIzinCutiApprovalTesting($nik);
		}
		$date = date("Y");$date2 = date("Y");$date3 = date("Y")+1;
			
		$izin = DB::select(DB::raw("select a.*,b.nama_lengkap,CONCAT(a.id,'') as id,tgl_from,
			CONCAT(tipe_pengajuan,'') as tipe_pengajuan,
			IF(tipe_pengajuan = '0','cuti','izin') as nm_tipe_pengajuan,
			CONCAT(status,'') as status,
			IF(status = '10' && atasan = '$nik','anda belum memproses',
			IF(status = '0' && atasan2 = '$nik','anda belum memproses',

			IF(status = '0' && atasan = '$nik','anda telah memproses',
			IF(status = '10' && atasan2 = '$nik','anda telah memproses',

			IF(status = '10' && a.nik = '$nik','sedang diproses atasan pertama',
			IF(status = '0' && a.nik = '$nik','sedang diproses atasan kedua',
			IF(status = '1','diterima','ditolak'))))))) as nm_status
			,IFNULL(d.sisa,0) as sisa
			from izin_cuti as a
			left join kry_h as b on b.nik = a.nik
			left join kry_d1 as c on c.kode_karyawan = b.kode_karyawan
			left join cuti_sisa as d on d.nik = b.nik
			where a.atasan = '$nik' || a.atasan2 = '$nik'  
			
			&& DATE_FORMAT(a.tgl_from, '%Y') IN( '$date','$date2','$date3' ) 
			ORDER BY 
			CASE status
			#10 = pending atasan && 0 = pending atasan 2
			WHEN 0 AND atasan2 = '$nik' or atasan != '$nik' THEN 1
			WHEN 10 AND atasan = '$nik' or atasan2 != '$nik' THEN 2
			WHEN 1 THEN 3
			WHEN 2 THEN 4
			END ASC,
			created_at DESC,
			b.nama_lengkap ASC"));
			
		//dd($izin);
		return $izin;
	}

	public function getDetailIzinCuti($id)
	{
		if(config('database.default') != "test"){
			return $this->getDetailIzinCutiTesting($id);
		}
		$izin = DB::select(DB::raw("select a.*,b.nama_lengkap,
		IF(tipe_pengajuan = '0','cuti','izin') as nm_tipe_pengajuan,
		IF(status = '0','sedang diproses atasan kedua',IF(status = '10','sedang diproses atasan pertama',IF(status = '1','diterima','ditolak'))) as nm_status,
		(SELECT nama_lengkap FROM kry_h WHERE nik = atasan) as nm_atasan,
		(SELECT nama_lengkap FROM kry_h WHERE nik = pengganti) as nm_pengganti
		,IFNULL(d.sisa,0) as sisa
		from izin_cuti as a
		left join kry_h as b on b.nik = a.nik
		left join cuti_sisa as d on d.nik = b.nik
		where a.id = '$id'"));

		return $izin;
	}

	private function conditionIzinType(){
		return "
			IF(izin_type = '0',CONCAT('Tidak Masuk Kerja',''),
				IF(izin_type = '1',CONCAT('Datang Terlambat',''),
					IF(izin_type = '2',CONCAT('Meninggalkan Kantor',''),
						IF(izin_type = '3','Keterangan Tidak Absen','-')
					)
				)
			) as nm_izin_type
		";
	}

	private function conditionCutiType(){
		return "
			IF(cuti_type = '0',CONCAT('Melahirkan',''),
				IF(cuti_type = '1',CONCAT('Menikah',''),
					IF(cuti_type = '2',CONCAT('Haid',''),
						IF(cuti_type = '3',CONCAT('Menikahkan/Istri Melayarkan/Keguguran/Khitanan Anak/Membatiskan Anak',''),
							IF(cuti_type = '4',CONCAT('suami/istri, orang tua/mertua, Anak/Menantu, Adik Kandung/Kakak Kandung meninggal dunia',''),
								IF(cuti_type = '5','anggota keluarga dalam satu rumah meninggal dunia','-')
							)
						)
					)
				)
			) as nm_cuti_type
		";
	}

	//testing
	public function getListIzinCutiTesting($nik)
	{
		$date = date("Y")-1;$date2 = date("Y");$date3 = date("Y")+1;
		$nm_status = 'belum di proses oleh anda';

		$izin = DB::select(DB::raw("select a.nik,
		a.atasan,a.atasan2, b.nama_lengkap,
		CONCAT(a.id,'') as id,tgl_from,tgl_to,
		CONCAT(tipe_pengajuan,'') as tipe_pengajuan,
		IFNULL((SELECT nama_lengkap FROM kry_h as cc WHERE cc.nik = a.atasan),'-') as nm_atasan,
		IF(tipe_pengajuan = '0','cuti',IF(tipe_pengajuan = '1','cuti khusus','izin')) as nm_tipe_pengajuan,
		CONCAT(status,'') as status,
		IF(status = '0' && atasan2 = '-',CONCAT('sedang diproses atasan ',atasan),
		IF(status = '0',CONCAT('sedang diproses atasan kedua ',''),
		IF(status = '10',CONCAT('sedang diproses atasan pertama ',''),
		IF(status = '1','diterima','ditolak')))) as nm_status,
		IFNULL(alamat,'-') as alamat,
		IFNULL(no_telp,'-') as no_telp,
		IFNULL(cuti_type,'-') as cuti_type,
		".$this->conditionCutiType().",
		IFNULL(request,'0') as request,
		IFNULL(izin_type,'-') as izin_type,
		".$this->conditionIzinType().",
		IFNULL(time_late,'-') as time_late,
		IFNULL(time_leave_from,'-') as time_leave_from,
		IFNULL(time_leave_to,'-') as time_leave_to
		from izin_cuti as a
		LEFT JOIN kry_h as b on a.nik = b.nik
		left join cuti_det as e on e.cuti_id = a.id
		left join izin_det as f on f.izin_id = a.id
		where a.nik = '$nik'
		#&& DATE_FORMAT(tgl_from, '%Y') IN( '$date','$date2','$date3' ) 

		ORDER BY 
			
		#	CASE status
		#	WHEN 10 THEN 4
		#	WHEN 0 THEN 3
		#	WHEN 1 THEN 2
		#	ELSE 1
		#	END DESC, 
		#	tgl_from DESC,
			created_at DESC,
			b.nama_lengkap ASC"));
		// $order = array(10, 0, 1, 2);
    // $izin = $izin->sort(function ($a, $b) use ($order) {
    //             $pos_a = array_search($a['status'], $order);
    //             $pos_b = array_search($b['status'], $order);
    //             return $pos_a - $pos_b;
		// });
		
		return $izin;
	}

	public function getListIzinCutiApprovalTesting($nik)
	{
		$date = date("Y")-1;$date2 = date("Y");$date3 = date("Y")+1;
			
		$izin = DB::select(DB::raw("select a.*,
			b.nama_lengkap,CONCAT(a.id,'') as id,tgl_from,
			#IFNULL((SELECT cc.nama_lengkap FROM kry_h as cc WHERE cc.nik = a.atasan),'-') as nm_atasan,
			CONCAT(tipe_pengajuan,'') as tipe_pengajuan,
			IF(tipe_pengajuan = '0','cuti',IF(tipe_pengajuan = '1','cuti khusus','izin')) as nm_tipe_pengajuan,
			CONCAT(status,'') as status,

			IF(status = '0' && atasan = '$nik' && date_appr != '','anda telah memproses',
			IF(status = '10' && atasan2 = '$nik' && date_appr2 != '','anda telah memproses',

			IF(status = '0' && date_appr2 = '','anda belum memproses',
			IF(status = '10'  && date_appr = '','anda belum memproses',

			IF(status = '10','sedang diproses atasan pertama',
			IF(status = '0','sedang diproses atasan kedua',
			IF(status = '1','diterima','ditolak'))))))) as nm_status,
			IFNULL(alamat,'-') as alamat,
			IFNULL(no_telp,'-') as no_telp,
			IFNULL(cuti_type,'-') as cuti_type,
			".$this->conditionCutiType().",
			IFNULL(request,'0') as request,
			IFNULL(izin_type,'-') as izin_type,
			".$this->conditionIzinType().",
			IFNULL(time_late,'-') as time_late,
			IFNULL(time_leave_from,'-') as time_leave_from,
			IFNULL(time_leave_to,'-') as time_leave_to,
			IFNULL(d.sisa,0) as sisa
			from izin_cuti as a
			left join kry_h as b on b.nik = a.nik
			left join kry_d1 as c on c.kode_karyawan = b.kode_karyawan
			left join cuti_sisa as d on d.nik = b.nik
			left join cuti_det as e on e.cuti_id = a.id
			left join izin_det as f on f.izin_id = a.id
			where a.atasan = '$nik' || a.atasan2 = '$nik'  
			
			&& DATE_FORMAT(a.tgl_from, '%Y') IN('$date','$date2','$date3') 
			ORDER BY 
			tgl_from DESC,
			created_at DESC,
			CASE status
			#10 = pending atasan && 0 = pending atasan 2
			WHEN 0 AND atasan2 = '$nik' or atasan != '$nik' THEN 1
			WHEN 10 AND atasan = '$nik' or atasan2 != '$nik' THEN 2
			WHEN 1 THEN 3
			WHEN 2 THEN 4
			END ASC,
			b.nama_lengkap ASC"));
			
		//dd($izin);
		return $izin;
	}

	public function getDetailIzinCutiTesting($id)
	{
		$izin = DB::select(DB::raw("select a.*,
			IFNULL(a.date_appr,'-') as date_appr,
			IFNULL(a.date_appr2,'-') as date_appr2,
			CONCAT(a.status,'') as status,
			IFNULL((SELECT nama_lengkap FROM kry_h as cc WHERE cc.nik = a.atasan),'-') as nm_atasan,
			b.nama_lengkap,
			IF(tipe_pengajuan = '0','cuti',
			IF(tipe_pengajuan = '1','cuti khusus','izin')) as nm_tipe_pengajuan,
			IF(status = '0','sedang diproses atasan kedua',
			IF(status = '10','sedang diproses atasan pertama',
			IF(status = '1','diterima','ditolak'))) as nm_status,
			IFNULL(alamat,'-') as alamat,
			IFNULL(no_telp,'-') as no_telp,
			IFNULL(cuti_type,'-') as cuti_type,
			".$this->conditionCutiType().",
			IFNULL(request,'0') as request,
			IFNULL(izin_type,'-') as izin_type,
			".$this->conditionIzinType().",
			IFNULL(time_late,'-') as time_late,
			IFNULL(time_leave_from,'-') as time_leave_from,
			IFNULL(time_leave_to,'-') as time_leave_to,
			CONCAT(IFNULL(d.sisa,0),'') as sisa
			from izin_cuti as a
			left join kry_h as b on b.nik = a.nik
			left join cuti_sisa as d on d.nik = b.nik
			left outer join cuti_det as e on e.cuti_id = a.id
			left outer join izin_det as f on f.izin_id = a.id
			where a.id = '$id'"));

			// dd($izin);
		return $izin;
	}


	public function approveIzinCuti($id,$status,$status_bef = 0)
	{
		$status_b = cuti::where('id',$id)->first()->status;
		$sql = "UPDATE izin_cuti SET status = '$status' WHERE id = '$id'";

		if(config('database.default') == "pma_testing" || config('database.default') == "addroo"){
			$tgl_approv = date("Y-m-d H:i:s");
			$tgl = "";
			if($status_b == 0){
				$tgl = ",date_appr2 = '$tgl_approv'";
			}else if($status_b == 10){
				$tgl = ",date_appr = '$tgl_approv'";
			}
			$sql = "UPDATE izin_cuti SET status = '$status' $tgl WHERE id = '$id' ";
		}
		
		
		$appr = DB::update(DB::raw($sql));
		if($appr == 1) {
			return true;
		}
		return false;
	}

	public function rejectIzinCuti($id)
	{
		$sql = "UPDATE izin_cuti SET status = '2' WHERE id = '$id'";
		$appr = DB::update(DB::raw($sql));
		if($appr == 1) {
			return true;
		}
		return false;
	}

	public function checkAccessNik($nik,$id)
	{
		$izin = DB::select(DB::raw("select * from izin_cuti where id = '".$id."' AND atasan = '$nik' || atasan2 = '$nik'"));
		if($izin == NULL) {
			return false;
		}
		if(count($izin) != 0) {
			return true;
		}
		return false;
	}

	public function validationReqCuti($nik,$jml_req)
	{
		$izin = DB::select(DB::raw("
		select sisa, hutang_cuti, cut_off_cuti, tanggal_masuk_kerja, datediff(tanggal_masuk_kerja,'D') as masa_kerja 

		from cuti_sisa as a
		left join kry_h as b on a.nik = b.nik
		left join kry_d1 as c on b.kode_karyawan = c.kode_karyawan
		where a.nik = '$nik' 
		"));

		 $DATA_NULL = 209;
		 $MASA_KERJA_KURANG = 210;
		 $STATUS_OK = 200;
		 $SISA_TRUE = 211;
		 $JUMLAH_REQ_LIMIT = 212;
		 $SISA_FALSE = 213;

		if($izin == null){
			return $DATA_NULL;
		}
		 //408 = data null
                //403 = masa kerja kurang
                //200 = ok
                //405 = sisa < jumlah req
                //409 = jumlah req > 5 berurutan
		foreach($izin as $data){
			if($data->sisa > 0 && $data->sisa >= $jml_req){
				if($data->masa_kerja > 365){
					return $MASA_KERJA_KURANG;
				}else{
					return $STATUS_OK;
				}
			}else if($data->sisa <= 0){
				return $SISA_FALSE;
			}else{
				return $SISA_TRUE;
			}
		}
		return 0;
	}

	public function getJumlahSisaCuti($nik)
	{
		$izin = DB::select(DB::raw("
		select sisa
		from cuti_sisa
		where nik = '$nik' 
		"));
		foreach($izin as $iz){
			return $iz->sisa;
		}
		return 0;
	}

	public function getJumlahHutangCuti($nik)
	{
		$izin = DB::select(DB::raw("
		select hutang_cuti
		from cuti_sisa
		where nik = '$nik' 
		"));
		foreach($izin as $iz){
			return $iz->hutang_cuti;
		}
		return 0;
	}

	public function getNikIzinCuti($id)
	{
		$izin = DB::select(DB::raw("
		select nik
		from izin_cuti
		where id = '$id' 
		"));
		foreach($izin as $iz){
			return $iz->nik;
		}
		return "-";
	}

	public function getTipePengajuan($id)
	{
		$izin = DB::select(DB::raw("select tipe_pengajuan from izin_cuti where id = '".$id."'"));
		foreach($izin as $iz){
			return $iz->tipe_pengajuan;
		}
		return 99999;
	}

	public function getJumlahRequest($id)
	{
		
		$izin = DB::select(DB::raw("select 
		a.tgl_to,
		a.tgl_from 
		from izin_cuti as a 
		where a.id = '".$id."'"));
		foreach($izin as $iz){
			$start = strtotime($iz->tgl_from);
			$end = strtotime($iz->tgl_to);

			// $kal = DB::select(DB::raw("select 
			// a.flag1 as jml_libur
			// from kalender as a 
			// where a.flag1 = '1' && a.tanggal between $iz->tgl_from AND $iz->tgl_to "));

			$jml_req = 0; 
			$jml_req = ceil(abs($end - $start) / 86400) + 1;
                
      $tgl_f =  date("Y-m-d", $start);
      $tgl_t =  date("Y-m-d", $end);
                
			$jml_libur = $this->jumlahLibur($tgl_f,$tgl_t);
			
			if($jml_req >= $jml_libur){
					$jml_req -= $jml_libur;
			}

			
			return $jml_req;
		}
		return 0;
	}

	public function jumlahLibur($first, $last, $step = '+1 day', $format = 'w' ) 
    {

        $startTime = strtotime( $first );
        $endTime = strtotime( $last );
        $jml = 0;

        // Loop between timestamps, 24 hours at a time
        // for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
        //     $thisDate = date( 'w', $i ); // 2010-05-01, 2010-05-02, etc
        //     if($thisDate == 0 || $thisDate == 6){
        //         $jml++;
        //     }
        // }
        $kalender = DB::table("kalender")
                    ->where('flag1',"=","1")
                    ->whereBetween('tanggal', [$first, $last])
                    ->get();
        foreach($kalender as $kal){
			$jml++;
        }
        return $jml;
    }

    public function jumlahMasuk($first, $last, $step = '+1 day', $format = 'w' ) 
    {

        $startTime = strtotime( $first );
        $endTime = strtotime( $last );
        $jml = 0;

        // Loop between timestamps, 24 hours at a time
        // for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
        //     $thisDate = date( 'w', $i ); // 2010-05-01, 2010-05-02, etc
        //     if($thisDate != 0 || $thisDate != 6){
        //         $jml++;
        //     }
        // }
        $kalender = DB::table("kalender")
                    ->where('flag1',"=","0")
                    ->whereBetween('tanggal', [$first, $last])
                    ->get();
        foreach($kalender as $kal){
			$jml++;
        }
        return $jml;
    }

	// public function createCutiSisa($nik)
	// {
	// 	$date = Date("Y");
	// 	$sql = "INSERT cuti_sisa values('','$nik','$date','12','','')";
	// 	$act = DB::insert(DB::raw($sql));
	// 	if($act == 1) {
	// 		return true;
	// 	}
	// 	return false;
	// }


	public function potongCuti($nik, $jml_req)
	{
		$sisa = $this->getJumlahSisaCuti($nik);
		$potong = $sisa - $jml_req; 
		$sql = "UPDATE cuti_sisa SET sisa = '$potong' WHERE nik = '$nik'";
		$act = DB::update(DB::raw($sql));
		if($act == 1) {
			return "true".$sql;
		}
		return $sisa."--".$jml_req." false".$sql;
	}

	public function tambahHutangCuti($nik, $jml_req)
	{
		$hutang = $this->getJumlahHutangCuti($nik);
		$sisa = $this->getJumlahSisaCuti($nik);

		$rate = $sisa - $jml_req;
		if($rate < 0) {
			$sisa = 0;
			$tambah = $hutang - $rate;
		}else {
			$tambah = $hutang + $jml_req;
		}
		$sql = "UPDATE cuti_sisa SET hutang_cuti = '$tambah', sisa = '$sisa' WHERE nik = '$nik'";
		$act = DB::update(DB::raw($sql));
		if($act == 1) {
			return true;
		}
		return false;
	}

	public function getCodeCust($nik){
			$query = DB::select(DB::raw("
			select kd_customer from kry_h left join kry_d1 on kry_d1.kode_karyawan = kry_h.kode_karyawan where kry_h.nik = $nik
			"));

			return $query['kd_customer'];
	}

	// public function getCalendar($kd_cust){
	// 	$query = DB::select(DB::raw("
	// 	select kd_customer from kry_h left join kry_d1 on kry_d1.kode_karyawan = kry_h.kode_karyawan where kry_h.nik = $nik
	// 	"));

	// 	return $query

	public function insertIntoTableCuti($id,$atasan2 = '-')
  {
		$query = DB::select(DB::raw("
		select 
		a.*, b.nama_lengkap, c.departemen, c.jabatan
		from izin_cuti as a
		left join kry_h as b on a.nik = b.nik
		left join kry_d1 as c on b.kode_karyawan = c.kode_karyawan
		where a.id = '".$id."'"));
						
		foreach($query as $dataq){
			$jml_req = $this->getJumlahRequest($id);
			$jml_libur = $this->jumlahLibur($dataq->tgl_from,$dataq->tgl_to);

			if($jml_req >= $jml_libur){
				$jml_req -= $jml_libur;
			}

			$delete = DB::table('cuti_tbl')->where('id_cuti',$id)->delete();

			$data = array(
				'id_cuti' => $id,
				'nik' => $dataq->nik,
				'kd_div' => $dataq->departemen,
				'kd_jabatan' => $dataq->jabatan,
				'alasan_cuti' => 'CUTI',
				'ajuan_cuti' => 'CT',
				'alamat_cuti' => '',
				'tgl_from' => $dataq->tgl_from,
				'tgl_to' => $dataq->tgl_to,
				'total_cuti' => $jml_req,
				'no_hp' => '-',
				'psnl' => $dataq->nama_lengkap,
				'app_psnl' => '-',
				'atsn' => $dataq->atasan,
				'app_atsn' => 1,
				'atsn2' => $atasan2,
				'app_atsn2' => 1,
				'last_update' => Date("Y-m-d H:i:s"),
				'user_update'=>'-'
			);
			$update = DB::table('cuti_tbl')->insert($data);
		}
        
  }

}
