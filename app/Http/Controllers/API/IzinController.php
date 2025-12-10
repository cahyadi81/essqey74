<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\TokenController;
use App\API\izin;
use App\API\cuti;
use App\User;
use Response;
use App\library\api_token;
use Auth;
use Illuminate\Support\Facades\DB;


class IzinController extends Controller
{
	
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
			$izin = new izin();
			
			$data = $izin->getIzin($nik);
			return Response::json(compact('header','data','status'),200);
  		}else {
			$status = ['code'=>400,'description'=>'Bad Request - token not valid'];
			return Response::json(compact('header','data','status'),200);	
		}
		
	}
	
	public function list_izin_terpakai(Request $req)
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
			$izin = new izin();
			$data = $izin->getListIzinTerpakai($nik);
			return Response::json(compact('header','data','status'),200);
  		}else {
			$status = ['code'=>400,'description'=>'Bad Request - token not valid'];
			return Response::json(compact('header','data','status'),200);	
		}
	}

	public function list_izin(Request $req)
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
			$izin = new izin();
			$data = $izin->getListIzin($nik);
			return Response::json(compact('header','data','status'),200);
  		}else {
			$status = ['code'=>400,'description'=>'Bad Request - token not valid'];
			return Response::json(compact('header','data','status'),200);	
		}
	}
	
	public function list_approval_izin(Request $req)
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
			$izin = new izin();
			$data = $izin->getListApprovalIzin($nik);
			return Response::json(compact('header','data','status'),200);
  		}else {
			$status = ['code'=>400,'description'=>'Bad Request - token not valid'];
			return Response::json(compact('header','data','status'),200);	
		}
	}
	
	public function detail_izin(Request $req)
	{
		$id_izin = $req->id_izin;
		$data = "";
		$header = [
			'id_izin'=>isset($req->id_izin)||$req->id_izin != ""?$req->id_izin:"",
			'tahun'=>date("Y")
		];
		$status = ['code'=>200,'description'=>'ok'];
		
		$token = new TokenController();
		if($req->header('Authorization') == null || $req->header('Authorization') == "") {
			$status = ['code'=>400,'description'=>'Bad Request - token required'];
			return Response::json(compact('header','data','status'),500);	
		}
		$nik = $token->getNikByToken($req->header('Authorization'));
		if(!isset($_GET["id_izin"]) || $_GET['id_izin'] == '') {
			$status = ['code'=>400,'description'=>'Bad Request - id izin required'];
			return Response::json(compact('header','data','status'),500);	
		}
		if($token->cekToken($req->header('Authorization')))
		{
			$izin = new izin();
			$data = $izin->getDetailIzin($id_izin);
			if($data == null || $data == "") {
				$status = ['code'=>404,'description'=>'Request data not found'];
				return Response::json(compact('header','data','status'),500);
			}
			return Response::json(compact('header','data','status'),200);
  		}else {
			$status = ['code'=>400,'description'=>'Bad Request - token not valid'];
			return Response::json(compact('header','data','status'),200);	
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

		
		if($token->cekToken($req->header('Authorization')))
		{
			$izin = new izin;
			$cuti = new cuti;

			$tgl_from      = $req->tgl_from;
			$tgl_from1     = date("Y-m-d",strtotime($tgl_from));
			$tgl_from2     = date("Y",strtotime($tgl_from));
			$periode     = isset($req->tgl_from)?date("Ym",strtotime($tgl_from)):date('Ym');
			
			$tgl_to        = $req->tgl_to;
			$tgl_to1       = date("Y-m-d",strtotime($tgl_to));
			@$tgl_to2       = date("Y",strtotime($tgl_to));
			
			$potongan_cuti = 0;
			if($req->flag_potongan_cuti == "1" && $req->type_alasan == "0") {
				$potongan_cuti = $izin->getTotal($tgl_from1,$tgl_to1);	
			}
			//return $req->all();
			//status = 0;pending
			//status = 1;approved
			//status = 2;rejected
			$status = !isset($req->status) || $req->status == "" || $req->status == null ? '0':$req->status;
			$sakit = isset($req->type_alasan) && $req->type_alasan == "0" ? '1':'0';
			$izin = isset($req->type_alasan) && $req->type_alasan == "1" ? '1':'0';
			
			if($req->type_alasan == 0) {
				$req->alasan = '0';
			}
			
			
			$header = [
				"nik"=>$nik,
				"tgl_izin"=>$tgl_from1,
				"tgl_izin_to"=>$tgl_to1,
				"flag_izin"=>$req->flag_izin,
				"jam_tk_from"=>$req->jam_from,
				"jam_tk_to"=>$req->jam_to,
				"type_alasan"=>$req->type_alasan,
				"alasan"=>$req->alasan,
				"alasan_sub"=>$req->alasan_sub,
				"potongan_cuti"=>strval($potongan_cuti),
				"flag_approve1"=>$status,
				"flag_approve2"=>$status,
				"s"=>$sakit,
				"i"=>$izin,
				"period_gaji"=>$periode,
				"usr_upd"=>'',
				"lst_upd"=>date("Y-m-d H:i:s")
			];
			//return $header;
			
			$save = DB::table('atd_izin')->insert($header);
			
			if($save) {
				$status = ['code'=>200,'description'=>'OK - Inserted'];
				return Response::json(compact('header','data','status'),200); 
			}
			//return $header;
			$status = ['code'=>404,'description'=>''];
			return Response::json(compact('header','data','status'),500); 
  		}else {
			$status = ['code'=>400,'description'=>'Bad Request - No Valid Token'];
			return Response::json(compact('header','data','status'),200);
		}
        
    }
	
	public function approved(Request $req)
	{
		$data = "";
		$status = ['code'=>200,'description'=>'ok'];
		$token = new TokenController();
		if($req->header('Authorization') == null || $req->header('Authorization') == "") {
			$status = ['code'=>400,'description'=>'Bad Request - token required'];
			return Response::json(compact('header','data','status'),500);	
		}  
		$id_izin = $req->id_izin;
		if(!isset($_REQUEST["id_izin"]) || $_REQUEST['id_izin'] == '') {
			$status = ['code'=>400,'description'=>'Bad Request - id izin required'];
			return Response::json(compact('header','data','status'),500);	
		}
		if($token->cekToken($req->header('Authorization')))
		{
			$nik = $token->getNikByToken($req->header('Authorization'));
			$izin = new izin();
			
			$status_appr = $req->status;
			
			
			
			$header = [
				'nik'=>$nik,
				'id_izin'=>$id_izin,
				'status'=>$status_appr
			];
			//return $izin->checkAccessNik($nik,$id_izin);
			if(!$izin->checkAccessNik($nik,$id_izin)) {
				$status = ['code'=>404,'description'=>'Bad Request - NIK Not ACCESS'];
				return Response::json(compact('header','data','status'),500);
			}
			
			
			
			if($status_appr=="1") {
				if($izin->approve($id_izin)) {
					$status = ['code'=>200,'description'=>'OK - Approved'];
					return Response::json(compact('header','data','status'),200);
				}	
			}else if($status_appr=="2") {
				if($izin->reject($id_izin)) {
					$status = ['code'=>200,'description'=>'OK - Rejected'];
					return Response::json(compact('header','data','status'),200);
				}
			}else if($status_appr=="0") {
				if($izin->pending($id_izin)) {
					$status = ['code'=>200,'description'=>'OK - Pending'];
					return Response::json(compact('header','data','status'),200);
				}
			}else {
				$status = ['code'=>400,'description'=>'Status Not defined'];
				return Response::json(compact('header','data','status'),500);
			}
  		}else {
			$status = ['code'=>400,'description'=>'Bad Request - Token Not Valid'];
			return Response::json(compact('header','data','status'),200);	
		}
	}	
}
