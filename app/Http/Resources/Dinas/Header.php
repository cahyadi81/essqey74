<?php

namespace App\Http\Resources\Dinas;

use Illuminate\Http\Resources\Json\Resource;

use App\Http\Resources\Karyawan\Header as KaryawanResource;

use App\Http\Resources\Dinas\Hotel as HotelResource;
use App\Http\Resources\Dinas\Kasbon as KasbonResource;
use App\Http\Resources\Dinas\Transport as TransportResource;

use App\API\Karyawan\kry_h;

class Header extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($this);
        Resource::withoutWrapping();
        // setlocale (LC_MONETARY, 'id_ID');
        $flag_plane_t8 = '0';$flag_plane = '0';
        if(count($this->transportasi) > 0){
            foreach($this->transportasi as $trans) {
                $trans['harga'] = "".number_format($trans['harga'],0,',','.');
                if($trans['tipe_transport'] == 'pesawat'){
                    $flag_plane = '1';
                    if($trans['jam_berangkat'] < '08:00:00'){
                        $flag_plane_t8 = '1';
                    }
                }
            }
        }
        
        // return $this->kasbon;
        // return array();
        return [
            'id_dinas' => $this->id,
            'nik' => $this->nik,
            'nama_pengaju' => kry_h::where("nik",$this->nik)->first()->nama_lengkap,
            'kota_tujuan' => $this->kota_tujuan,
            'jumlah_hari' => $this->when($this->jumlah_hari != null,$this->jumlah_hari,0),
            'keperluan' => $this->keperluan,
            'jumlah_hotel' => count($this->hotel),
            'hotel' => HotelResource::collection($this->hotel),
            'jumlah_transport' => count($this->transportasi),
            'transportasi' => $this->transportasi,
            'flag_plane_t8' => $flag_plane == '0' && $flag_plane_t8 == '1' ? '1' : '0',
            'kasbon'=> new KasbonResource($this->kasbon),
            'atasan'=>count($this->approval) > 0 ? $this->approval->atasan : '-',
            'atasan2'=>count($this->approval) > 0 ? $this->approval->atasan2 : '-',
            'status_code'=>$this->status,
            'status_name'=>$this->convertStatusCode($this->status),
        ];
    }

    private function checkTest(){
		if(config('database.default') == "pma_testing"){
			return true;
		}
		return false;
	}

    private function convertStatusCode($code){
        $desc = ["diproses atasan kedua","diterima","ditolak"];
        if($this->checkTest() && $code  == 0){
            return "sedang diproses OFM";
        }
        if($code  == 10){
            return "diproses atasan pertama";
        }
        return $desc[$code];
    }
}
