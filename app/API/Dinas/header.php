<?php

namespace App\API\Dinas;

use Illuminate\Database\Eloquent\Model;
use App\API\karyawan;

class header extends Model
{
    //
    protected $table = 'dinas_h';
    protected $primaryKey = 'nik';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'nik', 'kota_tujuan', 'jumlah_hari','keperluan'
    // ];

    public function hotel()
    {
        return $this->hasMany(hotel::class,'id_dinas','id');
    }

    public function transportasi()
    {
        return $this->hasMany(transportasi::class,'id_dinas','id');
    }

    public function karyawan()
    {
        return $this->hasOne(karyawan::class,'nik');
    }

    public function approval()
    {
        return $this->hasOne(approval::class,'id_dinas','id');
    }

    public function kasbon()
    {
        return $this->hasOne(kasbon::class,'id_dinas','id');
    }
}
