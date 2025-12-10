<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pesanHO_kry extends Model
{

	protected $table = 'pesan_ho_kry';
	protected $primaryKey = 'id';
	public $incrementing = false;
	public $timestamps = false;

	public function pesan()
  {
      return $this->hasOne(pesanHO_kry::class,'id','id_pesan_ho');
	}
	

}
