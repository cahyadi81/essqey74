<?php

namespace App\API\Karyawan;

use Illuminate\Database\Eloquent\Model;

use App\API\karyawan;

class kry_d5 extends Model
{
    //
    protected $table = 'kry_d5';
    protected $primaryKey = 'kode_karyawan';
    public $incrementing = false;
    public $timestamps = false;

    // public function karyawan()
    // {
    //     return $this->where('kode_karyawan',header::primaryKey)->get();
    //     // $items = hotel::with('header')->get();
    // }

    public function nama_lengkap(){
        return karyawan::where("nik",$this->nik_atasan)->first();
    }

    public function karyawan()
    {
        return $this->belongsTo(\App\API\karyawan::class, 'kode_karyawan', 'kode_karyawan');
    }

    // melisa
    public function atasan(){
        return $this->hasOne(karyawan::class, 'nik', 'nik_atasan');
    }
    
}
