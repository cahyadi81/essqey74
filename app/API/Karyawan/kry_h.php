<?php

namespace App\API\Karyawan;

use Illuminate\Database\Eloquent\Model;

use App\API\karyawan;

class kry_h extends Model
{
    //
    protected $table = 'kry_h';
    protected $primaryKey = 'kode_karyawan';
    public $incrementing = false;
    public $timestamps = false;

    // public function karyawan()
    // {
    //     return $this->where('kode_karyawan',header::primaryKey)->get();
    //     // $items = hotel::with('header')->get();
    // }

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
    
}
