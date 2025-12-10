<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\API\Karyawan\kry_h;
use Faker\Test\Provider\Collection;

class absensi extends Model
{

    public function getAbsensiRekap($nik, $periode = null)
    {
        $cust = kry_h::where('nik',$nik)->with('kry_d1')->first()->kry_d1->kd_customer;
        // return $cust;
        $absensi = DB::select(DB::raw("select nik,
        CONCAT(MIN(b.cutt_off_from),CONCAT(' s/d ',MAX(b.cutt_off_until))) as periode,
		CONCAT(a.hke,'') as hke,
		CONCAT(a.flag_msk,'') as hk,
		CONCAT(a.flag_izn,'') as izin,
		CONCAT(a.flag_skt,'') as `cuti/skd`,
		CONCAT(a.flag_alf,'') as alfa,
        CONCAT(a.flag_ovr,'') as lembur
        from absen_rkp as a
        left join kalender_d1 AS b on b.periode_id = a.th_bln
        where a.nik = '" . $nik . "' && a.th_bln = '" . $periode . "' && b.kd_customer = '$cust' 
        group by th_bln"));

        if(count($absensi) < 1){
            return array([
                'nik' => $nik,
                'periode' => '-',
                'hk' => '-',
                'hke' => '-',
                'izin' => '-',
                'cuti/skd' => '-',
                'alfa' => '-',
                'lembur' => '-',
            ]);
        }

        return $absensi;
    }

    public function getAbsensiDetail($nik, $periode = null)
    {
        $absensi = DB::select(DB::raw("select 
        a.*,IFNULL(b.ket,'-') as ket,IFNULL(b.status,'0') as status,
        IF(TIME_FORMAT(tmin,'%H:%i')='00:00','-',TIME_FORMAT(tmin,'%H:%i')) as tmin,
        IF(TIME_FORMAT(tmout,'%H:%i')='00:00','-',TIME_FORMAT(tmout,'%H:%i')) as tmout 
        from absen_det as a
        left join absen_det_desc as b on a.tgl = b.tgl and a.nik = b.nik
        where a.nik = '" . $nik . "' && th_bln = '" . $periode . "' order by a.tgl asc"));
        
        $arr = array();
        $coll = collect($absensi);
        
        foreach ($coll as $key => $value)
        {
            
            if($value->tgl >= date("Y-m-d")) {
                $coll->forget($key);
            }
        }
        
        // dd($coll);
        return $coll;
    }

    public function getAbsensi($nik, $periode)
    {
        $absensi = DB::select(DB::raw("select a.nik,
		CONCAT(MIN(b.cutt_off_from),CONCAT(' s/d ',MAX(b.cutt_off_until))) as periode,
		CONCAT(a.flag_msk,'') as hk,
		CONCAT(a.hke,'') as hke
		from absen_rkp as a
		left join kalender_d1 AS b on a.th_bln = b.periode_id
		where a.nik = '" . $nik . "' && a.th_bln = '" . $periode . "'
		group by a.th_bln"));

        if(count($absensi) < 1){
            return array([
                'nik' => $nik,
                'periode' => $periode,
                'hk' => '-',
                'hke' => '-',
            ]);
        }
        return $absensi;
    }

    public function getPeriodeList()
    {
        $date = Date("Y");$date2 = Date("Y")-1;
        $absensi = DB::select(DB::raw("select th_bln
        from absen_det
        where th_bln LIKE '%$date%' || th_bln LIKE '%$date2%'
		group by th_bln
		order by th_bln desc"));

        return $absensi;
    }

}
