<?php

namespace App\Http\Controllers\API;

use App\API\slip;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class SlipController extends Controller
{

    public function list_periode(REquest $req)
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
            'periode' => date("Y") . date("m"),
        ];

        if ($token->cekToken($req->header('Authorization'))) {
            $slip = new slip();
            $data = $slip->getSlipWithLink($periode, $nik, "qey.pinusmerahabadi.co.id/");
            //return $data;
            if ($data == "") {
                $status = ['code' => 404, 'description' => 'Request data not found'];
                return Response::json(compact('header', 'data', 'status'), 400);
            }
            return Response::json(compact('header', 'data', 'status'), 200);
        } else {
            $status = ['code' => 400, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
    }

    public function slip_link(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y") . date("m") - 1;
        if ($periode == null) {
            $periode = date("Y") . date("m") - 1;
        }
        $nik = $req->nik;
        $header = [
            'nik' => $nik,
            'periode' => ($periode == null || $periode == "") ? date("Y") . date("m") - 1 : $periode,
        ];

        // if ($token->cekToken($req->header('Authorization'))) {
            $slip = new slip();
            $ds = config('database.default');
            $slip_link = [
                'pma'=>'qey.pinusmerahabadi.co.id/',
                'pma_testing'=>'testingqey.pinusmerahabadi.co.id/',
                'demo'=>'http://demohrms.fintac.co.id/',
                'jalusi'=>'sji.addroogroup.co.id/',
                'sinar_anugrah'=>'sa.fintac.co.id/',
                'addroo'=>'masterpiece.fintac.co.id/',
                'selular'=>'hrs.selulargroup.com/',
            ];
            $data = $slip->getSlipWithLink($periode, $nik, $slip_link[$ds]);
            
            //return $data;
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

    public function periode_list(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        //$periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y") . "" . date("m");
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
            $nik = $req->nik;

            $slip = new slip();
            $data = $slip->getPeriodeList();
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

    public function index(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y") . date("m") - 1;
        $token = new TokenController();
        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $nik = $token->getNikByToken($req->header('Authorization'));
        //return $nik;
        if ($nik == false) {
            $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $header = [
            'nik' => $nik,
            'periode' => ($periode == null) ? date("Y") . date("m") - 1 : $periode,
        ];

        if ($token->cekToken($req->header('Authorization'))) {
            $slip = new slip();
            $data = $slip->getSlip($periode, $nik);
            if ($data == "") {
                $status = ['code' => 404, 'description' => 'Request data not found'];
                return Response::json(compact('header', 'data', 'status'), 400);
            }
            return Response::json(compact('header', 'data', 'status'), 200);
        } else {
            $status = ['code' => 400, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
    }


    public function getDownload($link)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= $link;

        $headers = array(
                'Content-Type: application/pdf',
                );

        return Response::download($file, 'foto_karyawan/filename.pdf', $headers);
    }
}
