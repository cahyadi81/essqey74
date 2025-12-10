<?php

namespace App\Http\Controllers\API;

use App\API\FirebaseApi;
use App\API\perjalananDinas;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class PerjalananDinasController extends Controller
{

    public function index(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        
        $nik = $req->nik;
        $header = [
            'nik' => $nik,
        ];
        
        $pd = new perjalananDinas();
        $data = $pd->getJumlah($nik);
        /**
        if($data == 0 || $data == null || $data == "") {
        $data = ['jumlah'=>'0'];
        }
        **/
        return Response::json(compact('header', 'data', 'status'), 200);

    }

    // activityMap.put("CutiIzinApprList", new MenuActivity(CutiIzinApprListLayout.class).getClass());
    //     activityMap.put("DinasApprList",  new MenuActivity(DinasApprListLayout.class).getClass());
    //     activityMap.put("CutiIzinList", new MenuActivity(CutiIzinListLayout.class).getClass());
    //     activityMap.put("DinasList",  new MenuActivity(DinasListLayout.class).getClass());
    //     activityMap.put("PesanHO",  new MenuActivity(PesanListLayout.class).getClass());
    //     activityMap.put("Login",  LoginActivity.class);
    //     activityMap.put("Menu",  MenuActivity.class);

    function list(Request $req) {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        
        $nik = $req->nik;
        
        $header = [
            'nik' => $nik,
        ];
        
        $pd = new perjalananDinas();
        $data = $pd->getList($nik);
        /**
        if($data == 0 || $data == null || $data == "") {
        $data = ['jumlah'=>'0'];
        }
         **/
        return Response::json(compact('header', 'data', 'status'), 200);

    }

    public function list_appr(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        
        $nik = $req->nik;
        $header = [
            'nik' => $nik,
        ];
        
        $pd = new perjalananDinas();
        $data = $pd->getListApproval($nik);
        /**
        if($data == 0 || $data == null || $data == "") {
        $data = ['jumlah'=>'0'];
        }
         **/
        return Response::json(compact('header', 'data', 'status'), 200);
        
    }

    public function detail(Request $req)
    {
        $id_dinas = $req->id_dinas;
        $header = [
            'id_dinas' => isset($req->id_dinas) || $req->id_dinas != "" ? $req->id_dinas : "",
        ];
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        
        $nik = $req->nik;
           
        $pd = new perjalananDinas();
        $data = $pd->getDetail($id_dinas);
            /**
            if($data == 0 || $data == null || $data == "") {
            $data = ['jumlah'=>'0'];
            }
             **/
        return Response::json(compact('header', 'data', 'status'), 200);
   
    }

    public function request(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $token = new TokenController();
        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        $header = $req->all();
        if ($req->kota_tujuan == null) {
            $status = ['code' => 400, 'description' => 'Bad Request - kota tujuan required'];
            return Response::json(compact('header', 'data', 'status'), 500);
        }
        if ($token->cekToken($req->header('Authorization'))) {
            $nik = $token->getNikByToken($req->header('Authorization'));
            if ($nik == 0) {
                $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
                return Response::json(compact('header', 'data', 'status'), 404);
            }
            $pd = new perjalananDinas();

            $tgl_from = $req->tgl_from;
            $tgl_to = $req->tgl_to;

            $tgl_from1 = date("Y/m/d", strtotime($tgl_from));
            $tgl_from2 = date("Y", strtotime($tgl_from));
            $tgl_to1 = date("Y/m/d", strtotime($tgl_to));
            $tgl_to2 = date("Y", strtotime($tgl_to));

            $tgl_from22 = date("d M Y", strtotime($tgl_from));
            $tgl_to22 = date("d M Y", strtotime($tgl_to));

            $pd->nik = $nik;
            $pd->kota_tujuan = $req->kota_tujuan;
            $pd->tgl_from = $tgl_from1;
            $pd->tgl_to = $tgl_to1;
            $pd->penginapan = $req->penginapan;
            $pd->penginapan_biaya = $req->penginapan_biaya;
            $pd->transportasi_tipe = $req->transportasi_tipe;
            $pd->transportasi_ket = $req->transportasi_ket;
            $pd->transportasi_biaya = $req->transportasi_biaya;

            if ($pd->cek($nik, $tgl_from1, $tgl_to1) || $nik == "") {
                $status = ['code' => 404, 'description' => 'Bad Request - data nik not found'];
                return Response::json(compact('header', 'data', 'status'), 500);
            }

            if ($pd->save()) {
                $status = ['code' => 200, 'description' => 'OK - Inserted'];
                //send post
                $device = DB::table('token_device')->where("nik", $pd->getAtasan($nik))->first();
                $firebaseApi = new FirebaseApi();
                $requestData = array(
                    'title' => "Pengajuan DINAS dari nik : $nik ",
                    'message' => "Pengajuan DINAS dari tanggal $tgl_from22 s/d $tgl_to22 ",
                    'image_url' => "",
                    'action' => "activity",
                    'action_destination' => "DinasList",
                );
                $send_to = ($req->send_to == "" || $req->send_to == null) ? $req->send_to : "";
                $firebaseApi->postData($device->token, $send_to, $requestData);

                return Response::json(compact('header', 'data', 'status'), 200);
            }

        } else {
            $status = ['code' => 400, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }

    }

    public function approved(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $token = new TokenController();
        if ($req->header('Authorization') == null || $req->header('Authorization') == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - token required'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
        if (!isset($_REQUEST["id_dinas"]) || $_REQUEST['id_dinas'] == '') {
            $status = ['code' => 400, 'description' => 'Bad Request - id dinas required'];
            return Response::json(compact('header', 'data', 'status'), 500);
        }
        if ($token->cekToken($req->header('Authorization'))) {
            $nik = $token->getNikByToken($req->header('Authorization'));
            if ($nik == 0) {
                $status = ['code' => 404, 'description' => 'Bad Request - token not valid'];
                return Response::json(compact('header', 'data', 'status'), 404);
            }
            $pd = new perjalananDinas();
            $id = $req->id_dinas;
            $status_appr = $req->status;
            //status
            //0 = pendding, 1 = approve, 2 = reject/decline
            $header = [
                'id_dinas' => $id,
                'status' => $status_appr,
            ];

            if (!$pd->cekNikApproval($nik, $id)) {
                $status = ['code' => 400, 'description' => 'Bad Request - nik not access'];
                return Response::json(compact('header', 'data', 'status'), 500);
            }

            if ($pd->cekId($id)) {
                if ($status_appr == 1) {
                    if ($pd->approve($id)) {
                        $status = ['code' => 200, 'description' => 'OK - Approved'];
                        $this->notifApproval($id);
                        return Response::json(compact('header', 'data', 'status'), 200);
                    } else {
                        $status = ['code' => 200, 'description' => 'OK'];
                        return Response::json(compact('header', 'data', 'status'), 200);
                    }
                } else if ($status_appr == 2) {
                    if ($pd->decline($id)) {
                        $status = ['code' => 200, 'description' => 'OK - Rejected'];
                        $this->notifRejected($id);
                        return Response::json(compact('header', 'data', 'status'), 200);
                    } else {
                        $status = ['code' => 200, 'description' => 'OK'];
                        return Response::json(compact('header', 'data', 'status'), 200);
                    }
                } else {
                    $status = ['code' => 404, 'description' => 'Bad Request - Status not detected'];
                    return Response::json(compact('header', 'data', 'status'), 500);
                }
            } else {
                $status = ['code' => 404, 'description' => 'Bad Request - Request id not found'];
                return Response::json(compact('header', 'data', 'status'), 500);
            }
        } else {
            $status = ['code' => 400, 'description' => 'Bad Request - Token Not Valid'];
            return Response::json(compact('header', 'data', 'status'), 404);
        }
    }

    public function getAtasan($nik)
    {
        //return ($nik);
        $pd = DB::select(DB::raw("select nik_atasan
			from kry_h as a
			left join kry_d1 as b ON a.kode_karyawan = b.kode_karyawan
			where nik = '$nik'"));

        if ($pd == null) {
            return "";
        }
        foreach ($pd as $p) {
            return $p->nik_atasan;
        }

    }

    private function notifApproval($id)
    {
        $dinass = DB::select(DB::raw("select nik,tgl_from,tgl_to from perjalanan_dinas where id = '$id'"));
        if ($dinass != null) {
            foreach ($dinass as $dinas) {
                $tgl_from22 = date("d M Y", strtotime($dinas->tgl_from));
                $tgl_to22 = date("d M Y", strtotime($dinas->tgl_to));
                $tipe_pengajuan = "DINAS";
                $device = DB::table('token_device')->where("nik", $dinas->nik)->first();
                $firebaseApi = new FirebaseApi();
                $requestData = array(
                    'title' => "Pengajuan DINAS telah di setujui",
                    'message' => "Pengajuan DINAS tanggal $tgl_from22 s/d $tgl_to22 telah di setujui",
                    'image_url' => "",
                    'action' => "activity",
                    'action_destination' => "DinasApprList",
                );
                $send_to = "";
                $firebaseApi->postData($device->token, $send_to, $requestData);
            }
        }
    }

    private function notifRejected($id)
    {
        $dinass = DB::select(DB::raw("select nik,tgl_from,tgl_to from perjalanan_dinas where id = '$id'"));
        if ($dinass != null) {

            foreach ($dinass as $dinas) {
                $tgl_from22 = date("d M Y", strtotime($dinas->tgl_from));
                $tgl_to22 = date("d M Y", strtotime($dinas->tgl_to));
                $tipe_pengajuan = "DINAS";
                //echo $this->getAtasan($dinas->nik);
                //dd($this->getAtasan($dinas->nik));

                $device = DB::table('token_device')->where("nik", $dinas->nik)->first();
                $firebaseApi = new FirebaseApi();
                $requestData = array(
                    'title' => "Pengajuan DINAS telah di tolak",
                    'message' => "Pengajuan DINAS tanggal $tgl_from22 s/d $tgl_to22 telah di tolak",
                    'image_url' => "",
                    'action' => "activity",
                    'action_destination' => "DinasApprList",
                );
                $send_to = "";
                $firebaseApi->postData($device->token, $send_to, $requestData);
            }
        }
    }
}
