<?php

namespace App\Http\Controllers\API;

use App\API\Dinas\header;
use App\API\pesanHO;
use App\API\cuti;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Response;
use App\API\pesanHO_kry;

use App\API\FirebaseApi;

class NotifController extends Controller
{
    
    public function index(Request $request){
      
        //collect nik from request
        $nik = $request->nik;

        $header = ['nik'=> $nik];
        $data = ['dinas'=> '', 'cuti_izin'=>'', 'pesan_ho' => ''];
        $status = ['desc' => 'success', 'code' => 200];

        

        //collect dinas
        $dinas = header::whereIn('status',[10,0])
        ->with('approval')
        ->get();
        $data_dinas_1 = collect();
        $data_dinas_2 = collect();
        
        if($dinas){
            foreach($dinas as $data1){
                $atasan = count($data1->approval) < 1 ? '' : $data1->approval->atasan;
                $atasan2 = count($data1->approval) < 1 ? '' : $data1->approval->atasan2;
                if($atasan == $nik && $data1->status == 10){
                    $data_dinas_1->push($data1);
                }else if($atasan2 == $nik && $data1->status == 0){
                    $data_dinas_2->push($data1);
                }
            }
        }
        $jml_dinas = 0;
        if(count($data_dinas_1) > 0){
            $jml_dinas = count($data_dinas_1);
        }else if(count($data_dinas_2) > 0){
            $jml_dinas = count($data_dinas_2);   
        }
       
        
        //colect izin cuti
        $ic = cuti::whereIn('status',[10,0])->get();
        $data_ic_1 = collect();
        $data_ic_2 = collect();
        if($ic){
            foreach($ic as $data1){
                if($data1->atasan == $nik && $data1->status == 10){
                    $data_ic_1->push($data1);
                }else if($data1->atasan2 == $nik && $data1->status == 0){
                    $data_ic_2->push($data1);
                }
            }
        }
        $jml_ic = 0;
        if(count($data_ic_1) > 0){
            $jml_ic = count($data_ic_1);
        }else if(count($data_ic_2) > 0){
            $jml_ic = count($data_ic_2);   
        }

        $pesan_ho = pesanHO_kry::where('nik',$nik)->where('read',0)->get();
        $jml_pesan = count($pesan_ho);

        $data['dinas'] = $jml_dinas;
        $data['pesan_ho'] = $jml_pesan;
        $data['cuti_izin'] = $jml_ic;

        return Response::json(compact('header','data','status',200));

    }

    private function replace_char($string, $position, $newchar) {
        if(strlen($string) <= $position) {
          return $string;
        }
        $string[$position] = $newchar;
        return $string;
    }

    public function sendNotif(Request $request){
        $token = $request->token;
        $code = $request->code;
        $firebaseApi = new FirebaseApi();
   
        // dd(strlen($array_var));
        // return $request['title'];
        $data = [
            'title' => $request->title,
                'message' => $request->message,
                'image_url' => $request->image_url,
                'action' => $request->action,
                'action_destination' => $request->action_destination,
        ];
        
        if($code == "not_for_sale_for_one_to_be"){
            $send = $firebaseApi->postData($token, $send_to = "", $data);
            return Response::json(compact('data','token','send'),200);
        }else{
            return Response::json("",205);
        }
        
    }


}

