<?php

namespace App\Http\Resources\Dinas;

use Illuminate\Http\Resources\Json\Resource;

use App\Http\Resources\Karyawan\Header as KaryawanResource;

use App\Http\Resources\Dinas\Hotel as HotelResource;
use App\Http\Resources\Dinas\Kasbon as KasbonResource;
use App\Http\Resources\Dinas\Transport as TransportResource;


use App\Http\Controllers\API\TokenController;

use App\API\karyawan;

class HeaderOnSelected extends Resource
{

    public function __construct($resource)
    {
        //$this->atasan = $natasan;

        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        // Resource::withoutWrapping();
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


        $data = [
            'id_dinas' => $this->id,
            'nik' => $this->nik,
            'nama_pengaju' => karyawan::where("nik",$this->nik)->first()->nama_lengkap,
            'kota_tujuan' => $this->kota_tujuan,
            'jumlah_hari' => $this->when($this->jumlah_hari != null,$this->jumlah_hari,0),
            'keperluan' => $this->keperluan,
            'jumlah_hotel' => count($this->hotel),
            'hotel' => HotelResource::collection($this->hotel),    
            'jumlah_transport' => count($this->transportasi),
            'transportasi' => $this->transportasi,
            'flag_plane_t8' => $flag_plane == '0' && $flag_plane_t8 == '1' ? '1' : '0',
            'kasbon'=> new KasbonResource($this->kasbon),
            'atasan'=>$this->approval->atasan,
            'atasan2'=>$this->approval->atasan2,
            'status_code'=>$this->status,
            // 'status_name'=>$this->status_name,
            'status_name'=>$this->convertStatusCode($this->status,$this->approval->atasan,$this->approval->atasan2,$this->nik),
        ];
        // array_flip($this);
        $data_n = "";
        return $data;
        // return $this->when(!$this->checkNikAtasan($this->getAtasan(),$this->nik),$data);
    }

    private function checkTest(){
		if(config('database.default') == "pma_testing"){
			return true;
		}
		return false;
	}

    private function getAtasan(){
        $token = new TokenController;
        $atasan = $token->getNikByToken($_SERVER['HTTP_AUTHORIZATION']);
        return $atasan;
    }
    

    private function checkNikAtasan($nik_atasan,$nik){
        if($nik_atasan == $nik){
            return true;
        }else{
            return false;
        }
    }

    private function convertStatusCode($code,$nik_appr1,$nik_appr2,$nik){
        $desc = ["diproses atasan kedua","diterima","ditolak"];
        // if($code == 10 && $nik_appr1 == $nik){
        //     return "anda telah memproses";
        // }else if($code == 10 && $nik_appr2 == $nik){
        //     return "anda belum memproses";
        // }else if($code == 0 && $nik_appr1 == $nik){
        //     return "anda belum memproses";
        // }else if($code == 0 && $nik_appr2 == $nik){
        //     return "anda telah memproses";
        // }
        if($this->checkTest() && $code  == 0){
            return "sedang diproses OFM";
        }
        if($code  == 10){
            return "sedang diproses atasan pertama";
        }
        return $desc[$code];
    }
}
