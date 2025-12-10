<?php

namespace App\Http\Controllers\API;

use App\API\absensi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class AbsensiController extends Controller
{
    public function index(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y") . "" . date("m") - 1;
        if(!isset($_GET['periode'])){
            if(date('m') == '01'){
                $periode = date("Y") - 1 . "12";
            }
        }
        // dd(date("m"));
        
        $nik = $req->nik;
        $header = [
            'nik' => $nik,
            'periode' => ($periode == null) ? "ALL" : $periode,
        ];
        // if ($token->cekToken($req->header('Authorization'))) {
            // $nik = $token->getNikByToken($req->header('Authorization'));

            $absensi = new absensi();
            $data = $absensi->getAbsensi($nik, $periode);
            if ($data == "") {
                $status = ['code' => 404, 'description' => 'Request data not found'];
                return Response::json(compact('header', 'data', 'status'), 500);
            }
            return Response::json(compact('header', 'data', 'status'), 200);
        // } else {

        //     $status = ['code' => 400, 'description' => 'Bad Request - token not valid'];
        //     return Response::json(compact('header', 'data', 'status'), 404);

        // }

    }

    public function update(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        //initial var for param
        $periode = $req->periode;
        $tgl = $req->tgl;
        $nik = $req->nik;

        $header = [
            'nik' => $nik,
            'tgl' => ($tgl == null) ? "-" : $tgl,
        ];

        $req->merge(['status' => '0']);
        $req->merge(['nik' => $nik]);
        $input = $req->only(['ket','tipe_krj']);

        //dd($req->all());

        $check = DB::table("absen_det_desc")->where('nik',$nik)
            ->where('tgl',$tgl)->first();
        $status_desc = '0';
        if($check){
            $update_desc = DB::table("absen_det_desc")->where('nik',$nik)
                ->where('tgl',$tgl)->update($req->only(['ket']));
            if($update_desc){$status_desc = '1';}
        }else {
            $insert_desc = DB::table("absen_det_desc")->where('nik',$nik)
                ->where('tgl',$tgl)->insert($req->only(['nik','tgl','ket','status']));
            if($insert_desc){$status_desc = '1';}
        }
        //dd($req->only(['nik','tgl','ket','status']));

        $update = DB::table("absen_det")->where('nik',$nik)
            ->where('tgl',$tgl)->update($req->only(['tipe_krj']));

        if($update || $status_desc = '1'){
            return Response::json(compact('header', 'data', 'status'), 200);
        }
        $status = ['code' => 404, 'description' => 'Request data not found'];
        return Response::json(compact('header', 'data', 'status'), 400);
       
    }

    public function periode_list(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y") . "" . date("m") - 1;
        if(!isset($_GET['periode'])){
            if(date('m') == '01'){
                $periode = date("Y") - 1 . "12";
            }
        }

        $nik = $req->nik;
        // if ($nik == 0) {
        //     $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
        //     return Response::json(compact('header', 'data', 'status'), 404);
        // }
        $header = [
            'nik' => $nik,
            'periode' => ($periode == null) ? "ALL" : $periode,
        ];
        // if ($token->cekToken($req->header('Authorization'))) {
            $nik = $req->nik;

            $absensi = new absensi();
            $data = $absensi->getPeriodeList();
            if ($data == "") {
                $status = ['code' => 404, 'description' => 'Request data not found'];
                return Response::json(compact('header', 'data', 'status'), 400);
            }
            return Response::json(compact('header', 'data', 'status'), 200);
        // } else {

        //     $status = ['code' => 400, 'description' => 'Bad Request - token not valid'];
        //     return Response::json(compact('header', 'data', 'status'), 404);

        // }

    }

    public function rekap_absensi(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y") . "" . date("m") - 1;
        if(!isset($_GET['periode'])){
            if(date('m') == '01'){
                $periode = date("Y") - 1 . "12";
            }
        }

        $nik = $req->nik;
        $header = [
            'nik' => $nik,
            'periode' => ($periode == null) ? "ALL" : $periode,
        ];
        // /if ($token->cekToken($req->header('Authorization'))) {
            // $nik = $token->getNikByToken($req->header('Authorization'));

            $absensi = new absensi();
            $data = $absensi->getAbsensiRekap($nik, $periode);
            if ($data == "" || $data == null) {
                $status = ['code' => 404, 'description' => 'Request data not found'];
                return Response::json(compact('header', 'data', 'status'), 400);
            }
            return Response::json(compact('header', 'data', 'status'), 200);
        // } else {

        //     $status = ['code' => 400, 'description' => 'Bad Request - token not valid'];
        //     return Response::json(compact('header', 'data', 'status'), 404);

        // }
    }

    public function detail_absensi(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y") . "" . date("m") - 1;
        if(!isset($_GET['periode'])){
            if(date('m') == '01'){
                $periode = date("Y") - 1 . "12";
            }
        }
        
        $nik = $req->nik;
        
        $header = [
            'nik' => $nik,
            'periode' => ($periode == null) ? "ALL" : $periode,
        ];
        // if ($token->cekToken($req->header('Authorization'))) {
            // $nik = $token->getNikByToken($req->header('Authorization'));

            $absensi = new absensi();
            $data = $absensi->getAbsensiDetail($nik, $periode);
            if ($data == "" || $data == null) {
                $status = ['code' => 404, 'description' => 'Request data not found'];
                return Response::json(compact('header', 'data', 'status'), 400);
            }
            return Response::json(compact('header', 'data', 'status'), 200);
        // } else {

        //     $status = ['code' => 400, 'description' => 'Bad Request - token not valid'];
        //     return Response::json(compact('header', 'data', 'status'), 404);

        // }
    }
}
