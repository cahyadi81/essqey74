<?php

namespace App\Http\Controllers\API;

use App\API\pesanHO;
use App\API\pesanHO_kry;
use App\API\karyawan;

use App\API\FirebaseApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

use Illuminate\Support\Facades\DB;



class PesanHOController extends Controller
{
    public function index(Request $req)
    {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $nik = $req->nik;
        $header = [
            'nik' => $nik,
        ];
        
        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y");
        $pesan = new pesanHO();
        $data = $pesan->getTotalPesan($nik);

        return Response::json(compact('header', 'data', 'status'), 200);
    }

    function list(Request $req) {
        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $nik = $req->nik;
        $header = [
            'nik' => $nik,
        ];
            
        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y");

        
        $pesan = new pesanHO();
        // $data = [
        //     'header'=>$header,
        //     'status'=>$status,
        // ];
        // $data = $pesan->getPesan($nik);
        $data = $pesan::select(DB::raw("pesan_ho.id,pesan_ho.header,pesan_ho.created_at,pesan_ho_kry.read,SUBSTR(pesan_ho.content,1,30) as pesan_content"))
            ->leftJoin('pesan_ho_kry','pesan_ho_kry.id_pesan_ho','=','pesan_ho.id')
            ->where('nik',$nik)->orderBy('id','desc')->paginate(10)->withPath('');

        $datas = $data->toArray();
        return Response::json([
                'header' => $header,
                'data' => $datas['data'],
                'status' => $status,
                'current_page' => $datas['current_page'],
                'first_page_url' => $datas['first_page_url'],
                'from' => $datas['from'],
                'last_page' => $datas['last_page'],
                'last_page-url' => $datas['last_page_url'],
                'next_page_url' => $datas['next_page_url'],

                'per_page' => $datas['per_page'],
                'prev_page_url' => $datas['prev_page_url'],
                
                'to' => $datas['to'],
                
                'total' => $datas['total'],
                
                
                
        ]);
        return Response::json($data, 200);
        

    }

    public function detail(Request $req)
    {
        $id_pesan = $req->id_pesan;
        $data = "";
        $header = [
            'id_pesan' => $id_pesan,
        ];
        $status = ['code' => 200, 'description' => 'ok'];
        
        $nik = $req->nik;
        if (!isset($_GET["id_pesan"]) || $_GET['id_pesan'] == '') {
            $status = ['code' => 400, 'description' => 'Bad Request - id pesan required'];
            return Response::json(compact('header', 'data', 'status'), 500);
        }

        $periode = isset($_GET['periode']) ? $_GET['periode'] : date("Y");
        $pesan = new pesanHO();
        $data = $pesan->getDetailPesan($id_pesan,$nik);
        if ($data == null) {
            $status = ['code' => 404, 'description' => 'Request data not found'];
            return Response::json(compact('header', 'data', 'status'), 500);
        }
        return Response::json(compact('header', 'data', 'status'), 200);
    }

    public function store(Request $request)
    {
        $data = "";
		$status = ['code'=>200,'description'=>'ok'];

		//declare class karyawan model
		$karyawan = new karyawan();
        
        $jPesan = 1;
        //jml count pesan header
        if(!pesanHo::orderBy('id', 'DESC')->first()){
            $jPesan = 1;
        }else{
            $jPesan = pesanHo::orderBy('id', 'DESC')->first()->id + 1;
        }
        
        if($jPesan < 1)
        {
            $jPesan = 1;
        }

        $image_url = $request->image_url == null ? "" : $request->image_url; 

        $no = 0;
        // return $karyawan->get()[1]->nik;
        if($request->target == "ALL"){
            $dataPesan = [
                'id'=> $jPesan,
                'header'=>$request->header,
                'content'=>$request->content,
            ];
            $insert = pesanHO::insert($dataPesan);

            $DataPesanKry = [];
            $requestData = array();
            // $karyawan = $karyawan::whereIn('nik',['1700102453','1800101265','1600100964'])->get();
            $karyawan = $karyawan::leftJoin('kry_d1','kry_d1.kode_karyawan','=','kry_h.kode_karyawan')
                ->whereIn('kry_d1.status_karyawan',['TETAP','KONTRAK 1','KONTRAK 2'])->get();
            
            for($i = 0;$i < count($karyawan);$i++){
                $PesanKry = [
                    'id' => '',
                    'id_pesan_ho'=> $jPesan,
                    'nik'=>$karyawan[$i]->nik,
                    'read'=>0,
                ];
                
                $DataPesanKry[$i] =  $PesanKry;
                $insert_psn = pesanHO_kry::insert($DataPesanKry[$i]); 
                
                if($insert_psn){
                //     send notif
                    $device = DB::table('token_device')->where("nik", $karyawan[$i]->nik)->first();
                    $token = ""; 
                    if($device){
                        $token = $device->token;		
                        $firebaseApi = new FirebaseApi();
                        $requestData = array(
                            'title' => "Pesan dari HO - ".$request->header,
                            'message' => $request->content,
                            'image_url' => '',
                            'action' => "activity",
                            'action_destination' => "PesanHOList",
                        );
                        $send_to = "";
                        $firebaseApi->postData($token, $send_to, $requestData);	
                    }
                    // end send notif
                }
                
            }
            // pesanHO_kry::insert($DataPesanKry);
            // return $DataPesanKry;

            // if(count($DataPesanKry) > 0){
            //     pesanHO_kry::insert($DataPesanKry);
            // }
            //return $dataPesanKry;
            $data = [
                'header'=>$dataPesan,
                'target'=>$DataPesanKry,
            ];
        }else {
            $dataPesan = [
                'id'=> $jPesan,
                'header'=>$request->header,
                'content'=>$request->content,
            ];

            $insert = pesanHO::insert($dataPesan);

            $dataPesanKry = array();
            $PesanKry = [
                    'id' => '',
                    'id_pesan_ho'=> $jPesan,
                    'nik'=>$request->target,
                    'read'=>0,
            ];

            $insPesanKry = pesanHO_kry::insert($PesanKry); 
            if($insPesanKry){
                //send notif pesan
                $device = DB::table('token_device')->where("nik", $request->target)->first();
                // dd($device);
                $token = ""; 
                if($device){
                    $token = $device->token;		
                    $firebaseApi = new FirebaseApi();
                    $requestData = array(
                        'title' => "Pesan dari HO - ".$request->header,
                        'message' => $request->content,
                        'image_url' => '',
                        'action' => "activity",
                        'action_destination' => "PesanHOList",
                    );
                    $send_to = "";
                    $firebaseApi->postData($token, $send_to, $requestData);    
                    //send notif pesan

                    //return $dataPesanKry;
                    $data = [
                        'header'=>$dataPesan,
                        'target'=>$PesanKry,
                    ];	
                }
            }

            
        }

        return $data; 
    }

}
