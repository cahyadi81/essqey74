<?php

namespace App\API\Goverment;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    //
    protected $table = 'hir_prop';
    protected $primaryKey = 'PROP_ID';
    public $incrementing = false;
	public $timestamps = false;

    // public function Kecamatan()
    // {
    //     return $this->belongsTo(Kecamatan::class,'id');
    //     // $items = hotel::with('header')->get();
    // }

    // public function Kelurahan()
    // {
    //     return $this->belongsTo(Kelurahan::class,'id');
    //     // $items = hotel::with('header')->get();
    // }

    // public function KotaKab()
    // {
    //     return $this->belongsTo(KotaKab::class,'id');
    //     // $items = hotel::with('header')->get();
    // }
    
}
