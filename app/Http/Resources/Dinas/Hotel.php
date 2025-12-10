<?php

namespace App\Http\Resources\Dinas;

use Illuminate\Http\Resources\Json\Resource;

class Hotel extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        setlocale (LC_MONETARY, 'id_ID');
        return [
            'kota_tujuan_hotel' => $this->kota_tujuan,
            'nama_hotel' => $this->nama_hotel,
            'periode' => $this->periode,
            'pembayaran_melalui' => $this->convertNamaPembayaran($this->pembayaran_melalui),
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'keperluan_hotel' => $this->keperluan_hotel,
            'harga' => number_format($this->harga,0,',','.'),
        ];
    }

    private function convertNamaPembayaran($code){
        $desc = ["Ditanggung Perusahaan","Pribadi/Rembes",""];
        return $desc[$code];
    }
}
