<?php

namespace App\Http\Resources\Karyawan;

use Illuminate\Http\Resources\Json\Resource;

use App\API\karyawan;

class Atasan extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    
    public function toArray($request)
    {
        $data = [
            'nik' => $this->nik_atasan,
            'nama_lengkap' => karyawan::where("nik",$this->nik_atasan)->get()->nama_lengkap,
        ];
        return $data;

    }
}
