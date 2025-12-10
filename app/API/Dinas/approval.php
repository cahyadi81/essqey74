<?php

namespace App\API\Dinas;

use Illuminate\Database\Eloquent\Model;
use App\API\karyawan;

class approval extends Model
{
    //
    protected $table = 'dinas_approval';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'nik', 'kota_tujuan', 'jumlah_hari','keperluan'
    // ];

    public function karyawan()
    {
        return $this->hasOne(karyawan::class,'nik')->with('kry_d1');
    }
}
