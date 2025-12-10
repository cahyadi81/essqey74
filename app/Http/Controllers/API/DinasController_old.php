<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\API\TokenController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Dinas\Header as DinasResource;
use App\Http\Resources\Dinas\Headers as DinasResources;
use App\Http\Resources\Dinas\HeaderOnSelected as DinasOnSelectedResource;


use App\Http\Resources\Karyawan\Header as KaryawanResource;

use App\API\karyawan;
use App\API\Dinas\hotel;
use App\API\Dinas\header;
use App\API\Karyawan\kry_d1;
use App\API\Dinas\transportasi;

use App\API\FirebaseApi;
use Illuminate\Support\Facades\DB;


class DinasController extends Controller
{

    private function validationHeader(Request $request)
    {
        $token = new TokenController();
        $data = [
            'nik' => $request->nik,
            'Token' => $request->bearerToken(),
            'status_code' => '',
            'status_message' => '',
        ];

        if($request->status_message != "" || $request->status_message != null){
            $data['status_message'] = $request->status_message;
            $data['status_code'] = 210;
            return $data;
        }
        
        //cek auth not null
        if ($request->bearerToken() == null || $request->bearerToken() == "") {
            $data['status_message'] = 'token null';$data['status_code'] = 404;
            return response()->json($data,404);
        }

        //cek nik == 0 or null
        $nik = $token->getNikByToken($request->bearerToken());
        if ($nik == 0 || $nik == "" || $nik == null) {
            $data['status_message'] = 'Nik not found / token not valid';$data['status_code'] = 404;
            return response()->json($data,404);
        }

        //cek token is true
        if (!$token->cekToken($request->bearerToken())) {
            $data['status_message'] = 'token not valid';$data['status_code'] = 404;
            return response()->json($data,404);              
        }

        return $nik;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //cek validation header
        if(is_array($this->validationHeader($request)))
        {
            return $this->validationHeader($request);
        }else if(explode("/",$this->validationHeader($request))[0] == "HTTP"){
            return $this->validationHeader($request);
        }

        $nik = $this->validationHeader($request);
        $data = header::where('nik',$nik)->with('hotel','transportasi')
        ->orderBy('dinas_h.id','desc')->orderBy('dinas_h.status','asc')->orderBy('dinas_h.created_at','desc')->get();
        $header = karyawan::where('nik',$nik)->with('kry_d1')->get();

        // return $data;

        if($request->header('approval') == true){
            // $data = header::select("kry_h.nik")
            // ->leftJoin('dinas_hotel', 'dinas_hotel.id_dinas', '=', 'dinas_h.id')
            // ->leftJoin('dinas_transportasi', 'dinas_transportasi.id_dinas', '=', 'dinas_h.id')
            // ->leftJoin('kry_h', 'kry_h.nik', '=', 'dinas_h.nik')
            // ->leftJoin('kry_d1', 'kry_h.kode_karyawan', '=', 'kry_d1.kode_karyawan')
            // ->where("kry_d1.nik_atasan","=",$nik)
            // ->groupBy('dinas_h.nik')
            // ->orderBy('dinas_h.id','desc')->orderBy('dinas_h.status','asc')->orderBy('dinas_h.created_at','desc')
            // ->get();
            $data = header::select("kry_h.nik")
            ->join('dinas_hotel', 'dinas_hotel.id_dinas', '=', 'dinas_h.id')
            ->join('dinas_transportasi', 'dinas_transportasi.id_dinas', '=', 'dinas_h.id')
            ->join('kry_h', 'kry_h.nik', '=', 'dinas_h.nik')
            ->join('kry_d1', 'kry_h.kode_karyawan', '=', 'kry_d1.kode_karyawan')
            ->where("kry_d1.nik_atasan","=",$nik)
            ->groupBy('dinas_h.nik')
            ->orderBy('dinas_h.id','desc')->orderBy('dinas_h.status','asc')->orderBy('dinas_h.created_at','desc')
            ->get();
            
            // return $data;
            
            
            $nik_t = $data;

            //return $nik_t;
            $datav = header::whereIn("nik",$nik_t)->with('hotel','transportasi')
            ->orderBy('id','desc')->orderBy('status','asc')->orderBy('created_at','desc')->get(); 

            
            
            //return $header[0]->kry_d1->nik_atasan;
            
            $datas = [
                'header' => KaryawanResource::collection($header),
                'data' => DinasOnSelectedResource::collection($datav),
                'status' => ['code'=>200,'description'=>'ok'],
            ];
            return $datas;
        }

        $jml_dinas = count($data);
        $status = ['code'=>200,'description'=>'ok'];
        $datas = [
            'header' => KaryawanResource::collection($header),
            'data' => DinasResource::collection($data),
            'status' => ['code'=>200,'description'=>'ok'],
        ];

        return $datas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvalData(Request $request)
    {
        //cek validation header
        if(is_array($this->validationHeader($request)))
        {
            return $this->validationHeader($request);
        }else if(explode("/",$this->validationHeader($request))[0] == "HTTP"){
            return $this->validationHeader($request);
        }

        $nik = $this->validationHeader($request);
        $data = header::where('nik_atasan',$nik)->with('hotel','transportasi','karyawan')->get();
        $header = karyawan::where('nik',$nik)->with('kry_d1')->get();

        // return $data;
        $jml_dinas = count($data);
        $status = ['code'=>200,'description'=>'ok'];
        $data = [
            'header' => KaryawanResource::collection($header),
            'data' => DinasResource::collection($data),
            'status' => ['code'=>200,'description'=>'ok'],
        ];

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_array($this->validationHeader($request)))
        {
            return $this->validationHeader($request);
        }else if(explode("/",$this->validationHeader($request))[0] == "HTTP"){
            return $this->validationHeader($request);
        }

        //get nik by token
        $nik = $this->validationHeader($request);

        //jml count dinas header
        if(!header::orderBy('id', 'DESC')->first()){
            $j_dinas_h = 1;
        }else{
            $j_dinas_h = header::orderBy('id', 'DESC')->first()->id + 1;
        }
        
        if($j_dinas_h < 1)
        {
            $j_dinas_h = 1;
        }

        //initials header
        $header = karyawan::where('nik',$nik)->with('kry_d1')->get();
        
        $data = [
            'header' => KaryawanResource::collection($header),
            'data' => [
                "header" => "",
                "hotel" => "",
                "transportasi" => "",
            ],
            'status' => [
                "code" => 0,
                "message" => "",
            ],
        ];
        //save to model dinas header
        if($request->jumlah_hari <= 7){
            $status = 0;//pending - tidak atasan langsung
        }else{
            $status = 0;//pending - atasan langsung
        }
        $dinas = [
            'id' => $j_dinas_h,
            'nik' => $nik,
            'kota_tujuan' => $request->kota_tujuan,
            'jumlah_hari' => $request->jumlah_hari,
            'keperluan' => $request->keperluan,
            // 'created_at' =>date('Y-m-d H:i:s'),
            // 'updated_at' =>null,
            // 'deleted_at' =>null,
            'status' => $status,
        ];
        $dinas_h = header::insert($dinas);
        if(!$dinas_h)
        {
            //delete model cause fail
            header::where('id',$j_dinas_h)->delete();

            $data['status']['message'] = 'upload to dinas header failed...!!!!';
            $data['status']['code'] = 204;
            $status = response()->json($data,204);
        }

        $failed = false;

        //save hotel data
        $hotels = array();
        $periode_awal_1 = ""; $periode_awal_2 = ""; $periode_awal_3 = "";
        $periode_akhir_1 = ""; $periode_akhir_2 = ""; $periode_akhir_31 = "";
        for($i = 0;$i < count(explode(",",$request->kota_tujuan_hotel));$i++){
            
            if($request->kota_tujuan_hotel == "" && $request->keperluan == ""){
                // $data['status']['message'] = 'nama hotel kosong';
                // $data['status']['code'] = 206;
                // $status = response()->json($data,206); 
                // $failed = true;
                continue;
            }

            $kota_tujuan_hotel = count(explode(",",$request->kota_tujuan_hotel)) > 0 ? 
                            explode(",",$request->kota_tujuan_hotel)[$i] : "";

            $nama_hotel = explode(",",$request->nama_hotel)[$i];

            $periode_awal = explode(",",$request->periode_awal)[$i];
            $periode_akhir = explode(",",$request->periode_akhir)[$i];

            $start = strtotime($periode_awal);
            $end = strtotime($periode_akhir);

            // $between = ceil(abs($end - $start) / 86400);

            if($start > $end){
                //delete model cause fail
                header::where('id',$j_dinas_h)->delete();
                
                hotel::where('id_dinas',$j_dinas_h)->delete();

                $data['status']['message'] = 'upload to dinas hotel failed, periode awal lebih besar...!!!!';
                $data['status']['code'] = 211;
                return response()->json($data,211);
            }

            if($i != 0){
                if($start < strtotime(explode(",",$request->periode_akhir)[$i-1])){
                    //delete model cause fail
                    header::where('id',$j_dinas_h)->delete();
                    
                    hotel::where('id_dinas',$j_dinas_h)->delete();

                    $data['status']['message'] = 'upload to dinas hotel failed, periode awal lebih kecil dari pada periode akhir hotel sebelumnya...!!!!';
                    $data['status']['code'] = 212;
                    return response()->json($data,212);
                }
            }

            
            $periode = $periode_awal." s/d ".$periode_akhir;
            $pembayaran_melalui = explode(",",$request->pembayaran_melalui)[$i];
            
            $check_in = "00:00";//explode(",",$request->check_in)[$i];
            $check_out = "00:00";//explode(",",$request->check_out)[$i];
            
            $harga =  count(explode(",",$request->harga)) > 0 ? 
                    explode(",",$request->harga)[$i] : 0;

            $keperluan_hotel = count(explode(",",$request->keperluan_hotel)) > 0 ? 
                            explode(",",$request->keperluan_hotel)[$i] : "";

            //save to model hotel
            $hotel = [ 
                'id_dinas' => $j_dinas_h,
                'kota_tujuan' => $kota_tujuan_hotel,
                'nama_hotel' => $nama_hotel,
                'periode' => $periode,
                'pembayaran_melalui' => $pembayaran_melalui,
                'check_in' => $check_in,
                'check_out' => $check_out,
                'keperluan_hotel' => $keperluan_hotel,
                'harga' => $harga,
            ];
        
            $dinas_hotel = hotel::insert($hotel);
            if(!$dinas_hotel)
            {
                //delete model cause fail
                header::where('id',$j_dinas_h)->delete();
                
                hotel::where('id_dinas',$j_dinas_h)->delete();

                $data['status']['message'] = 'upload to dinas hotel failed...!!!!';
                $data['status']['code'] = 205;
                $status = response()->json($data,205);
            }

            $hotels[$i] = $hotel; 
        }

        //cek value hotel insert
        // if(count($hotels) < 1){
        //     //delete model cause fail
        //     header::where('id',$j_dinas_h)->delete();

        //     $data['status']['message'] = 'upload to dinas hotels failed...!!!!';
        //     $data['status']['code'] = 210;
        //     $status = response()->json($data,210);

        //     return $data;
        // }

        //return count(explode(",",$request->from_transport));

        //save transportasi data
        $transports = array();

        for($i = 0;$i < count(explode(",",$request->from_transport));$i++){

            if($request->from_transport == "" || $request->to_transport == "")
            {
                continue;
            }

            $from_transport = explode(",",$request->from_transport)[$i];
            $to_transport = explode(",",$request->to_transport)[$i];

            $tipe = explode(",",$request->tipe_transport)[$i];
            $tipe_transport = explode("|",$tipe)[0];
            $pembayaran_melalui_trans = explode(",",$request->pembayaran_melalui_trans)[$i];
            $harga_trans = count(explode(",",$request->harga_trans)) > 0 ? 
                        explode(",",$request->harga_trans)[$i] : 0;

            $nama_tipe_transport = $tipe_transport == "pesawat" ||  $tipe_transport == "kereta" ? 
                                explode("|",$tipe)[1] : "";

            $nopol_mobil_dinas = $tipe_transport == "mobil_dinas" || $tipe_transport == "mobil" ?
                                explode("|",$tipe)[1] : "";
            
            if($nopol_mobil_dinas != ""){
                $jam_berangkat =  $tipe_transport == "mobil" 
                                ||  $tipe_transport == "mobil_dinas" ? 
                                explode("|",$tipe)[2] : "";
            }else{
                $jam_berangkat =  $tipe_transport == "pesawat" 
                                ||  $tipe_transport == "kereta" ? 
                                explode("|",$tipe)[2] : "";
            }

            //save to model hotel
            $tranportasi = [
                'id_dinas' => $j_dinas_h,
                'from' => $from_transport,
                'to' => $to_transport,
                'tipe_transport' => $tipe_transport,
                'nama_tipe_transport' => $nama_tipe_transport,
                'nopol_mobil_dinas' => $nopol_mobil_dinas,
                'jam_berangkat' => $jam_berangkat,
                'pembayaran_melalui' => $pembayaran_melalui_trans,
                'harga' => $harga_trans,
            ];
        
            $dinas_transportasi = transportasi::insert($tranportasi);
            if(!$dinas_transportasi)
            {
                //delete model cause fail
                header::where('id',$j_dinas_h)->delete();
                
                hotel::where('id_dinas',$j_dinas_h)->delete();

                transportasi::where('id_dinas',$j_dinas_h)->delete();

                $data['status']['message'] = 'upload to dinas failed...!!!!';
                $data['status']['code'] = 205;
                $status = response()->json($data,205);
            }

            $transports[$i] = $tranportasi; 
        }

        //cek value transport insert
        // if(count($transports) < 1){
        //     //delete model cause fail
        //     header::where('id',$j_dinas_h)->delete();

        //     $data['status']['message'] = 'upload to dinas transport failed...!!!!';
        //     $data['status']['code'] = 211;
        //     $status = response()->json($data,211);

        //     return $data;
        // }
        
        
        //if success store data
        $data['status']['message'] = 'OK - Upload success';
        $data['status']['code'] = 200;
        $data['data']['header'] = $dinas;
        $data['data']['hotel'] = $hotels;
        $data['data']['transportasi'] = $transports;

        $atasan_langsung = karyawan::where('nik',$nik)->with('kry_d1')->first();
        $atasan_tidak_langsung = karyawan::where('nik',$atasan_langsung->kry_d1->nik_atasan)->first();
        
       
        
        // return $header;//
        if(!$failed){
            if($request->jumlah_hari <= 7){
                $device = DB::table('token_device')
                        ->whereIn("nik", [$atasan_langsung->kry_d1->nik_atasan,$atasan_tidak_langsung->kry_d1->nik])->get();
                $token = ""; 
                foreach($device as $dev){
                    // if($device){
                    //     $token = $device->token;			
                    // }
                    $nik = $dev->nik;

                    $firebaseApi = new FirebaseApi();
                    $requestData = array(
                        'title' => "Pengajuan Perjalanan Dinas",
                        'message' => "Pengajuan DINAS dari nik : $nik ",
                        'image_url' => "",
                        'action' => "activity",
                        'action_destination' => "DinasApprList",
                    );
                    $send_to = "";
                    $firebaseApi->postData($token, $send_to, $requestData);
                    $status = response()->json($data,200);
                }
            }else{
                $device = DB::table('token_device')->where("nik", $atasan_langsung->kry_d1->nik_atasan)->first();
                if($device){
                    $token = $device->token;			
                }
                $nik = $device->nik;

                $firebaseApi = new FirebaseApi();
                $requestData = array(
                    'title' => "Pengajuan Perjalanan Dinas",
                    'message' => "Pengajuan DINAS dari nik : $nik ",
                    'image_url' => "",
                    'action' => "activity",
                    'action_destination' => "DinasApprList",
                );
                $send_to = "";
                $firebaseApi->postData($token, $send_to, $requestData);
                $status = response()->json($data,200);
            }
        }
        
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\API\Dinas  $dinas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        //cek validation header
        if(is_array($this->validationHeader($request)))
        {
            return $this->validationHeader($request);
        }else if(explode("/",$this->validationHeader($request))[0] == "HTTP"){
            return $this->validationHeader($request);
        }

        $nik = $this->validationHeader($request);
        $header = karyawan::where('nik',$nik)->with('kry_d1')->get();

        $data = header::where('id',$request->id)->with('hotel','transportasi')->get();

        $jml_dinas = count($data);
        $status = ['code'=>200,'description'=>'ok'];
        $data = [
            'header' => KaryawanResource::collection($header),
            'data' => DinasResource::collection($data),
            'status' => ['code'=>200,'description'=>'oks'],
        ];

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\API\Dinas  $dinas
     * @return \Illuminate\Http\Response
     */
    public function edit(header $header)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\API\Dinas\header  $header
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, header $header)
    {
        //cek validation header
        if(is_array($this->validationHeader($request)))
        {
            return $this->validationHeader($request);
        }else if(explode("/",$this->validationHeader($request))[0] == "HTTP"){
            return $this->validationHeader($request);
        }

        $nik = $this->validationHeader($request);
        $data = header::where('id',$request->id_approval)->with('hotel','transportasi')->get();
        //initials header
        // $header_kry = karyawan::where('nik',$nik)->with('kry_d1')->get();
        $header_kry = karyawan::where('nik', $nik)->with('kry_d1')->get();

        $datas = [
            'header' => KaryawanResource::collection($header_kry),
            'data' => array(),
            'status' => [
                "status_code"=>0,
                "status_message"=>"",
            ]
        ];

        //atasan get 
        // $nik_data = karyawan::where('nik',$data[0]->nik)->get();
        // $data_atasan = kry_d1::where('kode_karyawan',$nik_data[0]->kode_karyawan)->get();
        // $atasan = $data_atasan[0]->kode_karyawan;
        // $nik_atasan = 

        //return $atasan;

        // $request->nik = $nik;
        // if($atasan == "0" || $atasan == "" || $atasan == null){
        //     $request->status_message = "not akses";
        //     $datas['status'] = $this->validationHeader($request);
        //     return $datas;
        // }


        if($request->tipe_approval == "approved")
        {
            header::where('id', $request->id_approval)
                ->update(['status' => 1]);

            $datas['status']['status_message'] = "OK - Approved Success";
            $datas['status']['status_code'] = 200;

            $data_app = header::where('id', $request->id_approval)->first();
            $nik_ats = $data_app ? "".$data_app->nik:""; 
            // return $nik_ats;
            
            //send notif
            $device = DB::table('token_device')->where("nik", $nik_ats)->first();
            $token = ""; 
            if($device){
                $token = $device->token;			
            }

            // return $token;

            $firebaseApi = new FirebaseApi();
            $requestData = array(
                'title' => "Pengajuan Perjalanan Dinas",
                'message' => "Selamat, Pengajuan DINAS anda di terima",
                'image_url' => "",
                'action' => "activity",
                'action_destination' => "DinasList",
            );
            $send_to = "";
            $firebaseApi->postData($token, $send_to, $requestData);

            return response()->json($datas,200);
        }
        else if($request->tipe_approval == "rejected")
        {
            header::where('id', $request->id_approval)
                ->update(['status' => 2]);

            $datas['status']['status_message'] = "OK - Rejected Success";
            $datas['status']['status_code'] = 200;

            $data_app = header::where('id', $request->id_approval)->first();
            $nik_ats = $data_app ? "".$data_app->nik:""; 
            // return $nik_ats;
            
            //send notif
            //send notif
            $device = DB::table('token_device')->where("nik", $nik_ats)->first();
            $token = ""; 
            if($device){
                $token = $device->token;			
            }

            // return $token;//

            $firebaseApi = new FirebaseApi();
            $requestData = array(
                'title' => "Pengajuan Perjalanan Dinas",
                'message' => "Maaf, Pengajuan DINAS anda di tolak ",
                'image_url' => "",
                'action' => "activity",
                'action_destination' => "DinasList",
            );
            $send_to = "";
            $firebaseApi->postData($token, $send_to, $requestData);

            return response()->json($datas,200);
        }
        else if($request->tipe_approval == "restart")
        {
            header::where('id', $request->id_approval)
                ->update(['status' => 0]);

            $datas['status']['status_message'] = "OK - restart approval Success";
            $datas['status']['status_code'] = 200;
            return response()->json($datas,200);
        }else{
            return response()->json($datas,201);
        }

        return $datas;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\API\Dinas  $dinas
     * @return \Illuminate\Http\Response
     */
    public function destroy(header $header)
    {
        //
    }
}
