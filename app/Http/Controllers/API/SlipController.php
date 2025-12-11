<?php

namespace App\Http\Controllers\API;

use App\API\slip;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class SlipController extends Controller
{
    public function list_periode(Request $req)
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

        // Default periode = bulan sebelumnya
        $periode = date("Ym", strtotime("-1 month"));

        $header = [
            'nik' => $nik,
            'periode' => $periode,
        ];

        if ($token->cekToken($req->header('Authorization'))) {
            $slip = new slip();
            $data = $slip->getSlipWithLink($periode, $nik, "qey.pinusmerahabadi.co.id/");

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

        // Default periode bulan sebelumnya
        $periode = isset($_GET['periode'])
            ? $_GET['periode']
            : date("Ym", strtotime("-1 month"));

        $nik = $req->nik;

        $header = [
            'nik' => $nik,
            'periode' => $periode,
        ];

        $slip = new slip();
        $ds = config('database.default');

        $slip_link = [
            'pma'           => 'qey.pinusmerahabadi.co.id/',
            'pma_testing'   => 'testingqey.pinusmerahabadi.co.id/',
            'demo'          => 'http://demohrms.fintac.co.id/',
            'jalusi'        => 'sji.addroogroup.co.id/',
            'sinar_anugrah' => 'sa.fintac.co.id/',
            'addroo'        => 'masterpiece.fintac.co.id/',
            'selular'       => 'hrs.selulargroup.com/',
        ];

        $data = $slip->getSlipWithLink($periode, $nik, $slip_link[$ds]);

        if ($data == "") {
            $status = ['code' => 404, 'description' => 'Request data not found'];
            return Response::json(compact('header', 'data', 'status'), 400);
        }

        return Response::json(compact('header', 'data', 'status'), 200);
    }

    public function periode_list(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        // Default periode bulan sebelumnya
        $periode = isset($_GET['periode'])
            ? $_GET['periode']
            : date("Ym", strtotime("-1 month"));

        // Jika bulan Januari → default ke Desember tahun lalu
        if (!isset($_GET['periode'])) {
            if (date('m') == '01') {
                $periode = (date("Y") - 1) . "12";
            }
        }

        $nik = $req->nik;

        $header = [
            'nik' => $nik,
            'periode' => ($periode == null) ? "ALL" : $periode,
        ];

        $slip = new slip();
        $data = $slip->getPeriodeList();

        if ($data == "") {
            $status = ['code' => 404, 'description' => 'Request data not found'];
            return Response::json(compact('header', 'data', 'status'), 400);
        }

        return Response::json(compact('header', 'data', 'status'), 200);
    }

    public function index(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];

        // Default periode bulan sebelumnya
        $periode = isset($_GET['periode'])
            ? $_GET['periode']
            : date("Ym", strtotime("-1 month"));

        $token = new TokenController();

        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }

        $nik = $token->getNikByToken($req->header('Authorization'));

        if ($nik == false) {
            $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }

        $header = [
            'nik' => $nik,
            'periode' => $periode,
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
        $file = $link;

        $headers = [
            'Content-Type: application/pdf',
        ];

        return Response::download($file, 'foto_karyawan/filename.pdf', $headers);
    }
}
