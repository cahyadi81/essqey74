<?php

namespace App\Http\Controllers\API;

use App\API\cuti;
use App\API\FirebaseApi;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class CutiController extends Controller
{

    public function jumlahIzinCuti(Request $req)
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
        //return Response::json($token->cekToken($req->header('Authorization')));
        if ($token->cekToken($req->header('Authorization'))) {
            $cuti = new cuti();
            $data = $cuti->getJumlahIzinCuti($nik);
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

    public function sisaIzinCuti(Request $req)
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
            $data = $cuti->getSisaCuti($nik);
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

    public function listIzinCuti(Request $req)
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

    public function listIzinCutiApproval(Request $req)
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
            $data = $cuti->getListIzinCutiApproval($nik);
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
        if (!isset($_GET["id"]) || $_GET['id'] == '') {
            $status = ['code' => 400, 'description' => 'Bad Request - id required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $header = [
            'id' => $id,
            'tahun' => date("Y"),
        ];
        if ($token->cekToken($req->header('Authorization'))) {
            $cuti = new cuti();
            $data = $cuti->getDetailIzinCuti($id);
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

    public function requestIzinCuti(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $token = new TokenController();
        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $nik = $token->getNikByToken($req->header('Authorization'));
        if ($nik == 0 || $nik == "" || $nik == null) {
            $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }

        if ($token->cekToken($req->header('Authorization'))) {

            $cuti = new cuti;

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

            // $between = ceil(abs($end - $start) / 86400);

            if($start > $end){
                http_response_code(211);
                $status = ['code' => 211, 'description' => 'upload to CUTI IZIN failed, periode awal lebih besar...!!!!'];
                return Response::json(compact('header', 'data', 'status'), 211);
            }

            

            $header = [
                'nik' => $nik,
                'tgl_from' => $tgl_from1,
                'tgl_to' => $tgl_to1,
                'tipe_pengajuan' => $req->tipe_pengajuan,
                'atasan' => ($req->atasan == null) ? '-' : $req->atasan,
                'alasan' => $req->alasan,
                'pengganti' => $req->pengganti,
            ];

            $DATA_NULL = 209;
            $MASA_KERJA_KURANG = 210;
            $STATUS_OK = 200;
            $SISA_TRUE = 211;
            $JUMLAH_REQ_LIMIT = 212;
            $SISA_FALSE = 213;

            //jika pengajuan cuti
            if ($req->tipe_pengajuan == 0) {
                $start = strtotime($tgl_to);
                $end = strtotime($tgl_from);

                $jml_req = ceil(abs($end - $start) / 86400) + 1;

                // $kal = DB::select(DB::raw("select 
                // a.flag1 as jml_libur
                // from kalender_d1 as a 
                // where a.flag1 = '1' && a.tanggal between '$req->tgl_from' AND '$req->tgl_to' "));
                
                // $tgl_f =  date("Y-m-d", strtotime($req->tgl_from));
                // $tgl_t =  date("Y-m-d", strtotime($req->tgl_to));
                // $kal = DB::select(DB::raw("select 
                // a.flag1 as jml_libur
                // from kalender as a 
                // where #a.flag1 = '0' && 
                // a.tanggal between '$tgl_f' AND '$tgl_t' "));
                
                // // return $req->tgl_from." - ".$req->tgl_to;
                // // return count($kal);
                // if($jml_req >= count($kal)){
                //     $jml_req -= count($kal);
                // }
                
                // if($jml_req < 1){
                //     $status = ['code' => 402, 'description' => 'Bad Request - request cuti kurang dari 1'];
                //     return Response::json(compact('header', 'data', 'status'), 402);
                // }

                // if ($cuti->validationReqCuti($nik, $jml_req) == $DATA_NULL) {
                //     http_response_code($DATA_NULL);
                //     $status = ['code' => $DATA_NULL, 'description' => 'Failed Request - data sisa tidak ada'];
                //     return Response::json(compact('header', 'data', 'status'), $DATA_NULL);
                // } else if ($cuti->validationReqCuti($nik, $jml_req) == $MASA_KERJA_KURANG) {
                //     http_response_code($MASA_KERJA_KURANG);
                //     $status = ['code' => $MASA_KERJA_KURANG, 'description' => 'Failed Request - masa kerja kurang dari 1 tahun'];
                //     return Response::json(compact('header', 'data', 'status'), $MASA_KERJA_KURANG);
                // }

                // return $jml_req;
                if ($jml_req > 5) {
                    http_response_code($JUMLAH_REQ_LIMIT);
                    $status = ['code' => $JUMLAH_REQ_LIMIT, 'description' => 'Failed Request - overlimiti req cuti > 5'];
                    return Response::json(compact('header', 'data', 'status'), $JUMLAH_REQ_LIMIT);
                }
            }

            $tipe_pengajuan = ($req->tipe_pengajuan == 0) ? "CUTI" : "IZIN";

            $insert_cuti = cuti::insert($header);
            if ($insert_cuti) {
                $status = ['code' => $STATUS_OK, 'description' => 'OK - Inserted'];
                $device = DB::table('token_device')->where("nik", $req->atasan)->first();
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

                http_response_code(200);
                return Response::json(compact('header', 'data', 'status'), 200);
            } else {
                http_response_code(500);
                $status = ['code' => 400, 'description' => 'Bad Request - Failed Inserted'];
                return Response::json(compact('header', 'data', 'status'), 500);
            }
        } else {
            $status = ['code' => 400, 'description' => 'Bad Request - No Valid Token'];
            return Response::json(compact('header', 'data', 'status'), 404);
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
        $token = new TokenController();
        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 500);
        }
        $id = $req->id;
        if (!isset($_REQUEST["id"]) || $_REQUEST['id'] == '') {
            $status = ['code' => 400, 'description' => 'Bad Request - id cuti required'];
            return Response::json(compact('header', 'data', 'status'), 500);
        }
        if ($token->cekToken($req->header('Authorization'))) {
            $nik = $token->getNikByToken($req->header('Authorization'));
            if ($nik == 0) {
                $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
                return Response::json(compact('header', 'data', 'status'), 404);
            }
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

            if ($status_appr == 1) {
                

                if ($cuti->approveIzinCuti($id)) {
                    $status = ['code' => 200, 'description' => 'OK - Approved'];
                    //jika pengajuan cuti
                    if ($cuti->getTipePengajuan($id) == 0) {
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
                    }

                    $this->notifApproval($id);
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
        } else {
            $status = ['code' => 400, 'description' => 'Bad Request - Token Not Valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
    }

    private function notifApproval($id)
    {
        $cutis = DB::select(DB::raw("select nik,tgl_from,tgl_to,tipe_pengajuan from izin_cuti where id = '$id'"));
        if ($cutis != null) {
            foreach ($cutis as $cuti) {
                $tgl_from22 = date("d M Y", strtotime($cuti->tgl_from));
                $tgl_to22 = date("d M Y", strtotime($cuti->tgl_to));
                $tipe_pengajuan = ($cuti->tipe_pengajuan == 0) ? "CUTI" : "IZIN";

                $device = DB::table('token_device')->where("nik", $cuti->nik)->first();
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

    private function notifRejected($id)
    {
        $cutis = DB::select(DB::raw("select nik,tgl_from,tgl_to,tipe_pengajuan from izin_cuti where id = '$id'"));
        
        if ($cutis != null) {

            foreach ($cutis as $cuti) {
                $tgl_from22 = date("d M Y", strtotime($cuti->tgl_from));
                $tgl_to22 = date("d M Y", strtotime($cuti->tgl_to));
                $tipe_pengajuan = ($cuti->tipe_pengajuan == 0) ? "CUTI" : "IZIN";

                $device = DB::table('token_device')->where("nik", $cuti->nik)->first();
                dd($device);
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


    //revisian
    /**
   

    public function sisa_cuti(Request $req)
    {
    $data = "";
    $status = ['code'=>200,'description'=>'ok'];

    $token = new TokenController();
    if($req->header('Authorization') == null || $req->header('Authorization') == "") {
    $status = ['code'=>400,'description'=>'Bad Request - token required'];
    return Response::json(compact('header','data','status'),500);
    }
    $nik = $token->getNikByToken($req->header('Authorization'));
    $header = [
    'nik'=>$nik,
    'tahun'=>date("Y")
    ];
    if($token->cekToken($req->header('Authorization')))
    {
    $cuti = new cuti();
    $data = $cuti->getSisaCutiByYear($nik,date("Y"));
    if($data == 0) {
    $data = ['jumlah'=>'0'];
    }
    return Response::json(compact('header','data','status'),200);
    }else {
    $status = ['code'=>404,'description'=>'Bad Request - token expired'];
    return Response::json(compact('header','data','status'),500);
    }
    }

    public function list_cuti_terpakai(Request $req)
    {
    $data = "";
    $status = ['code'=>200,'description'=>'ok'];

    $token = new TokenController();
    if($req->header('Authorization') == null || $req->header('Authorization') == "") {
    $status = ['code'=>400,'description'=>'Bad Request - token required'];
    return Response::json(compact('header','data','status'),500);
    }
    $nik = $token->getNikByToken($req->header('Authorization'));
    $header = [
    'nik'=>$nik,
    'tahun'=>date("Y")
    ];
    if($token->cekToken($req->header('Authorization')))
    {
    $cuti = new cuti();
    $data = $cuti->getListCutiTerpakai($nik,date("Y"));

    return Response::json(compact('header','data','status'),200);
    }else {
    $status = ['code'=>404,'description'=>'Bad Request - token expired'];
    return Response::json(compact('header','data','status'),500);
    }

    }


    public function index(Request $req)
    {

    $data = "";
    $status = ['code'=>200,'description'=>'ok'];

    $token = new TokenController();
    if($req->header('Authorization') == null || $req->header('Authorization') == "") {
    $status = ['code'=>400,'description'=>'Bad Request - token required'];
    return Response::json(compact('header','data','status'),500);
    }
    $nik = $token->getNikByToken($req->header('Authorization'));
    $header = [
    'nik'=>$nik,
    'tahun'=>date("Y")
    ];

    if($token->cekToken($req->header('Authorization')))
    {
    $cuti = new cuti();
    $data = $cuti->getJumlahIzinCuti($nik);
    $jumlah = ['jumlah'=>'0'];
    if($data == 0) {
    $data = ['jumlah'=>'0'];
    }
    return Response::json(compact('header','data','status'),200);
    }else {
    $status = ['code'=>404,'description'=>'Bad Request - token expired'];
    return Response::json(compact('header','data','status'),500);
    }

    }

    public function list_cuti(Request $req)
    {
    $data = "";
    $status = ['code'=>200,'description'=>'ok'];

    $token = new TokenController();
    if($req->header('Authorization') == null || $req->header('Authorization') == "") {
    $status = ['code'=>400,'description'=>'Bad Request - token required'];
    return Response::json(compact('header','data','status'),500);
    }
    $nik = $token->getNikByToken($req->header('Authorization'));
    $header = [
    'nik'=>$nik,
    'tahun'=>date("Y")
    ];
    if($token->cekToken($req->header('Authorization')))
    {
    $cuti = new cuti();
    $data = $cuti->getListCuti($nik);
    if($data == "") {
    $data = ['result'=>''];
    }
    return Response::json(compact('header','data','status'),200);
    }else {
    $status = ['code'=>404,'description'=>'Bad Request - token expired'];
    return Response::json(compact('header','data','status'),500);
    }

    }

    public function list_appr_cuti(Request $req)
    {
    $data = "";
    $status = ['code'=>200,'description'=>'ok'];

    $token = new TokenController();
    if($req->header('Authorization') == null || $req->header('Authorization') == "") {
    $status = ['code'=>400,'description'=>'Bad Request - token required'];
    return Response::json(compact('header','data','status'),500);
    }
    $nik = $token->getNikByToken($req->header('Authorization'));
    $header = [
    'nik'=>$nik,
    'tahun'=>date("Y")
    ];
    if($token->cekToken($req->header('Authorization')))
    {
    $cuti = new cuti();
    $data = $cuti->getListApprCuti($nik);
    return Response::json(compact('header','data','status'),200);
    }else {
    $status = ['code'=>404,'description'=>'Bad Request - token expired'];
    return Response::json(compact('header','data','status'),500);
    }
    }

    public function detail_cuti(Request $req)
    {
    $id_cuti = $req->id_cuti;
    $header = [
    'id_cuti'=>isset($req->id_cuti)||$req->id_cuti != ""?$req->id_cuti:"",
    'tahun'=>date("Y")
    ];
    $data = "";
    $status = ['code'=>200,'description'=>'ok'];

    $token = new TokenController();
    if($req->header('Authorization') == null || $req->header('Authorization') == "") {
    $status = ['code'=>400,'description'=>'Bad Request - token required'];
    return Response::json(compact('header','data','status'),500);
    }
    if(!isset($_GET["id_cuti"]) || $_GET['id_cuti'] == '') {
    $status = ['code'=>400,'description'=>'Bad Request - id cuti required'];
    return Response::json(compact('header','data','status'),500);
    }
    if($token->cekToken($req->header('Authorization')))
    {
    $nik = $token->getNikByToken($req->header('Authorization'));
    $cuti = new cuti();
    $data = $cuti->getDetailCuti($id_cuti);
    if($data == "") {
    $data = ['result'=>''];
    $status = ['code'=>404,'description'=>'Request data not found'];
    return Response::json(compact('header','data','status'),500);
    }
    return Response::json(compact('header','data','status'),200);
    }else {
    $status = ['code'=>404,'description'=>'Bad Request - token expired'];
    return Response::json(compact('header','data','status'),500);
    }
    }



    public function request(Request $req)
    {
    $data = "";
    $status = ['code'=>200,'description'=>'ok'];
    $token = new TokenController();
    if($req->header('Authorization') == null || $req->header('Authorization') == "") {
    $status = ['code'=>400,'description'=>'Bad Request - token required'];
    return Response::json(compact('header','data','status'),500);
    }
    $nik = $token->getNikByToken($req->header('Authorization'));

    $header = [
    'nik'=>$nik ,
    'ajuan_cuti'=>$req->ajuan_cuti,
    'tgl_from'=>$req->tgl_from,
    'tgl_to'=>$req->tgl_to,
    'alasan'=>$req->alasan,
    'no_hp'=>$req->ajuan_cuti,
    'alamat'=>$req->alamat
    ];
    if($token->cekToken($req->header('Authorization')))
    {

    $cuti = new cuti;

    $ajuan_cuti   = $req->ajuan_cuti;

    $tgl_from      = $req->tgl_from;
    $tgl_from1     = date("Y/m/d",strtotime($tgl_from));
    $tgl_from2     = date("Y",strtotime($tgl_from));

    $tgl_to        = $req->tgl_to;
    $tgl_to1       = date("Y/m/d",strtotime($tgl_to));
    @$tgl_11       = date("Y",strtotime($tgl_to));
    @$alasan       = $req->alasan;
    @$no_hp        = $req->no_hp;
    @$alamat       = $req->alamat;

    if(isset($no_hp)){$no1 = $no_hp;} else { $no1 = "";}
    if(isset($alamat)) {$alamat1 = $alamat;} else {$alamat1 = "";}
    if(isset($alasan)){$alasan1 = $alasan;} else {$alasan1 = "";}

    if($cuti->hakCuti($nik))
    {
    $total_cuti = $cuti->getTotalCuti($tgl_from1,$tgl_to1);
    $sisa_cuti = $cuti->getListSisaCutiByYear($nik,$tgl_from2);
    $nik_sisa_cuti = "";$tahun_sisa_cuti = "";$sisa_sisa_cuti = 12;
    foreach($sisa_cuti as $cut) {
    $nik_sisa_cuti = $cut->nik;
    $tahun_sisa_cuti = $cut->tahun;
    $sisa_sisa_cuti = ($cut->sisa == "") ? 12:$cut->sisa;
    }
    if($total_cuti > $sisa_sisa_cuti || $total_cuti > 12) {
    $data =
    [
    'jml_cuti'=>$total_cuti,
    'sisa_cuti'=>$sisa_sisa_cuti,
    'max_cuti'=>12
    ];
    $status = ['code'=>400,'description'=>'Not Enough Sisa Cuti'];
    return Response::json(compact('header','data','status'),500);
    }

    if(empty($cuti->getDataNik($nik))) {
    $status = ['code'=>404,'description'=>'Bad Request - Data NIK Not Found'];
    return Response::json(compact('header','data','status'),500);
    }
    if($cuti->cekCuti($nik,$tgl_to1,$tgl_from1))
    {
    $status = ['code'=>404,'description'=>'Bad Request - Data Cuti Not NULL'];
    return Response::json(compact('header','data','status'),500);
    }

    $nama_lengkap = "";$nik_atasan = "";
    foreach($cuti->getDataNik($nik) as $cut) {
    $nama_lengkap = $cut->nama_lengkap;
    $nik_atasan = $cut->nik_atasan;
    }
    //return $cuti->getTotalCuti($tgl_from1,$tgl_to1);
    $insert_cuti = DB::table('cuti_tbl')->insert(
    [
    'nik' => $nik,
    'kd_div' => 0,
    'kd_jabatan' => 12,
    'alasan_cuti' => $alasan,
    'ajuan_cuti' => $ajuan_cuti,
    'alamat_cuti' => $alamat,
    'tgl_from' => $tgl_from1,
    'tgl_to' => $tgl_to1,
    'total_cuti' => $cuti->getTotalCuti($tgl_from1,$tgl_to1),
    'no_hp' => $no_hp,
    'psnl' => $nama_lengkap,
    'atsn' => $nik_atasan,
    'app_atsn' => 0,
    'atsn2' => '',
    'app_atsn2' => 0,
    'last_update' => date("Y m d"),
    'user_update' => '',
    ]
    );


    if($ajuan_cuti == "CK"){
    if ($nik_sisa_cuti == NULL
    AND $tahun_sisa_cuti == NULL )
    {
    $qry5 = DB::table('cuti_sisa')->insert(
    ['nik' => $nik, 'tahun' => date("Y"), 'sisa' => 12]
    );
    }
    } elseif ($ajuan_cuti == "CT"){
    $upd_cuti = $sisa_sisa_cuti - $cuti->getTotalCuti($tgl_from1,$tgl_to1);

    if ($nik_sisa_cuti == NULL AND $tahun_sisa_cuti == NULL )
    {
    $qry5 = DB::table('cuti_sisa')->insert(
    ['nik' => $nik, 'tahun' => date("Y"), 'sisa' => $upd_cuti]
    );
    } else {
    DB::table('cuti_sisa')
    ->where('nik', $nik)
    ->update(['sisa' => $upd_cuti]);
    }
    }


    if($insert_cuti)
    {
    $status = ['code'=>200,'description'=>'OK - Inserted'];
    return Response::json(compact('header','data','status'),200);
    }else
    {
    $status = ['code'=>400,'description'=>'Bad Request - Failed Inserted'];
    return Response::json(compact('header','data','status'),500);
    }

    }
    else
    {
    $status = ['code'=>404,'description'=>'Bad Request - NO Have HAK Cuti'];
    return Response::json(compact('header','data','status'),500);
    }
    }else {
    $status = ['code'=>400,'description'=>'Bad Request - No Valid Token'];
    return Response::json(compact('header','data','status'),500);
    }

    }

    public function approved(Request $req)
    {
    $data = ['result'=>''];
    $status = ['code'=>200,'description'=>'ok'];
    $token = new TokenController();
    if($req->header('Authorization') == null || $req->header('Authorization') == "") {
    $status = ['code'=>400,'description'=>'Bad Request - token required'];
    return Response::json(compact('header','data','status'),500);
    }
    $id_cuti = $req->id_cuti;
    if(!isset($_REQUEST["id_cuti"]) || $_REQUEST['id_cuti'] == '') {
    $status = ['code'=>400,'description'=>'Bad Request - id cuti required'];
    return Response::json(compact('header','data','status'),500);
    }
    if($token->cekToken($req->header('Authorization')))
    {
    $nik = $token->getNikByToken($req->header('Authorization'));
    $cuti = new cuti();

    $status_appr = $req->status;

    $header = [
    'id_cuti'=>id_cuti,
    'status'=>$status_appr
    ];

    if($cuti->cekIdCuti($id_cuti)) {
    if($status_appr == 1) {
    if($cuti->approve($id_cuti))
    {
    $status = ['code'=>200,'description'=>'OK - Approved'];
    return Response::json(compact('header','data','status'),200);
    }
    else
    {
    $status = ['code'=>200,'description'=>'OK'];
    return Response::json(compact('header','data','status'),200);
    }
    }else if($status_appr == 2) {
    if($cuti->decline($id_cuti))
    {
    $status = ['code'=>200,'description'=>'OK - Rejected'];
    return Response::json(compact('header','data','status'),200);
    }
    else
    {
    $status = ['code'=>200,'description'=>'OK'];
    return Response::json(compact('header','data','status'),200);
    }
    }
    }else {
    $status = ['code'=>404,'description'=>'Bad Request - Request Id Cuti Not Found'];
    return Response::json(compact('header','data','status'),500);
    }
    }else {
    $status = ['code'=>400,'description'=>'Bad Request - Token Not Valid'];
    return Response::json(compact('header','data','status'),500);
    }
    }

     **/

}
