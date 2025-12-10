<?php

namespace App\API\Dinas;

use Illuminate\Database\Eloquent\Model;
use App\API\karyawan;

class kasbon extends Model
{
    //
    protected $table = 'dinas_kasbon';
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

}
