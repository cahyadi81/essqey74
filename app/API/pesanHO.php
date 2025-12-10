<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\API\pesanHO_kry;

class pesanHO extends Model
{

	protected $table = 'pesan_ho';
	protected $primaryKey = 'id';
	public $incrementing = false;
	public $timestamps = false;


	public function pesan_kry()
  {
      return $this->hasMany(pesanHO_kry::class,'id','id_pesan_ho');
	}
		

	public function getTotalPesan($nik)
	{
		$pesan = DB::select(DB::raw("
		select count(a.id) as jumlah
		from pesan_ho as a
		LEFT JOIN pesan_ho_kry as b ON b.id_pesan_ho = a.id 
		LEFT JOIN kry_h as c ON c.nik = b.nik
		where c.nik = '$nik' AND b.read = '0'
		"));
		if($nik == NULL) {
			return 0;
		}
		return $pesan;
	}
	
	public function getPesan($nik)
	{
		$pesan = DB::select(DB::raw("
		select a.id,a.header,a.created_at,b.read,SUBSTRING(b.content,0,50) as pesan_content
		from pesan_ho as a
		LEFT JOIN pesan_ho_kry as b ON b.id_pesan_ho = a.id 
		LEFT JOIN kry_h as c ON c.nik = b.nik
		where c.nik = '$nik'
		group by a.id order by a.created_at desc
		"));
		if($nik == NULL) {
			return "";
		}
		return $pesan;
	}
	
	public function getDetailPesan($id,$nik)
	{
		DB::table('pesan_ho_kry')
            ->where('nik', $nik)->where('id_pesan_ho', $id)
            ->update(['read' =>1]);
		$pesan = DB::select(DB::raw("
		select a.*,B.read
		from pesan_ho as a
		LEFT JOIN pesan_ho_kry as b ON b.id_pesan_ho = a.id 
		LEFT JOIN kry_h as c ON c.nik = b.nik
		where a.id = '$id'
		group by a.created_at  desc
		"));
		if($pesan == NULL) {
			return "";
		}
		return $pesan;
	}

	

}
