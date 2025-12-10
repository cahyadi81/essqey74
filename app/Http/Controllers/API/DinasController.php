<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\API\TokenController;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Dinas\Header as DinasResource;
use App\Http\Resources\Dinas\Headers as DinasResources;
use App\Http\Resources\Dinas\HeaderOnSelected as DinasOnSelectedResource;


use App\Http\Resources\Karyawan\Header as KaryawanResource;

use App\API\karyawan;
use App\API\Dinas\hotel;
use App\API\Dinas\header;
use App\API\Dinas\approval;
use App\API\Karyawan\kry_h;
use App\API\Karyawan\kry_d1;
use App\API\Dinas\transportasi;
use App\API\Dinas\kasbon;

use App\API\FirebaseApi;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dinas\HeaderOnSelected;


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
        $nik = $request->nik;
        setlocale (LC_MONETARY, 'id_ID');
        $header = karyawan::where('nik',$nik)->select(['kode_karyawan','nik','nama_lengkap'])->first();
        $datas = array();

        // return "wow";
        if($request->header('approval') == true){
            // return "wow";
            $status_order1 = implode(',', array(10, 0, 1, 2));
            $status_order2 = implode(',', array(0, 10, 1, 2));
            $datav = header::with('hotel','transportasi','approval','kasbon')
                    // ->select(DB::raw("IF(status = '10' && atasan = '$nik','anda belum memproses',
                    // IF(status = '0' && atasan2 = '$nik','anda belum memproses',
        
                    // IF(status = '0' && atasan = '$nik','anda telah memproses',
                    // IF(status = '10' && atasan2 = '$nik','anda telah memproses',
        
                    // IF(status = '10' && a.nik = '$nik','sedang diproses atasan pertama',
                    // IF(status = '0' && a.nik = '$nik','sedang diproses atasan kedua',
                    // IF(status = '1','diterima','ditolak'))))))) as status_name
                    // "))
                    // ->orderBy('status','asc')
                    // ->orderBy('id','desc')->orderBy('nik','desc')
                    
                    // ->orderBy('status', implode(',', array(10, 0, 1, 2)))
                    ->orderByRaw(DB::raw("FIELD(status, $status_order1)"))
                    // ## CASE
                    // ##     WHEN atasan = '$nik' THEN FIELD(status, $status_order1) 
                    // ##     WHEN atasan2 = '$nik' THEN FIELD(status, $status_order2)
                    // //     END ASC
                    // "))
                    ->orderBy('created_at','desc')
                    // ->orderBy(DB::raw("created_at DESC, 
                    //                     #CASE status
                    //                     #WHEN 0 AND dinas_h.atasan2 = '$nik' or atasan != '$nik' THEN 1
                    //                     #WHEN 10 AND atasan = '$nik' or atasan2 != '$nik' THEN 2
                    //                     #WHEN 1 THEN 3
                    //                     #WHEN 2 THEN 4
                    //                     END"),'ASC')
                    
                    ->get(); 
            $dataa = collect();
            if($datav){
                foreach($datav as $data1){
                    if($data1->approval['atasan'] == $nik || $data1->approval['atasan2'] == $nik){
                        $dataa->push($data1);
                    };
                }
            }

            // $dataa->sortBy('created_at','desc');
            // $dataa->sortBy('karyawan');
            // $dataa->sortBy('created_at');
            $order = array(10, 0, 1, 2);
            // $dataa->sort(function ($a, $b) use ($order) {
            //     $pos_a = array_search($a['status'], $order);
            //     $pos_b = array_search($b['status'], $order);
            //     return $pos_a - $pos_b;
            // });
            // $dataa->sortBy('created_at','desc');
            // $dataa->sortBy('status',$order);

            $status = ['target'=>'list approval','code'=>200,'description'=>'ok'];
            
            $datas = [
                'header' => $header,//KaryawanResource::collection($header),
                'data' => HeaderOnSelected::collection($dataa),
                'status' => ['target'=>'list approval','code'=>200,'description'=>'ok'],
            ];
            return Response::json($datas,200);
        }else{

            $datav = header::where('nik',$nik)->with('hotel','transportasi','approval','kasbon')
                // ->orderBy('dinas_h.status','asc')
                // ->orderBy('dinas_h.id','desc')
                ->orderBy('dinas_h.created_at','desc')
                ->get();
            // return $datav;
            $dataa = collect();
            // if($datav){
            //     foreach($datav as $data){
            //         if($data->approval['atasan'] == $nik || $data->approval['atasan2'] == $nik){
            //             // if($data->)
            //             $dataa->push($data);
            //         }
            //     }
            // }
            // $dataa->push($data);
            // return $datav;
            // $order = array(10, 0, 1, 2);
            // $data = $dataa->sort(function ($a, $b) use ($order) {
            //     $pos_a = array_search($a['status'], $order);
            //     $pos_b = array_search($b['status'], $order);
            //     return $pos_a - $pos_b;
            // });

            $data = $datav;

            $status = ['target'=>'list request','code'=>200,'description'=>'ok'];

            $datas = [
                'header' => $header,//KaryawanResource::collection($header),
                'data' => DinasResource::collection($datav),
                'status' => ['target'=>'list request','code'=>200,'description'=>'ok'],
            ];

            return Response::json($datas,200);
        }

        
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
        
        setlocale (LC_MONETARY, 'id_ID');
        // if(is_array($this->validationHeader($request)))
        // {
        //     return $this->validationHeader($request);
        // }else if(explode("/",$this->validationHeader($request))[0] == "HTTP"){
        //     return $this->validationHeader($request);
        // }

        //get nik by token
        $nik = $request->nik;

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
        
        $kry = count(kry_h::where('nik',$nik)->with('kry_d1')->first()) < 1 ? '' : 
                        kry_h::where('nik',$nik)->with('kry_d1')->first();

        $kry_atasan = $kry == '' ? '' : $kry->kry_d1->nik_atasan;

        $atasan = count(kry_h::where('nik',$kry_atasan)->with('kry_d1')->first()) < 1 ? '' : 
                            kry_h::where('nik',$kry_atasan)->with('kry_d1')->first();

        $atasan_atasan = $atasan == '' ? '' : $atasan->kry_d1->nik_atasan;

        $atasan_tdk = count(kry_h::where('nik',$atasan_atasan)->with('kry_d1')->first()) < 1 ? '' : 
                            kry_h::where('nik',$atasan_atasan)->with('kry_d1')->first();

        $periode_awal1 = count(explode(",",$request->periode_awal)) > 0 ? 
                        explode(",",$request->periode_awal)[0] : '';
        
        $start = strtotime($periode_awal1);
        $nik_atasan = $atasan == '' ? '' : $kry_atasan;
        $nik_atasan2 = $atasan_tdk == '' ? '-' : $atasan_atasan;

        if($nik_atasan == "-" || $nik_atasan == "" || $nik_atasan == null) {
            $data['status']['message'] = 'atasan tidak ditemukan';
            $data['status']['code'] = 206;
            $status = response()->json($data,206);
            return $status;
        }
        // if($nik_atasan == '' || $nik_atasan == '-' || $nik_atasan == null){}

        $now = strtotime(date("Y-m-d"));
        $jml_jedah = ceil(abs($start - $now) / 86400) + 1;
        $status = 0;

        // if($jml_jedah <= 6){
        //     $status = 10;
        // }else{
        //     $status = 0;
        // }

        if($jml_jedah <= 6){
            $status = $nik_atasan == '-' ? 0 :  10;
            if($nik_atasan2 == '-' || $nik_atasan2 == null || $nik_atasan2 == ''){
                $status = 0;
            }
        }else{
            $nik_atasan2 = '-';
            $status = 10;
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

        if(config('database.default') == "pma_testing"){
            $nik_atasan2 = '-';
        }
        
        $dinas_app = [
            'id' => '',
            'atasan' => $nik_atasan,
            'atasan2' => $nik_atasan2,
            'id_dinas' => $j_dinas_h,
        ];
        

        $dinas_h = header::insert($dinas);
        $dinas_appr = approval::insert($dinas_app);

        if(!$dinas_h)
        {
            //delete model cause fail
            header::where('id',$j_dinas_h)->delete();
            approval::where('id_dinas',$j_dinas_h)->delete();

            $data['status']['message'] = 'upload to dinas header failed...!!!!';
            $data['status']['code'] = 204;
            $status = response()->json($data,204);
        }

        $failed = false;

        //save hotel data
        $hotels = array();
        $periode_awal_1 = ""; $periode_awal_2 = ""; $periode_awal_3 = "";
        $periode_akhir_1 = ""; $periode_akhir_2 = ""; $periode_akhir_3 = "";
        $harga_hotels = 0;
        for($i = 0;$i < count(explode(",",$request->kota_tujuan_hotel));$i++){
            
            if($request->kota_tujuan_hotel == "" && $request->keperluan == ""){
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
            // return $periode_akhir;
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
                    approval::where('id_dinas',$j_dinas_h)->delete();
                    hotel::where('id_dinas',$j_dinas_h)->delete();

                    $data['status']['message'] = 'upload to dinas hotel failed, periode awal lebih kecil dari pada periode akhir hotel sebelumnya...!!!!';
                    $data['status']['code'] = 212;
                    return response()->json($data,212);
                }
            }

            
            $periode = $periode_awal." s/d ".$periode_akhir;
            $pembayaran_melalui = explode(",",$request->pembayaran_melalui)[$i];
            
            $check_in = $request->check_in != null && count(explode(",",$request->check_in)) > 0
                        ? explode(",",$request->check_in)[$i] : "00:00";
            $check_out =  $request->check_out != null && count(explode(",",$request->check_out)) > 0 
                        ? explode(",",$request->check_out)[$i] : "";
            
            $harga =  count(explode(",",$request->harga)) > 0 ? 
                    explode(",",$request->harga)[$i] : 0;

            if($request->harga == "" || $request->harga == null){
                $harga = "0.00";
            }

            $harga_hotels += str_replace('.','',$harga);

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
                'harga' => str_replace('.','',$harga),
            ];
        
            $dinas_hotel = hotel::insert($hotel);
            if(!$dinas_hotel)
            {
                //delete model cause fail
                header::where('id',$j_dinas_h)->delete();
                approval::where('id_dinas',$j_dinas_h)->delete();
                hotel::where('id_dinas',$j_dinas_h)->delete();

                $data['status']['message'] = 'upload to dinas hotel failed...!!!!';
                $data['status']['code'] = 205;
                $status = response()->json($data,205);
            }

            $hotels[$i] = $hotel; 
        }

    
        //save transportasi data
        $transports = array();
        $harga_transports = 0;
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
            
            if($request->harga_trans == "" || $request->harga_trans == null){
                $harga_trans = "0.00";
            }

            $harga_transports += str_replace('.','',$harga_trans);

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
                'harga' => is_numeric($harga_trans) ?  str_replace('.','',$harga_trans) : 0,
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
        
        // $hotel = $request['hotel'] == null ? '0' : $request['hotel'];
        $uang_makan = $request['uang_makan'] == null ? '0' : $request['uang_makan'];
        // $transport = $request['transport'] == null ? '0' : $request['transport'];
        $airport_tax = $request['airport_tax'] == null ? '0' : $request['airport_tax'];
        $taxi = $request['taxi'] == null ? '0' : $request['taxi'];
        $bbm = $request['bbm'] == null ? '0' : $request['bbm'];
        $laundry = $request['laundry'] == null ? '0' : $request['laundry'];


        $dinas_kasbon = [
            'id' => '',
            'hotel' => str_replace('.','',$harga_hotels),
            'uang_makan' => str_replace('.','',$uang_makan),
            'transport' => str_replace('.','',$harga_transports),
            'airport_tax' => str_replace('.','',$airport_tax),
            'taxi' => str_replace('.','',$taxi),
            'bbm' => str_replace('.','',$bbm),
            'laundry' => str_replace('.','',$laundry),
            'id_dinas' => $j_dinas_h,
        ];
        

        $dinas_kas = kasbon::insert($dinas_kasbon);
        if(!$dinas_kas){
             //delete model cause fail
             header::where('id',$j_dinas_h)->delete();
                
             hotel::where('id_dinas',$j_dinas_h)->delete();

             transportasi::where('id_dinas',$j_dinas_h)->delete();

             approval::where('id_dinas',$j_dinas_h)->delete();

             $data['status']['message'] = 'upload to dinas failed...!!!!';
             $data['status']['code'] = 205;
             $status = response()->json($data,205);
        }

        //if success store data
        $data['status']['message'] = 'OK - Upload success';
        $data['status']['code'] = 200;
        $data['data']['header'] = $dinas;
        $data['data']['hotel'] = $hotels;
        $data['data']['transportasi'] = $transports;
        $data['data']['kasbon'] = $dinas_kasbon;    
        $data['data']['approval'] = $dinas_app;
        
        // return $header;//
        if(!$failed){
                $device = DB::table('token_device')->where("nik", $nik_atasan)->first();
                if($device){
                    $token = $device->token;			
                    // $nik = $device->nik;

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
                }
                $status = response()->json($data,200);
                return $status;
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

        $data = header::where('id',$request->id)->with('hotel','transportasi','approval')->get();

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
        // if(is_array($this->validationHeader($request)))
        // {
        //     return $this->validationHeader($request);
        // }else if(explode("/",$this->validationHeader($request))[0] == "HTTP"){
        //     return $this->validationHeader($request);
        // }
        $firebaseApi = new FirebaseApi();
        $nik = $request->nik;
        $data = header::where('id',$request->id_approval)->with('hotel','transportasi','approval')->get();
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

        
        $data_app = header::where('id', $request->id_approval)->first();
        

        if(count($data_app) < 1){
            $datas['status'] = "Id approval not valid";
            return response()->json($datas,500);
        }


        $status = 0;
        //check
            $datas['status']['status_message'] = "OK - Approved Success";
            $datas['status']['status_code'] = 200;

            $data_app = header::where('id', $request->id_approval)->first();
            $nik_ats = $data_app ? "".$data_app->nik:""; 
            
            $pengaju = count(header::where('id',$request->id_approval)->with('approval')->first()) < 1  ? '' : 
                        header::where('id',$request->id_approval)->first();
            // $pengaju = $pengaju != '' ? $atasan : '';

            $kry_pengaju = count(kry_h::where('nik',$pengaju->nik)->with('kry_d1')->first()) < 1 ? '' : 
                        kry_h::where('nik',$pengaju->nik)->with('kry_d1')->first();
    
            $kry_pengaju = $kry_pengaju != '' ? $kry_pengaju->kry_d1->nik_atasan : '';
            $atasan_pengaju = count(kry_h::where('nik',$kry_pengaju)->with('kry_d1')->first()) < 1 ? '' : 
                                    kry_h::where('nik',$kry_pengaju)->with('kry_d1')->first();

            $atasan_pengaju_pengaju = $atasan_pengaju != '' ? $atasan_pengaju->kry_d1->nik_atasan : '';
            $atasan_tdk_pengaju = count(kry_h::where('nik',$atasan_pengaju_pengaju)->with('kry_d1')->first()) < 1 ? '' : 
                            kry_h::where('nik',$atasan_pengaju_pengaju)->with('kry_d1')->first();
            
            // return $nik_ats;

            $atasan_app = approval::where('id_dinas', $request->id_approval)->first();
            $atasan_p1 = $atasan_app ? $atasan_app->atasan : '';

            $atasan_p = count(kry_h::with('kry_d1')->where('nik',$atasan_p1)->first()) < 1 ? '' : 
                                    kry_h::where('nik',$atasan_p1)->first()->kry_d1->nik_atasan;
            //if database test
            $atasan_p2 = $atasan_app ? $atasan_app->atasan2 : '';
            

            // return $atasan_p1;
            //status approvald default
            $nik_atasan = $atasan_p1;
            //testing mode
            $nik_atasan2 = $atasan_p2;

            $status_app = 0;

            $pengaju_status = $pengaju->status;
            // return $pengaju->status;
        //

        //cek status done
        if($pengaju->status == 1 && $pengaju->status == 2) {
            $status = ['code' => 505, 'description' => 'status done, cant change'];
           return Response::json(compact('header', 'data', 'status'), 505);
        }
        
        $pengaju_nik = count($pengaju) > 0 ? $pengaju->nik : '';
        $pengaju_atasan1 = count($pengaju->approval) > 0 ? $pengaju->approval->atasan : '';
        $pengaju_atasan2 = count($pengaju->approval) > 0 ? $pengaju->approval->atasan2 : '';

        // return "wow";

        if($request->tipe_approval == "approved")
        {
            
            if($pengaju->status == 10){
                $nik_atasan = $pengaju_atasan1;
                $status_app = $pengaju_atasan2 == '-' || $pengaju_atasan2 == '' ? 1  : 0;
                if($this->checkTest()){
                    $status_app = 0; 
                }
            }else if($pengaju->status == 0) {
                $nik_atasan = $pengaju_atasan2;
                $status_app = 1; 
            } 

            if($pengaju->status == 10){
                // return $nik.' '.$pengaju->status;
            //     if($nik != $pengaju_atasan1 ){
            //         // return $nik.' = '.$pengaju->approval->atasan;
            //         $status = ['code' => 500, 'description' => 'NOt Access 1'];
            //         return response()->json(compact('header', 'data', 'status'), 500);
            //    }
            }

            if($pengaju->status == 0){
                // return $nik.' '.$nik_atasan;
            //    if($nik != $pengaju_atasan2){
            //         $status = ['code' => 500, 'description' => 'NOt Access 2'];
            //         return response()->json(compact('header', 'data', 'status'), 500);
            //    }
            }
            

            $device = false;
            if($pengaju->status == 10)
            {
                if($status_app == 1){
                    $device = DB::table('token_device')->where("nik", $pengaju_nik)->first();
                }else{
                    $device = DB::table('token_device')->where("nik", $pengaju_atasan2)->first();
                }
                
                
                if($this->checkTest()){
                    $devices = DB::table('token_device')
                        ->leftJoin('m_group_user','m_group_user.user_id','=','token_device.nik')
                        ->whereIn('group_id',['20','21','22','23','24','25','26','27','28'])->get();
                    //return $pengaju->status;
                    $update = header::where('id', $request->id_approval)
                        ->update(['status' => $status_app],['date_appr' => date("Y-m-d H:i:s")]); 
                           
                    foreach($devices as $device){
                        
 
                            $token = $device->token; 
                            $requestData = array(
                                        'title' => "Pengajuan Perjalanan Dinas",
                                        'message' => "Pengajuan DINAS dari nik : ".$pengaju->nik,
                                        'image_url' => "",
                                        'action' => "activity",
                                        'action_destination' => "DinasList",
                            );
                            $send_to = "";
                            $firebaseApi->postData($token, $send_to, $requestData);

                    }
                    return response()->json($datas,200);
                }else{
                    $update = header::where('id', $request->id_approval)
                        ->update(['status' => $status_app]);
                }

                
            } 
            else if($pengaju->status == 0)
            {
                $device = DB::table('token_device')->where("nik", $pengaju_nik)->first();
                if($this->checkTest()){
                    $update = header::where('id', $request->id_approval)
                            ->update(['status' => $status_app],['atasan2' => $nik],['date_appr' => date("Y-m-d H:i:s")]); 
                }else{
                    $update = header::where('id', $request->id_approval)
                        ->update(['status' => $status_app]);
                }
                
            }

            
           
            $token = ""; 
            if($device){
                $token = $device->token;			
                // return $token;
               
                if($status_app == 1)
                {
                    $requestData = array(
                        'title' => "Pengajuan Perjalanan Dinas",
                        'message' => "Selamat, Pengajuan DINAS anda di terima",
                        'image_url' => "",
                        'action' => "activity",
                        'action_destination' => "DinasList",
                    );
                    $send_to = "";
                    $firebaseApi->postData($token, $send_to, $requestData);
                }
                else if($status_app != 1)
                {
                    
                    $requestData = array(
                        'title' => "Pengajuan Perjalanan Dinas",
                        'message' => "Pengajuan Perjalanan dinas oleh nik : ".$pengaju_nik,
                        'image_url' => "",
                        'action' => "activity",
                        'action_destination' => "DinasList",
                    );
                    $send_to = "";
                    $firebaseApi->postData($token, $send_to, $requestData);
                }
                
                // return $status_app;
               

                $datas['data'] = [
                    'id_dinas' => $request->id_approval,
                    'atasan' => $nik_atasan,
                    'atasan2' => $nik_atasan2,
                    'status' => $status_app,
                ];

                
            }

            return response()->json($datas,200);
        }
        else if($request->tipe_approval == "rejected")
        {
                if($pengaju_status == 10 && $nik != $pengaju_atasan1){
                    // return $nik.' '.$nik_atasan;
                    $status = ['code' => 500, 'description' => 'NOt Access 1'];
                    return response()->json(compact('header', 'data', 'status'), 500);
                }

                if($pengaju_status == 0 && $nik != $pengaju_atasan2){
                    // return $nik.' '.$nik_atasan;
                    $status = ['code' => 500, 'description' => 'NOt Access 2'];
                    return response()->json(compact('header', 'data', 'status'), 500);
                }
            // } 
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

    private function checkTest(){
		if(config('database.default') == "pma_testing"){
			return true;
		}
		return false;
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
}
