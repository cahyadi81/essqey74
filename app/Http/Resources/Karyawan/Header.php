<?php

namespace App\Http\Resources\Karyawan;

use Illuminate\Http\Resources\Json\Resource;


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
        return [
            "kode_karyawan" =>  $this->convertNull($this->kode_karyawan),
            "nik" =>  $this->convertNull($this->nik),
            "nama_lengkap" =>  $this->convertNull($this->nama_lengkap),
            "foto_karyawan" =>  $this->convertNull($this->foto_karyawan),
            "tempat_lahir" =>  $this->convertNull($this->tempat_lahir),
            "tanggal_lahir" =>  $this->convertNull($this->tanggal_lahir),
            "alamat_tinggal" =>  $this->convertNull($this->alamat_tinggal),
            "kodepos_tinggal" =>  $this->convertNoll($this->kodepos_tinggal),
            "alamat_ktp" =>  $this->convertNull($this->alamat_ktp),
            "kodepos_ktp" =>  $this->convertNoll($this->kodepos_ktp),
            "jenis_kelamin" =>  $this->convertNull($this->jenis_kelamin),
            "golongan_darah" =>  $this->convertNull($this->golongan_darah),
            "tinggi_badan" =>  $this->convertNoll($this->tinggi_badan),
            "berat_badan" =>  $this->convertNoll($this->berat_badan),
            "ukuran_baju" =>  $this->convertNull($this->ukuran_baju),
            "suku" =>  $this->convertNull($this->suku),
            "agama" =>  $this->convertNull($this->agama),
            "kebangsaan" =>  $this->convertNull($this->kebangsaan),
            "nomor_passport" =>  $this->convertNull($this->nomor_passport),
            "output_passport" =>  $this->convertNull($this->output_passport),
            "kadaluarsa_passport" =>  $this->convertNull($this->kadaluarsa_passport),
            "telpon_rmh_hp" =>  $this->convertNull($this->telpon_rmh_hp),
            "email" =>  $this->convertNull($this->email),
            "status_nikah" =>  $this->convertNull($this->status_nikah),
            "tanggal_nikah" =>  $this->convertNull($this->tanggal_nikah),
            "ibu_kandung" =>  $this->convertNull($this->ibu_kandung),
            "nomor_kk" =>  $this->convertNull($this->nomor_kk),
            "nomor_ktp" =>  $this->convertNull($this->nomor_ktp),
            "ktp_output" =>  $this->convertNull($this->ktp_output),
            "kadaluarsa_ktp" =>  $this->convertNull($this->kadaluarsa_ktp),
            "no_rekening" =>  $this->convertNull($this->no_rekening),
            "nama_bank" =>  $this->convertNull($this->nama_bank),
            "nomor_npwp" =>  $this->convertNull($this->nomor_npwp),
            "status_pajak" =>  $this->convertNull($this->status_pajak),
            "nomor_bpjs_krj" =>  $this->convertNoll($this->nomor_bpjs_krj),
            "nomor_bpjs_kes" =>  $this->convertNoll($this->nomor_bpjs_kes),
            "nomor_sim_a" =>  $this->convertNoll($this->nomor_sim_a),
            "output_sim_a" =>  $this->convertNull($this->output_sim_a),
            "kadaluarsa_sim_a" =>  $this->convertNull($this->kadaluarsa_sim_a),
            "nomor_sim_b" =>  $this->convertNoll($this->nomor_sim_b),
            "output_sim_b" =>  $this->convertNull($this->output_sim_b),
            "kadaluarsa_sim_b" =>  $this->convertNull($this->kadaluarsa_sim_b),
            "nomor_sim_c" =>  $this->convertNull($this->nomor_sim_c),
            "output_sim_c" =>  $this->convertNull($this->output_sim_c),
            "kadaluarsa_sim_c" =>  $this->convertNull($this->kadaluarsa_sim_c),
            "lokasi_kerja" =>  $this->convertNull($this->lokasi_kerja),
            "user_update" =>  $this->convertNull($this->user_update),
            "last_update" =>  $this->convertNull($this->last_update),
            "imgProfile" =>  $this->convertNull($this->imgProfile),
            "propinsi" =>  $this->convertNull($this->propinsi),
            "kecamatan" =>  $this->convertNull($this->kecamatan),
            "kabupaten" =>  $this->convertNull($this->kabupaten),
            "kelurahan" =>  $this->convertNull($this->kelurahan),
            "id_kec" =>  $this->convertNull($this->id_kec),
            "id_prop" =>  $this->convertNull($this->id_prop),
            "id_kab" =>  $this->convertNull($this->id_kab),
            "id_kel" =>  $this->convertNull($this->id_kel),
        ];
    }

    private function convertNull($string)
    {
        if($string == null){
            return "-";
        }
        return $string;
    }

    private function convertNoll($number)
    {
        if($number == null){
            return 0;
        }
        return $number;
    }

    private function convertDate($date)
    {
        if($number == null){
            return "";
        }
    }
}
