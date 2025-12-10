<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\TokenController;
use App\API\karyawan;
use App\API\user;
use Response;
use Illuminate\Support\Facades\DB;

use App\API\Goverment\Provinsi;
use App\API\Goverment\KotaKab;
use App\API\Goverment\Kecamatan;
use App\API\Goverment\Kelurahan;


use \Intervention\Image\Facades\Image;

use App\API\Karyawan\kry_h;
use App\API\Karyawan\kry_d1;
use App\API\Karyawan\kry_d2;
use App\API\Karyawan\kry_d3;
use App\API\Karyawan\kry_d4;
use App\API\Karyawan\kry_d5;
use App\API\Karyawan\kry_d6;
use App\API\Karyawan\kry_d7;


class KaryawanController extends Controller
{

	public function checkTest(){
		if(config('database.default') == "pma_testing"){
			return true;
		}
		return false;
	}

	public function index(Request $req)
	{
		// $value = config('database.default');
		// DB::disconnect('pma');
		// $data = DB::connection('mysql')
    //         ->table('kry_h')
    //         ->get();
    //     DB::disconnect('mysql');
    // return Response::json($value,200);	
		$data = "";
		$status = ['code'=>200,'description'=>'ok'];
	
		$nik = $req->nik;

		$header = [
			'nik'=>$nik
		];

		$karyawan = new karyawan();
		$data = $karyawan->getKaryawan($nik);
		if($data == "") {
			$status = ['code'=>500,'description'=>'Bad Request - Request data not found'];
			return Response::json(compact('header','data','status'),500);	
		}
		return Response::json(compact('header','data','status'),200);	
		
	}

	public function upload_image(Request $req)
	{
		$data = "";
		$status = ['code'=>200,'description'=>'ok'];

		//cek size file
		// return $req->server('CONTENT_LENGTH');
		if ($req->server('CONTENT_LENGTH') > 3000000)
		{
			$status = ['code'=>306,'description'=>'Bad request - file too large max 3MB'];
			return Response::json(compact('header','data','status'),306);	
		}

		//declare class karyawan model
		$karyawan = new karyawan();

		$nik = $req->nik;

		// put nik to header
		$header = [
			'nik'=>$nik
		];

		//cek jika file code 203
		if ($req->file('foto_karyawan') == null) 
		{
			$status = ['code'=>303,'description'=>'Bad Request - not file upload'];
			return Response::json(compact('header','data','status'),303);
			
		}

		//cek jika file code 203
		if (!$req->hasFile('foto_karyawan')) 
		{
			$status = ['code'=>203,'description'=>'Bad Request - not file upload'];
			return Response::json(compact('header','data','status'),303);
			
		}

		//cek jika file valid code 202
		if(!$req->file('foto_karyawan')->isValid())
		{
			$status = ['code'=>302,'description'=>'Bad Request - file invalid'];
			return Response::json(compact('header','data','status'),302);
		}

		//if success but checking file finnaly code 200
		try 
		{
			$file = $req->file('foto_karyawan');
			$name = $karyawan->getKode($nik) . '.jpg';
			
			$extensions = ["jpeg","jpg","gif","png"];
			

			//cek type file, code 306
			if (!in_array($file->getClientOriginalExtension() , $extensions))
			{
				$status = ['code'=>307,'description'=>'Bad request - file not image'];
				return Response::json(compact('header','data','status'),307);	
			}

			//upload file
			//$req->file('foto_karyawan')->move("foto_karyawan/", $name);

			// ready to go ...
			//$image = Image::make('foto_karyawan/thumb/'.$name)->resize(256, 256);
			try{
				//$thumb = \Intervention\Image\Facades\Image::make(public_path('foto_karyawan/thumb_' . $name));

				$ds = config('database.default');
				$img = Image::make($file);
				$width = $img->width();
				$height = $img->height();
				$img->save(public_path("foto_karyawan/$ds/$name"))
						->resize(200, null, function ($constraint) {
							$constraint->aspectRatio();
						})
						->save(public_path("foto_karyawan/$ds/thumb_$name"));
				
				//$thumb->resize(320, 240);
    		//$thumb->save(public_path('foto_karyawan/thumb_' . $name));
			}
			catch(Intervention\Image\Exception\NotReadableException $nre){
				$status = ['code'=>305,'description'=>$nre];
				return Response::json(compact('header','data','status'),305);
			}
			
			$status = ['code'=>200,'description'=>'success upload'];

			return Response::json(compact('header','data','status'),200);
		} 
		//file not found code 201 
		catch (Illuminate\Filesystem\FileNotFoundException $e) 
		{
			$status = ['code'=>301,'description'=>'Bad Request - file not found'];
			return Response::json(compact('header','data','status'),301);
		}
		$status = ['code'=>200,'description'=>'success upload'];

		return Response::json(compact('header','data','status'),200);
	}

	public function delete_force(Request $req)
	{
			if($req->pin == '2305'){
				$nik = $req->nik;
				$kry = karyawan::where("nik",$nik)->first(); 
				if($req->target == "pengalaman_kerja"){
					$del1 = kry_d6::where('kode_karyawan',$kry->kode_karyawan)->delete();
					$del2 = kry_d7::where('kode_karyawan',$kry->kode_karyawan)->delete();
					if(!$del1 && !$del2){
						return "failed";
					}else{
						return "success";
					}
				}else{
					return "belum ada";
				}
			}
			
	}

	public function update(Request $req)
	{
		$data = "";
		$status = ['code'=>200,'description'=>'ok'];

		// return Response::json(compact('data','status'),200);	
		//declare class karyawan model
		$karyawan = new karyawan();
	
		//get nik by token != null / kosong
		$nik = $req->nik;

		// put nik to header
		$header = [
			'nik'=>$nik
		];

		$kry = karyawan::where("nik",$nik)->get(); 

		$target = [
			'personal' => new kry_h,
			'hr' => new kry_d1,
			'keluarga'=> new kry_d2,
			'pendidikan'=> new kry_d3,
			'bahasa'=> new kry_d4,
			'organisasi'=> new kry_d5,
			'pengalaman_kerja'=> new kry_d6,
		];
		$action = new kry_h;
		if($req->header('target') != ""){
			$action = $target[$req->header('target')];
		}
		$target = $req->header('target');
		// return $req->header('target');
		$id = $kry[0]->id;

		$request = $req;
		// if($request->tanggal_nikah != null){
		// 	$tanggal_nikah = date("Y-m-d",strtotime($request->tanggal_nikah));
		// 	//$request->request->remove('tanggal_nikah');
		// 	$request->merge(['tanggal_nikah' => $tanggal_nikah]);
		// }
		if($request->tanggal_lahir != null){
				$tanggal_lahir = date("Y-m-d",strtotime($request->tanggal_lahir));
				// $request->request->remove('tanggal_lahir');
				$request->merge(['tanggal_lahir' => $tanggal_lahir]);
		}
		if($request->kadaluarsa_sim_a != null){
				$kadaluarsa_sim_a = date("Y-m-d",strtotime($request->kadaluarsa_sim_a));
				// $request->request->remove('kadaluarsa_sim_a');
				$request->merge(['kadaluarsa_sim_a' => $kadaluarsa_sim_a]);
		}
		if($request->kadaluarsa_sim_b != null){
				$kadaluarsa_sim_b = date("Y-m-d",strtotime($request->kadaluarsa_sim_b));
				// $request->request->remove('kadaluarsa_sim_b');
				$request->merge(['kadaluarsa_sim_b' => $kadaluarsa_sim_b]);
		}
		if($request->kadaluarsa_sim_c != null){
				$kadaluarsa_sim_c = date("Y-m-d",strtotime($request->kadaluarsa_sim_c));
				$request->merge(['kadaluarsa_sim_c' => $kadaluarsa_sim_c]);
		}
		if($request->kadaluarsa_ktp != null){
				$kadaluarsa_ktp = date("Y-m-d",strtotime($request->kadaluarsa_ktp));
				// $request->request->remove('kadaluarsa_ktp');
				$request->merge(['kadaluarsa_ktp' => $kadaluarsa_ktp]);
		}
		if($request->kadaluarsa_passport != null){
				$kadaluarsa_passport = date("Y-m-d",strtotime($request->kadaluarsa_passport));
				// $request->request->remove('kadaluarsa_passport');
				$request->merge(['kadaluarsa_passport' => $kadaluarsa_passport]);
		}

		
		if($req->header('action') == "insert")
		{
			// if($kry[0]->id == "" || $kry[0]->id == null)
			// {
					$kode_karyawan = $kry[0]->kode_karyawan;
					$nama_perusahaan = $req->nama_perusahaan;
					//$req->merge(['kode_karyawan'=>$kode_karyawan]);

					
					if($kode_karyawan != "" || $kode_karyawan != null)
					{
						$kode_karyawan = $kry[0]->kode_karyawan;
						$req->merge(['kode_karyawan'=>$kode_karyawan]);
						if($target == 'pengalaman_kerja')
						{
							// //kry_d6
							// $select1 = kry_d6::where('kode_karyawan',$kode_karyawan)->where('nama_perusahaan','!=',$req->nama_perusahaan)->first();
							// if(!$select1){
							// 		$j_peng1 = kry_d6::max('id');
							// }else{
							// 		$j_peng1 = kry_d6::max('id') + 1;
							// }
	
							// //kry_d7
							// $j_peng2 = kry_d7::max('id');
							// if($j_peng2 >= $j_peng1)
							// {
							// 		$j_peng2 = $j_peng1 + 1;
							// 		$j_peng1 = $j_peng1 + 1;
							// }else{
							// 		$j_peng1 = $j_peng1 + ($j_peng1-$j_peng2);
							// 		$j_peng2 = $j_peng1;
							// }
							if($this->checkTest()){
								//$cgaji_terakhir = $request->gaji_terakhir;
								//$cgaji_terakhir = str_replace('.','',$request->gaji_terakhir);
								$req->merge(['gaji_terakhir'=>$cgaji_terakhir]);
							}
							$data = ['d6'=>'','d7'=>''];	
							$req->merge(['kode_karyawan'=>$kode_karyawan]);
							$d6 = $request->only(['kode_karyawan','nama_perusahaan','alamat_perusahaan','kota','telepon','jabatan_terakhir','tanggal_masuk','tanggal_keluar','alasan_keluar','nama_atasan','gaji_terakhir']);
							if(kry_d6::insert($d6))
							{
								$status = ['code'=>200,'description'=>'OK - Success Insert'];
								$data['d6'] = $d6;
							}

							// $req->merge(['id'=>$j_peng2]);
							$d7 = $req->only('kode_karyawan','nama_perusahaan','job');
							if(kry_d7::insert($d7))
							{
								$status = ['code'=>200,'description'=>'OK - Success Insert'];
								$data['d7'] = $d7;
							}

							return Response::json(compact('header','data','status'),200);	
						}
						else
						{
							$insert = $action::insert($req->input());
							// $insert = $action::updateOrCreate($req->input());
							
							if($insert)
							{
								$status = ['code'=>200,'description'=>'OK - Success Insert'];
								$data = $req->input();
								return Response::json(compact('header','data','status'),200);	
							}
						}
					}
					// else{
					// 	$insert = $action::insert($req->all());
					// 	if($insert)
					// 	{
					// 		$status = ['code'=>200,'description'=>'OK - Success Insert'];
					// 		$data = $req->all();
					// 		return Response::json(compact('header','data','status'),200);	
					// 	}
					// }
			// }

			$status = ['code'=>305,'description'=>'Bad Request - Failed Insert'];
			$data = $req->all();
			return Response::json(compact('header','data','status'),305);	
		}
		else if($req->header('action') == "update")
		{
			// $id = $req->header('id');
		  $kode_karyawan = $kry[0]->kode_karyawan;
			$nama_perusahaan = $req->nama_perusahaan;
			// $req->merge(['kode_karyawan'=>$kode_karyawan]);

			if($target == 'personal')
			{
				$kode_karyawan = $kry[0]->kode_karyawan;
				$h = $req->except(['id_prop','id_kec','id_kel','id_kab','lokasi_kerja']);
				$d1 = $req->only(['id_prop','id_kec','id_kel','id_kab']);
				
				if(count($h) > 0){
					$updatedh = kry_h::where("kode_karyawan",$kode_karyawan)->update($h);
				}
				if(count($d1) > 0){
					$updated1 = kry_d1::where("kode_karyawan",$kode_karyawan)->update($d1);
				}
				
				if(count($h) > 0){
					if($updatedh)
					{
						$status = ['code'=>200,'description'=>'OK - Success Update'];
						$data = $req->all();		
					}
				}

				if(count($d1) > 0){
					if($updated1)
					{
						$status = ['code'=>200,'description'=>'OK - Success Update'];
						$data = $req->all();		
					}
				}

				if(count($h) > 0 || count($d1) > 0){
					return Response::json(compact('header','data','status'),200);	
				}
			}
			else if($target == 'pengalaman_kerja')
			{
				if($this->checkTest()){
					$cgaji_terakhir = str_replace('.','',$request->gaji_terakhir);
					$req->merge(['gaji_terakhir'=>$cgaji_terakhir]);
				}
				$d6 = $request->only(['nama_perusahaan','alamat_perusahaan','kota','telepon','jabatan_terakhir','tanggal_masuk','tanggal_keluar','alasan_keluar','nama_atasan','gaji_terakhir']);
				$d7 = $request->only(['nama_perusahaan','job']);
				
				$updated6 = 0;
				$updated7 = 0;
				if(count($d6) > 0){
					$updated6 = kry_d6::where("kode_karyawan",$kode_karyawan)
						->where("nama_perusahaan",'=',$request->old_nama_perusahaan)
						->where("jabatan_terakhir",'=',$request->old_jabatan_terakhir)
						->update($d6);
				}

				if(count($d7) > 0){
					$updated7 = kry_d7::where("kode_karyawan",$kode_karyawan)
						// ->where("nama_perusahaan",'=',$request->old_nama_perusahaan)
						->where("job",'=',$request->old_job)
						->update($d7);
				}
				
				$success = 0;
				$success_d6 = 0;
				$success_d7 = 0;
				$data_d6 = $d6;
				$data_d7 = $d7;

				// $selectd6 = kry_d7::where("kode_karyawan",'=',$kode_karyawan)
				// // ->where("nama_perusahaan",'=',$request->old_nama_perusahaan)
				// // ->where("jabatan_terakhir",'=',$request->old_jabatan_terakhir)
				// ->get();
				
				// return $selectd6;
				// dd($updated6);
					if($updated6)
					{
						$status = ['code'=>200,'description'=>'OK - Success Update'];
						$data_d6 = $d6;
						$success = 1;		
					}else{
						$success_d6 = 10;
					}

					if($updated7)
					{
						$status = ['code'=>200,'description'=>'OK - Success Update'];
						$data_d7 = $d7;	
						$success = 1;	
					}else{
						$success_d7 = 11;
					}
	

				$header = ['nik'=>$nik,'input'=>$req->all()];
				$data = ['d6'=>$data_d6,'d7'=>$data_d7];

				if($success == 1)
				{
					return Response::json(compact('header','data','status'),200);	
				}
				else
				{
					if($success_d7 == 10)
					{
						$status = ['code'=>305,'description'=>'Bad Request - d6 failed update'];
						// $data = $req->all();
						return Response::json(compact('header','data','status'),305);		
					}
					else if($success_d7 == 11)
					{
						$status = ['code'=>305,'description'=>'Bad Request - d7 failed update'];
						// $data = $req->all();
						return Response::json(compact('header','data','status'),305);	
					}
					$status = ['code'=>305,'description'=>'Bad Request - Failed Update'];
					// $data = $req->all();
					return Response::json(compact('header','data','status'),305);	
				}
					
			}
			else if($target == 'organisasi')
			{
				$data = $req->except(['kode_karyawan','old_nama_organisasi','old_tahun_organisasi','old_jabatan']);
				$update = kry_d5::where("kode_karyawan",$kode_karyawan)
					->where("nama_organisasi",$req->old_nama_organisasi)
					->where("tahun_organisasi",$req->old_tahun_organisasi)
					->where("jabatan",$req->old_jabatan)
					->update($data);
				if($update)
				{
					$status = ['code'=>200,'description'=>'OK - Success Update'];
					$data = $req->all();
					return Response::json(compact('header','data','status'),200);	
				}else{
					$status = ['code'=>305,'description'=>'Bad Request - Failed Update'];
					$data = $req->all();
					return Response::json(compact('header','data','status'),305);	
				}
			}
			else if($target == 'bahasa')
			{
				$data = $request->only(['bahasa','menulis','mengerti','berbicara','membaca']);
				$update = kry_d4::where("kode_karyawan",$kode_karyawan)
					->where("bahasa",$request->old_bahasa)
					// ->where("menulis",$req->menulis)
					// ->where("mengerti",$req->mengerti)
					// ->where("berbicara",$req->berbicara)
					// ->where("membaca",$req->membaca)
					->update($data);
				if($update)
				{
					$status = ['code'=>200,'description'=>'OK - Success Update'];
					$data = $request->all();
					return Response::json(compact('header','data','status'),200);	
				}else{
					$status = ['code'=>305,'description'=>'Bad Request - Failed Update'];
					$data = $request->all();
					return Response::json(compact('header','data','status'),305);	
				}
			}
			else if($target == 'pendidikan')
			{
				$data = $req->except(['kode_karyawan','old_flag_formal_non_formal','old_jenis_sekolah','old_nama_sekolah','old_lokasi']);
				$update = kry_d3::where("kode_karyawan",$kode_karyawan)
					->where("flag_formal_non_formal",$req->old_flag_formal_non_formal)
					->where("jenis_sekolah",$req->old_jenis_sekolah)
					->where("nama_sekolah",$req->old_nama_sekolah)
					->where("lokasi",$req->old_lokasi)
					// ->where("fakultas",$req->fakultas)
					// ->where("tgl_awal_pendidikan",$req->tgl_awal_pendidikan)
					->update($data);
				if($update)
				{
					$status = ['code'=>200,'description'=>'OK - Success Update'];
					$data = $req->all();
					return Response::json(compact('header','data','status'),200);	
				}else{
					$status = ['code'=>305,'description'=>'Bad Request - Failed Update'];
					$data = $req->all();
					return Response::json(compact('header','data','status'),305);	
				}
			}
			else if($target == 'keluarga')
			{
				$data = $req->only(['no_ktp','jenis_kelamin','nama','tempat_lahir','pekerjaan','pendidikan','tanggal_lahir','nomor_telepon']);
				// return $data;
				$update = kry_d2::where("kode_karyawan",$kode_karyawan)
					->where("hubungan_keluarga",$req->old_hubungan_keluarga)
					// ->where("no_ktp",$req->no_ktp)
					// ->where("jenis_kelamin",$req->jenis_kelamin)
					// ->where("nama",$req->nama)
					->where("tempat_lahir",$req->old_tempat_lahir)
					->where("tanggal_lahir",$req->old_tanggal_lahir)
					->update($data);
				if($update)
				{
					$status = ['code'=>200,'description'=>'OK - Success Update'];
					$data = $req->all();
					return Response::json(compact('header','data','status'),200);	
				}else{
					$status = ['code'=>305,'description'=>'Bad Request - Failed Update - '];
					$data = $req->all();
					return Response::json(compact('header','data','status'),305);	
				}
			}
			else
			{
				// if($id == null || $id == ""){
				// 	$status = ['code'=>308,'description'=>'Bad Request - ID NULL'];
				// 	$data = $req->all();
				// 	return Response::json(compact('header','data','status'),308);	
				// }

				$update = $action::where("kode_karyawan",$kode_karyawan)->update($req->all());
				if($update)
				{
					$status = ['code'=>200,'description'=>'OK - Success Update'];
					$data = $req->all();
					return Response::json(compact('header','data','status'),500);	
				}else{
					$status = ['code'=>305,'description'=>'Bad Request - Failed Update'];
					$data = $req->all();
					return Response::json(compact('header','data','status'),305);	
				}
			}
		}
	}
	
	public function status(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			if($nik == 0) {
				$status = ['code'=>404,'description'=>'Bad Request - token not valid'];
				return Response::json(compact('header','data','status'),404);	
			}
			$header = [
				'nik'=>$nik
			];
		
			$karyawan = new karyawan();
			$data = $karyawan->getStatus($karyawan->getKode($nik));
			return Response::json(compact('header','data','status'),200);	
	}
	
	public function detail_status(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			$header = [
				'nik'=>$nik
			];

			$karyawan = new karyawan();
			$data = $karyawan->getDetailStatus($karyawan->getKode($nik));
			if($data == "") {
				$status = ['code'=>404,'description'=>'Bad Request - Request data not found'];
				return Response::json(compact('header','data','status'),500);	
			}
			return Response::json(compact('header','data','status'),200);
	}

	public function hr(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			$header = [
				'nik'=>$nik
			];

			$karyawan = new karyawan();
			$kode = $karyawan::where('nik',$nik)->first()->kode_karyawan;
			
			$data = $karyawan->getHR($kode);
			// $data = kry_d1::where('kode_karyawan',$kode)->first();
			
			if($data == "") {
				$status = ['code'=>404,'description'=>'Bad Request - Request data not found'];
				return Response::json(compact('header','data','status'),500);	
			}
			return Response::json(compact('header','data','status'),200);
	}

	public function keluarga(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;

			$header = [
				'nik'=>$nik
			];
			$karyawan = new karyawan();
			$kode = $karyawan::where('nik',$nik)->first()->kode_karyawan;
			
			// $data = $karyawan->getKeluarga($kode);
			$data = kry_d2::where('kode_karyawan',$kode)->get();
			
			if($data == "") {
				$status = ['code'=>404,'description'=>'Bad Request - Request data not found'];
				return Response::json(compact('header','data','status'),500);	
			}
			return Response::json(compact('header','data','status'),200);
		
		
	}

	public function pendidikan(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			$header = [
				'nik'=>$nik
			];
		
			$karyawan = new karyawan();
			$kode = $karyawan::where('nik',$nik)->first()->kode_karyawan;
			
			// $data = $karyawan->getPendidikan($kode);
			$data = kry_d3::where('kode_karyawan',$kode)->get();
				
			if($data == "") {
				$status = ['code'=>404,'description'=>'Bad Request - Request data not found'];
				return Response::json(compact('header','data','status'),500);	
			}
			return Response::json(compact('header','data','status'),200);
			
	}

	public function skill(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			$header = [
				'nik'=>$nik
			];
		
			$karyawan = new karyawan();
			$kode = $karyawan::where('nik',$nik)->first()->kode_karyawan;
			
			// $data = $karyawan->getSkill($kode);
			$data = kry_d4::where('kode_karyawan',$kode)->get();
			
			if($data == "") {
				$status = ['code'=>404,'description'=>'Bad Request - Request data not found'];
				return Response::json(compact('header','data','status'),500);	
			}
			return Response::json(compact('header','data','status'),200);
      
	}
	
	public function organisasi(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			$header = [
				'nik'=>$nik
			];

			$karyawan = new karyawan();
			
			$karyawan = new karyawan();
			$kode = $karyawan::where('nik',$nik)->first()->kode_karyawan;
			
			// $data = $karyawan->getOrganisasi($kode);
			$data = kry_d5::where('kode_karyawan',$kode)->get();
			
			if($data == "") {
				$status = ['code'=>404,'description'=>'Bad Request - Request data not found'];
				return Response::json(compact('header','data','status'),500);	
			}
			return Response::json(compact('header','data','status'),200);	
		
	}
	
	public function pengalaman_kerja(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			$header = [
				'nik'=>$nik
			];
			
			$karyawan = new karyawan();
			$kode = kry_h::where('nik',$nik)->first()->kode_karyawan;
			
			$data = $karyawan->getPengalamanKerja($kode);
			
			if($data == "") {
				$status = ['code'=>404,'description'=>'Bad Request - Request data not found'];
				return Response::json(compact('header','data','status'),500);	
			}
			return Response::json(compact('header','data','status'),200);
		
	}
	
	

	public function employee_journey(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			
			$header = [
				'nik'=>$nik
			];
		
			$karyawan = new karyawan();
			$data = $karyawan->getEmployeeJourney($nik);

			return Response::json(compact('header','data','status'),200);   
	}

	public function goverment(Request $req)
	{
			$data = "";
			$status = ['code'=>200,'description'=>'ok'];
			
			$nik = $req->nik;
			$header = [
				'nik'=>$nik
			];
		

			if($req->header('target') == "propinsi"){
				$data = Provinsi::orderBy('PROPINSI')->get();
			}
			
			if($req->header('target') == "kabupaten"){
				$data = KotaKab::where('PROP_ID',$req->prop_id)->orderBy('KABUPATEN')->get();
			}
			
			if($req->header('target') == "kecamatan"){
				$data = Kecamatan::where('KAB_ID2',$req->kab_id)->orderBy('KECAMATAN')->get();
			}

			if($req->header('target') == "kelurahan"){
				$data = kelurahan::where('KEC_ID2',$req->kec_id)->orderBy('KELURAHAN')->get();
			}
			
				
			if($data == "") {
				$status = ['code'=>404,'description'=>'Bad Request - Request data not found'];
				return Response::json(compact('header','data','status'),500);	
			}
			return Response::json(compact('header','data','status'),200);
			
	}

	// public function reset_password(Request $req)
	// {
	// 		$data = "";
	// 		$status = ['code'=>200,'description'=>'ok'];
			
	// 		$nik = $req->nik;
			
	// 		$header = [
	// 			'nik'=>$nik
	// 		];
		
	// 		$nik = $token->getNikByToken($req->header('Authorization'));
	// 		$user = new user();
	// 		$data = $user::update('password',$req->password)
	// 			->where('username',$nik)->andWhere('password','$')

	// 		return Response::json(compact('header','data','status'),200);
	// }
	
}
