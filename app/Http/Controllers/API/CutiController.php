<?php

namespace App\Http\Controllers\API;

use App\API\cuti;
use App\API\FirebaseApi;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

use App\API\Karyawan\kry_h;
use App\API\Karyawan\kry_d1;

class CutiController extends Controller
{

    public function jumlahIzinCuti(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        $nik = $req->nik;
    
        $header = [
            'nik' => $nik,
            'tahun' => date("Y"),
        ];

        $cuti = new cuti();
        $data = $cuti->getJumlahIzinCuti($nik);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
        return Response::json(compact('header', 'data', 'status'), 200);
    }

    public function sisaIzinCuti(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        $nik = $req->nik;
        $header = [
            'nik' => $nik,
            'tahun' => date("Y"),
        ];
        // if ($token->cekToken($req->header('Authorization'))) {
            $cuti = new cuti();
            $data = $cuti->getSisaCuti($nik);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
            return Response::json(compact('header', 'data', 'status'), 200);
        // } else {
        //     $status = ['code' => 404, 'description' => 'Bad Request - token expired'];
        //     return Response::json(compact('header', 'data', 'status'), 404);
        // }
    }

    public function listIzinCuti(Request $req)
    {
        // dd($this->jumlahLibur("2018-01-01","2019-01-01"));
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

    
            $nik = $req->nik;
            $cuti = new cuti();
            $sisa_cuti = 0;
            $hutang_cuti = 0;
            $header = [
                'nik' => $nik,
                'tahun' => date("Y"),
            ];
            $data = $cuti->getListIzinCuti($nik);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
            return Response::json(compact('header', 'data', 'status'), 200);
        
    }

    public function listIzinCutiApproval(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        
        $nik = $req->nik;
        
        $header = [
            'nik' => $nik,
            'tahun' => date("Y"),
        ];
        // if ($token->cekToken($req->header('Authorization'))) {
            $cuti = new cuti();
            $data = $cuti->getListIzinCutiApproval($nik);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
            return Response::json(compact('header', 'data', 'status'), 200);
        // } else {
        //     $status = ['code' => 404, 'description' => 'Bad Request - token expired'];
        //     return Response::json(compact('header', 'data', 'status'), 404);
        // }
    }

    public function listIzin(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        $token = new TokenController();
        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $nik = $token->getNikByToken($req->header('Authorization'));
        if ($nik == 0) {
            $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $header = [
            'nik' => $nik,
            'tahun' => date("Y"),
        ];
        if ($token->cekToken($req->header('Authorization'))) {
            $cuti = new cuti();
            $data = $cuti->getListIzin($nik);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
            return Response::json(compact('header', 'data', 'status'), 200);
        } else {
            $status = ['code' => 404, 'description' => 'Bad Request - token expired'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
    }

    public function listCuti(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        $token = new TokenController();
        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $nik = $token->getNikByToken($req->header('Authorization'));
        if ($nik == 0) {
            $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $header = [
            'nik' => $nik,
            'tahun' => date("Y"),
        ];
        if ($token->cekToken($req->header('Authorization'))) {
            $cuti = new cuti();
            $data = $cuti->getListCuti($nik);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
            return Response::json(compact('header', 'data', 'status'), 200);
        } else {
            $status = ['code' => 404, 'description' => 'Bad Request - token expired'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
    }

    public function detailIzinCuti(Request $req)
    {
        $id = $req->id;
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        $nik = $req->nik;

        if (!isset($_GET["id"]) || $_GET['id'] == '') {
            $status = ['code' => 400, 'description' => 'Bad Request - id required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $header = [
            'id' => $id,
            'tahun' => date("Y"),
        ];
            $cuti = new cuti();
            $data = $cuti->getDetailIzinCuti($id);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
            return Response::json(compact('header', 'data', 'status'), 200);
        
    }

    public function validationReqCuti(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        $token = new TokenController();
        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }

        if ($token->cekToken($req->header('Authorization'))) {
            $nik = $token->getNikByToken($req->header('Authorization'));
            if ($nik == 0) {
                $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
                return Response::json(compact('header', 'data', 'status'), 404);
            }
            $cuti = new cuti();
            $sisa_cuti = 0;
            $hutang_cuti = 0;
            $header = [
                'nik' => $nik,
                'tahun' => date("Y"),
            ];
            $data = $cuti->getListIzinCuti($nik);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
            return Response::json(compact('header', 'data', 'status'), 200);
        } else {
            $status = ['code' => 404, 'description' => 'Bad Request - token expired'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
    }

    public function tanggalMerah($value) {
        date_default_timezone_set("Asia/Jakarta");
        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"),true);
        //check tanggal merah berdasarkan libur nasional
        $date = 0;
        if(isset($array[$value])){
            $date = 2;
        }else if(date("D",strtotime($value))==="Sun" || date("D",strtotime($value))==="Sat"){
            $date = 1;
        }

        return $date;
    }

    public function jumlahLibur($first, $last, $step = '+1 day', $format = 'w' ) 
    {

        $startTime = strtotime( $first );
        $endTime = strtotime( $last );
        $jml = 0;

        // Loop between timestamps, 24 hours at a time
        // for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
        //     $thisDate = date( 'w', $i ); // 2010-05-01, 2010-05-02, etc
        //     if($thisDate == 0 || $thisDate == 6){
        //         $jml++;
        //     }
        // }
        $kalender = DB::table("kalender")
                    ->where('flag1',"=","1")
                    ->whereBetween('tanggal', [$first, $last])
                    ->get();
        foreach($kalender as $kal){
			$jml++;
        }
        return $jml;
    }

    public function jumlahMasuk($first, $last, $step = '+1 day', $format = 'w' ) 
    {

        $startTime = strtotime( $first );
        $endTime = strtotime( $last );
        $jml = 0;

        // Loop between timestamps, 24 hours at a time
        // for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
        //     $thisDate = date( 'w', $i ); // 2010-05-01, 2010-05-02, etc
        //     if($thisDate != 0 || $thisDate != 6){
        //         $jml++;
        //     }
        // }
        $kalender = DB::table("kalender")
                    ->where('flag1',"=","0")
                    ->whereBetween('tanggal', [$first, $last])
                    ->get();
        foreach($kalender as $kal){
			$jml++;
        }
        return $jml;
    }

    public function getTanggalToCutiKhusus($tgl_from,$idx) {
        // dd($this->jumlahMasuk("2019-05-31",date('Y/m/d',strtotime("+4 day", strtotime("2019-05-31")))));
        //kurang 1 hari agar pas;;;
        // $tgl_from = date('Y/m/d', strtotime('-1 day', strtotime($tgl_from)));
        if($idx == 0){
            $target = '+89 day';

            $tgl_to = date('Y/m/d', strtotime($target, strtotime($tgl_from)));
            $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to);
            $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to);
            $tgl_to_new = "";
            // dd($jumlah_libur);
            for($i = 0;$i < 12;$i++){
                $tgl_to_new =  date('Y/m/d', strtotime("+$jumlah_libur day", strtotime($tgl_to)));
                $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to_new);
                if($jumlah_masuk != 90){
                    $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to_new);
                }
            }
            // dd($tgl_to_new);
            
            return $tgl_to_new;
        }else if($idx == 1){
            $target = '+0 day';
            $tgl_to = date('Y/m/d', strtotime($target, strtotime($tgl_from)));
            $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to);
            // $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to);
            $tgl_to_new = ""; $i = 0;
            for($i = 1;$i < 99;$i++){
                $tgl_to_new =  date('Y/m/d', strtotime("+$i day", strtotime($tgl_to)));
                
                $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to_new);
                $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to_new);

                if($jumlah_masuk == 3){
                    break;
                }
            }
            
            return $tgl_to_new;
        }else if($idx == 2){
            $target = '+0 day';
            $tgl_to = date('Y/m/d', strtotime($target, strtotime($tgl_from)));
            $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to);
            // $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to);
            $tgl_to_new = ""; $i = 0;
            for($i = 1;$i < 999999;$i++){
                $tgl_to_new =  date('Y/m/d', strtotime("+$i day", strtotime($tgl_to)));
                
                $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to_new);
                $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to_new);

                if($jumlah_masuk == 2){
                    break;
                }
            }
            
            return $tgl_to_new;
        }else if($idx == 3){
            $target = '+0 day';
            $tgl_to = date('Y/m/d', strtotime($target, strtotime($tgl_from)));
            $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to);
            // $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to);
            $tgl_to_new = ""; $i = 0;
            for($i = 1;$i < 999999;$i++){
                $tgl_to_new =  date('Y/m/d', strtotime("+$i day", strtotime($tgl_to)));
                
                $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to_new);
                $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to_new);

                if($jumlah_masuk == 2){
                    break;
                }
            }
            
            return $tgl_to_new;
        }else if($idx == 4){
            $target = '+0 day';
            $tgl_to = date('Y/m/d', strtotime($target, strtotime($tgl_from)));
            $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to);
            // $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to);
            $tgl_to_new = ""; $i = 0;
            for($i = 1;$i < 999999;$i++){
                $tgl_to_new =  date('Y/m/d', strtotime("+$i day", strtotime($tgl_to)));
                
                $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to_new);
                $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to_new);

                if($jumlah_masuk == 2){
                    break;
                }
            }
            
            return $tgl_to_new;
        }else if($idx == 5){
            $target = '+0 day';
            $tgl_to = date('Y/m/d', strtotime($target, strtotime($tgl_from)));
            $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to);
            // $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to);
            $tgl_to_new = ""; $i = 0;
            for($i = 1;$i < 9999999;$i++){
                $tgl_to_new =  date('Y/m/d', strtotime("+$i day", strtotime($tgl_to)));
                
                $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to_new);
                $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to_new);

                if($jumlah_masuk == 1){
                    break;
                }
            }
            
            return $tgl_to_new;
        }

        $tgl_to = date('Y/m/d', strtotime($target, strtotime($tgl_from)));
        $jumlah_libur = $this->jumlahLibur($tgl_from,$tgl_to);
        $tgl_to_new =  date('Y/m/d', strtotime("+$jumlah_libur day", strtotime($tgl_to)));
        $jumlah_libur_new = $this->jumlahLibur($tgl_from,$tgl_to_new);

        $jumlah_masuk = $this->jumlahMasuk($tgl_from,$tgl_to);
        if($jumlah_libur > 0 && $jumlah_masuk == 1){
            return date('Y/m/d', strtotime("+$jumlah_libur_new day", strtotime($tgl_to)));;
        }
        return $tgl_to;
    }

    public function requestIzinCuti(Request $req)
    {
        $request = $req;
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        $nik = $req->nik;

        $cuti = new cuti;

        $sisa_cuti = $cuti->getJumlahSisaCuti($nik);

        $ajuan_cuti = $req->ajuan_cuti;

        $tgl_from = $req->tgl_from;
        $tgl_from1 = date("Y/m/d", strtotime($tgl_from));
        $tgl_from2 = date("Y", strtotime($tgl_from));

        $tgl_to = $req->tgl_to;
        $tgl_to1 = date("Y/m/d", strtotime($tgl_to));
        @$tgl_11 = date("Y", strtotime($tgl_to));

        $tgl_from22 = date("d M Y", strtotime($tgl_from));
        $tgl_to22 = date("d M Y", strtotime($tgl_to));

        $start = strtotime($tgl_from);
        $end = strtotime($tgl_to);

        $status = 0;

        //jml count cuti izin table
        if(!cuti::orderBy('id', 'DESC')->first()){
            $j_cuti_izin = 1;
        }else{
            $j_cuti_izin = cuti::orderBy('id', 'DESC')->first()->id + 1;
        }
        
        if($j_cuti_izin < 1)
        {
            $j_cuti_izin = 1;
        }

        
            // $between = ceil(abs($end - $start) / 86400);

            if($start > $end){
                $status = ['code' => 211, 'description' => 'upload to izin cuti failed, periode awal lebih besar...!!!!'];
                return Response::json(compact('header', 'data', 'status'), 211);
            }
           
            $DATA_NULL = 209;
            $MASA_KERJA_KURANG = 210;
            $STATUS_OK = 200;
            $SISA_TRUE = 211;
            $JUMLAH_REQ_LIMIT = 212;
            $SISA_FALSE = 213;

            $kry = count(kry_h::where('nik',$nik)->with('kry_d1')->first()) < 1 ? '' : 
                        kry_h::where('nik',$nik)->with('kry_d1')->first();

            $kry_atasan = $kry == '' ? '' : $kry->kry_d1->nik_atasan;

            $atasan = count(kry_h::where('nik',$kry_atasan)->with('kry_d1')->first()) < 1 ? '' : 
                                kry_h::where('nik',$kry_atasan)->with('kry_d1')->first();

            $atasan_atasan = $atasan == '' ? '' : $atasan->kry_d1->nik_atasan;

            $atasan_tdk = count(kry_h::where('nik',$atasan_atasan)->with('kry_d1')->first()) < 1 ? '' : 
                                kry_h::where('nik',$atasan_atasan)->with('kry_d1')->first();
            
            $nik_atasan = $atasan == '' ? '-' : $kry_atasan;
            $nik_atasan2 = $atasan_tdk == '' ? '-' : $atasan_atasan;

            // return $nik_atasan;

            $start = strtotime($req->tgl_from);
            $end = strtotime($req->tgl_to);

            $now = strtotime(date("Y-m-d"));
            $jml_jedah = ceil(abs($start - $now) / 86400) + 1;

            if($now > $start){
                $status = $nik_atasan == '-' || $nik_atasan2 == '-' ? 0 :  10;
                if($nik_atasan2 == '-' || $nik_atasan2 == null || $nik_atasan2 == ''){
                    $status = 0;
                } 
            }
            else if($jml_jedah > 6){
                $nik_atasan2 = '-';
                $status = 10;
            }else{
                $status = $nik_atasan == '-' || $nik_atasan2 == '-' ? 0 :  10;
                if($nik_atasan2 == '-' || $nik_atasan2 == null || $nik_atasan2 == ''){
                    $status = 0;
                }
            }

            if(config('database.default') == "addroo"){
                $nik_atasan2 = "-";
            }

            $start = strtotime($req->tgl_from);
            $end = strtotime($req->tgl_to);

            $jml_req = ceil(abs($end - $start) / 86400) + 1;
                
            $tgl_f =  date("Y-m-d", strtotime($req->tgl_from));
            $tgl_t =  date("Y-m-d", strtotime($req->tgl_to));
                
            $jml_libur = $this->jumlahLibur($tgl_f,$tgl_t);
            if($jml_req >= $jml_libur){
                $jml_req -= $jml_libur;
            }
                
            if($jml_req < 1 && $req->tipe_pengajuan == 0){
                $status = ['code' => 402, 'description' => 'Bad Request - request cuti kurang dari 1'];
                return Response::json(compact('header', 'data', 'status'), 402);
            }else if($jml_req < 1 && $req->tipe_pengajuan == 2){
                $status = ['code' => 402, 'description' => 'Bad Request - request cuti kurang dari 1'];
                return Response::json(compact('header', 'data', 'status'), 402);
            }

            if ($req->tipe_pengajuan == 0) {
                 
                if(config('database.default') == "addroo"){
                    if ($cuti->validationReqCuti($nik, $jml_req) == $DATA_NULL) {
                        http_response_code($DATA_NULL);
                        $status = ['code' => $DATA_NULL, 'description' => 'Failed Request - data sisa tidak ada'];
                        return Response::json(compact('header', 'data', 'status'), $DATA_NULL);
                    } else if ($cuti->validationReqCuti($nik, $jml_req) == $MASA_KERJA_KURANG) {
                        http_response_code($MASA_KERJA_KURANG);
                        $status = ['code' => $MASA_KERJA_KURANG, 'description' => 'Failed Request - masa kerja kurang dari 1 tahun'];
                        return Response::json(compact('header', 'data', 'status'), $MASA_KERJA_KURANG);
                    } else if($jml_req > $sisa_cuti){
                        http_response_code($SISA_FALSE);
                        $status = ['code' => $SISA_FALSE, 'description' => 'Failed Request - sisa cuti kurang dari jumlah request'];
                        return Response::json(compact('header', 'data', 'status'), $SISA_FALSE);
                    }
                }

                // return $jml_req;
                if ($jml_req > 5) {
                    http_response_code($JUMLAH_REQ_LIMIT);
                    $status = ['code' => $JUMLAH_REQ_LIMIT, 'description' => 'Failed Request - overlimiti req cuti > 5'];
                    return Response::json(compact('header', 'data', 'status'), $JUMLAH_REQ_LIMIT);
                }
            }

            if(config('database.default') != "test"){
                $header = [
                    'id' => $j_cuti_izin,
                    'nik' => $nik,
                    'tgl_from' => $tgl_from1,
                    'tgl_to' => $tgl_to1,
                    'tipe_pengajuan' => $req->tipe_pengajuan,
                    'atasan' => $nik_atasan,
                    'atasan2' => $nik_atasan2,
                    'alasan' => $req->alasan,
                    'pengganti' => $req->pengganti,
                    'status' => $status,
                ];
            }else{
                $header = [
                    'id' => $j_cuti_izin,
                    'nik' => $nik,
                    'tgl_from' => $tgl_from1,
                    'tgl_to' => $tgl_to1,
                    'tipe_pengajuan' => $req->tipe_pengajuan,
                    'atasan' => $nik_atasan,
                    'alasan' => $req->alasan,
                    'pengganti' => $req->pengganti,
                    'status' => $status,
                ];
            }

            if($req->tipe_pengajuan == 0){
                $tipe_pengajuan = "CUTI";
            }else if($req->tipe_pengajuan == 1){
                $tipe_pengajuan = "CUTI KHUSUS";
                $header = [
                    'id' => $j_cuti_izin,
                    'nik' => $nik,
                    'tgl_from' => $tgl_from1,
                    'tgl_to' => $this->getTanggalToCutiKhusus($tgl_from1,$request->cuti_type),
                    'tipe_pengajuan' => $req->tipe_pengajuan,
                    'atasan' => $nik_atasan,
                    'atasan2' => $nik_atasan2,
                    'alasan' => $req->alasan,
                    'pengganti' => $req->pengganti,
                    'status' => $status,
                ];
            }else if($req->tipe_pengajuan == 2){
                $tipe_pengajuan = "IZIN";
            }

            // if(config('database.default') != "pma_testing"){
            //     $tipe_pengajuan = ($req->tipe_pengajuan == 0) ? "CUTI" : "IZIN";
            // } 
            

            $request = $req;
            $insert_cuti = cuti::insert($header);
            if ($insert_cuti) {
                $ins_cuti_izin = false;
                
                if($tipe_pengajuan == "CUTI KHUSUS" 
                // && config('database.default') == "pma_testing"
                )
                {
                    $head_det = [
                        'cuti_id' => $j_cuti_izin,
                        'cuti_type' => $request->cuti_type == null ? 0 : $request->cuti_type,
                        'request' => $jml_req ,
                        'alamat' => $request->alamat == null ? 0 : $request->alamat,
                        'no_telp' => $request->no_telp == null ? 0 : $request->no_telp,
                    ];
                    $ins_cuti_det = DB::table("cuti_det")->insert($head_det);
                    if($ins_cuti_det){
                        $ins_cuti_izin = true;
                    }
                }
                else if($tipe_pengajuan == "IZIN" 
                // && config('database.default') == "pma_testing"
                )
                {
                    $head_det = [
                        'izin_id' => $j_cuti_izin,
                        'izin_type' => $request->izin_type == null ? 0 : $request->izin_type,
                        'time_late' => $request->time_late == null ? '00:00' : $request->time_late,
                        'time_leave_from' => $request->time_leave_from == null ? '00:00' : $request->time_leave_from,
                        'time_leave_to' => $request->time_leave_to == null ? '00:00' : $request->time_leave_to,
                    ];
                    $ins_izin_det = DB::table("izin_det")->insert($head_det);
                    if($ins_izin_det){
                        $ins_cuti_izin = true;
                    }
                }
                else if($tipe_pengajuan == "CUTI" 
                // && config('database.default') == "pma_testing"
                )
                {
                    $head_det = [
                        'cuti_id' => $j_cuti_izin,
                        'cuti_type' => 99 ,//tipe for default
                        'request' => $jml_req ,
                        'alamat' => $request->alamat == null ? 0 : $request->alamat,
                        'no_telp' => $request->no_telp == null ? 0 : $request->no_telp,
                    ];
                    $ins_cuti_det = DB::table("cuti_det")->insert($head_det);
                    if($ins_cuti_det){
                        $ins_cuti_izin = true;
                    }
                }
                else{
                    $ins_cuti_izin = true;
                }
                if($ins_cuti_izin){
                    $status = ['code' => $STATUS_OK, 'description' => 'OK - Inserted'];
                    $device = DB::table('token_device')->where("nik", $nik_atasan)->first();
                    if($device){
                        $firebaseApi = new FirebaseApi();
                        $requestData = array(
                            'title' => "Pengajuan $tipe_pengajuan dari nik : $nik ",
                            'message' => "Pengajuan $tipe_pengajuan dari tanggal $tgl_from22 s/d $tgl_to22 ",
                            'image_url' => "",
                            'action' => "activity",
                            'action_destination' => "CutiIzinApprList",
                        );

                        $send_to = ($req->send_to == "" || $req->send_to == null) ? $req->send_to : "";

                        $device_tok = $device == null ? '' : $device->token;
                        $firebaseApi->postData($device_tok, $send_to, $requestData);
                    }
                }
                // $cuti->insertIntoTableCuti($j_cuti_izin);
                return Response::json(compact('header', 'data', 'status'), 200);
            } else {
                $status = ['code' => 400, 'description' => 'Bad Request - Failed Inserted'];
                return Response::json(compact('header', 'data', 'status'), 500);
            }

    }

    public function approvedIzinCuti(Request $req)
    {

        $DATA_NULL = 209;
        $MASA_KERJA_KURANG = 210;
        $STATUS_OK = 200;
        $SISA_TRUE = 211;
        $JUMLAH_REQ_LIMIT = 212;
        $SISA_FALSE = 213;

        $data = ['result' => ''];
        $status = ['code' => 200, 'description' => 'ok'];
        // $token = new TokenController();
        $id = $req->id;
        if (!isset($_REQUEST["id"]) || $_REQUEST['id'] == '') {
            $status = ['code' => 400, 'description' => 'Bad Request - id cuti required'];
            return Response::json(compact('header', 'data', 'status'), 500);
        }
        // if ($token->cekToken($req->header('Authorization'))) {
            $nik =  $req->nik;
            $cuti = new cuti();

            $status_appr = $req->status;

            $header = [
                'id' => $id,
                'status' => $status_appr,
            ];

                     


            if (!$cuti->checkAccessNik($nik, $id)) {
                $status = ['code' => 404, 'description' => 'Bad Request - NIK Not ACCESS'];
                return Response::json(compact('header', 'data', 'status'), 500);
            }
            
            $pengaju = count(cuti::where('id',$id)->first()) < 1 ? '' : 
                                    cuti::where('id',$id)->first();

            // return $pengaju->status;
            if($pengaju->status == 1 || $pengaju->status == 2) {
                $status = ['code' => 505, 'description' => 'status done, cant change'];
               return Response::json(compact('header', 'data', 'status'), 505);
            }

            if ($status_appr == 1) {
                
            
                    $kry = count(kry_h::where('nik',$pengaju->nik)->with('kry_d1')->first()) < 1 ? '' : 
                                    kry_h::where('nik',$pengaju->nik)->with('kry_d1')->first();
            
                    $kry_atasan = $kry == '' ? '' : $kry->kry_d1->nik_atasan;
                    $atasan = count(kry_h::where('nik',$kry_atasan)->with('kry_d1')->first()) < 1 ? '' : 
                                        kry_h::where('nik',$kry_atasan)->with('kry_d1')->first();
            
                    $kry_atasan_atasan = $atasan == '' ? '' : $atasan->kry_d1->nik_atasan;
                    $atasan_tdk = count(kry_h::where('nik',$kry_atasan_atasan)->with('kry_d1')->first()) < 1 ? '' : 
                                        kry_h::where('nik',$kry_atasan_atasan)->with('kry_d1')->first();// return $atasan_p;

                    $atasan_p = count(kry_h::with('kry_d1')->where('nik',$pengaju->atasan)->first()->kry_d1) < 1 ? '' : kry_h::with('kry_d1')->where('nik',$pengaju->atasan)->first()->kry_d1->nik_atasan;
                    $nik_atasan = $pengaju->atasan;
                    //testing mode
                    $nik_atasan2 = config('database.default') != "test" ? $pengaju->atasan2 : '';

                    $status_app = 0;
                    $status_pengaju = $pengaju->status;
                    if($pengaju->status == 10){
                        if($nik != $nik_atasan && config('database.default') != "test"){
                            $status = ['code' => 500, 'description' => 'NOt Access 1'];
                            return Response::json(compact('header', 'data', 'status'), 500);
                        }
                        $nik_atasan = $pengaju->atasan2;
                        $status_app = $nik_atasan2 == '' || $nik_atasan2 == '-' ? 1  : 0;
                    }else if($pengaju->status == 0) {
                        if($nik != $nik_atasan2 && config('database.default') != "test"){
                            $status = ['code' => 500, 'description' => 'NOt Access 2'];
                            return Response::json(compact('header', 'data', 'status'), 500);
                        }
                        $nik_atasan = $pengaju->atasan;
                        $status_app = 1;
                    }else if($pengaju->status == 1 && $pengaju->status == 2) {
                        $status = ['code' => 505, 'description' => 'status done, cant change'];
                        return Response::json(compact('header', 'data', 'status'), 505);
                    }
                    // return $status_app;

                $status_bef = $pengaju->status;
                if ($cuti->approveIzinCuti($id,$status_app,$status_bef)) {
                    //
                    
                    $status = ['code' => 200, 'description' => 'OK - Approved'];
                    //jika pengajuan cuti
                    if ($cuti->getTipePengajuan($id) == 0) {
                        
                        if($status_app == 1){
                            //jika sisa cuti kurang dari jumlah pengajuan
                            $jml_req = $cuti->getJumlahRequest($id);

                            $nik_siscut = $cuti->getNikIzinCuti($id);
                            $sisa = $cuti->getJumlahSisaCuti($nik_siscut);

                            if ($sisa < $jml_req) {
                                http_response_code($SISA_FALSE);
                                $cuti->potongCuti($nik_siscut, $jml_req);
                            } else {
                                //return $nik_siscut."fuck :".$sisa."<".$jml_req;
                                http_response_code($STATUS_OK);
                                $cuti->potongCuti($nik_siscut, $jml_req);
                            }

                            $cuti->insertIntoTableCuti($id);
                            $this->notifApproval($id); 
                        }else if($status_app != 10){
                            $this->notifApprovalAtasan($id,$nik_atasan);
                            // cuti::where('id',$id)->update(['atasan'=>$nik_atasan]);
                        }

                    }else{
                        if($status_app != 1){
                            $this->notifApprovalAtasan($id,$nik_atasan);
                            // cuti::where('id',$id)->update(['atasan'=>$nik_atasan]);
                        }else if($status_app == 1){
                            $this->notifApproval($id); 
                        }
                    }

                    return Response::json(compact('header', 'data', 'status'), 200);
                } else {
                    $status = ['code' => 200, 'description' => 'OK'];
                    return Response::json(compact('header', 'data', 'status'), 200);
                }
            } else if ($status_appr == 2) {
                if ($cuti->rejectIzinCuti($id)) {
                    $status = ['code' => 200, 'description' => 'OK - Rejected'];
                    $this->notifRejected($id);
                    return Response::json(compact('header', 'data', 'status'), 200);
                } else {
                    $status = ['code' => 200, 'description' => 'OK'];
                    return Response::json(compact('header', 'data', 'status'), 200);
                }
            }
        // } else {
        //     $status = ['code' => 400, 'description' => 'Bad Request - Token Not Valid'];
        //     return Response::json(compact('header', 'data', 'status'), 404);
        // }
    }

    private function notifApprovalAtasan($id,$atasan)
    {
        $cutis = DB::select(DB::raw("select nik,tgl_from,tgl_to,tipe_pengajuan from izin_cuti where id = '$id'"));
        if ($cutis != null) 
        {
            foreach ($cutis as $cuti) 
            {
                $tgl_from22 = date("d M Y", strtotime($cuti->tgl_from));
                $tgl_to22 = date("d M Y", strtotime($cuti->tgl_to));
                $tipe_pengajuan = ($cuti->tipe_pengajuan == 0) ? "CUTI" : "IZIN";

                $device = DB::table('token_device')->where("nik", $atasan)->first();
                if($device)
                {
                    $firebaseApi = new FirebaseApi();
                    $requestData = array(
                        'title' => "Pengajuan $tipe_pengajuan telah di di proses ke tahap selanjutnya",
                        'message' => "Pengajuan $tipe_pengajuan tanggal $tgl_from22 s/d $tgl_to22 telah di proses ke tahap selanjutnya",
                        'image_url' => "",
                        'action' => "activity",
                        'action_destination' => "CutiIzinList",
                    );
                    $send_to = "";
                    $device_tok = $device == null ? '' : $device->token;
                    $firebaseApi->postData($device_tok, $send_to, $requestData);
                }
                
            }
        }
    }

    private function notifApproval($id)
    {
        $cutis = DB::select(DB::raw("select nik,tgl_from,tgl_to,tipe_pengajuan from izin_cuti where id = '$id'"));
        if ($cutis != null) 
        {
            foreach ($cutis as $cuti) 
            {
                $tgl_from22 = date("d M Y", strtotime($cuti->tgl_from));
                $tgl_to22 = date("d M Y", strtotime($cuti->tgl_to));
                $tipe_pengajuan = ($cuti->tipe_pengajuan == 0) ? "CUTI" : "IZIN";

                $device = DB::table('token_device')->where("nik", $cuti->nik)->first();
                if($device)
                {
                    $firebaseApi = new FirebaseApi();
                    $requestData = array(
                        'title' => "Pengajuan $tipe_pengajuan telah di setujui",
                        'message' => "Pengajuan $tipe_pengajuan tanggal $tgl_from22 s/d $tgl_to22 telah di setujui",
                        'image_url' => "",
                        'action' => "activity",
                        'action_destination' => "CutiIzinList",
                    );
                    $send_to = "";
                    $device_tok = $device == null ? '' : $device->token;
                    $firebaseApi->postData($device_tok, $send_to, $requestData);
                }
                
            }
        }
    }

    private function notifRejected($id)
    {
        $cutis = DB::select(DB::raw("select nik,tgl_from,tgl_to,tipe_pengajuan from izin_cuti where id = '$id'"));
        
        if ($cutis != null) {

            foreach ($cutis as $cuti) {
                $tgl_from22 = date("d M Y", strtotime($cuti->tgl_from));
                $tgl_to22 = date("d M Y", strtotime($cuti->tgl_to));
                $tipe_pengajuan = ($cuti->tipe_pengajuan == 0) ? "CUTI" : "IZIN";

                $device = DB::table('token_device')->where("nik", $cuti->nik)->first();
                // dd($device);
                $firebaseApi = new FirebaseApi();
                $requestData = array(
                    'title' => "Pengajuan $tipe_pengajuan telah di tolak",
                    'message' => "Pengajuan $tipe_pengajuan tanggal $tgl_from22 s/d $tgl_to22 telah di tolak",
                    'image_url' => "",
                    'action' => "activity",
                    'action_destination' => "CutiIzinList",
                );
                $send_to = "";
                $device_tok = $device == null ? '' : $device->token;
                $firebaseApi->postData($device_tok, $send_to, $requestData);
            }
        }
    }

}
