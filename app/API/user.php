<?php

namespace App\API;

use App\API\Karyawan\kry_h;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;



use Illuminate\Database\Eloquent\Model;

class user extends Model
{

	protected $table = 'user';
	protected $primaryKey = 'kd_user';
	public $incrementing = false;
	public $timestamps = false;

	//status
	public $STATUS_SUCCESS = 1;
	public $STATUS_FAIL = 0;
	public $STATUS_NIK_WRONG = 2;
	public $STATUS_PASS_WRONG = 3;
	public $STATUS_CONFIRM_PASS_WRONG = 4;
	
	public function getDataUserLogin($nik)
	{
		$ds = config('database.default');
	
		$us = kry_h::where('nik',$nik)->first();
		// return "../foto_karyawan/".$ds."/thumb_".$us->kode_karyawan.".jpg";
		$imagepath = "thumb_".$us->kode_karyawan.".jpg";

		$directoryPath = public_path("foto_karyawan/".$ds."/".$imagepath);

		// return $directoryPath;

		if(file_exists($directoryPath)){
			$file = "CONCAT(CONCAT('foto_karyawan/$ds/thumb_',a.kode_karyawan),'.jpg')";
		}else{
			$file =  "'foto_karyawan/thumb_default.png'";
		}
		
		$user = DB::select(DB::raw("
		select a.nama_lengkap,
	
		$file as imgProfile,
		IFNULL(b.nik_atasan,'-') as nik_atasan, 
		IFNULL((SELECT aa.nama_lengkap 
		from kry_h as aa 
		LEFT JOIN kry_d1 as bb ON aa.kode_karyawan = bb.kode_karyawan 
		where aa.nik = b.nik_atasan),'-') 
		as nama_atasan,
		c.api_token
		from kry_h as a
		LEFT JOIN kry_d1 as b ON a.kode_karyawan = b.kode_karyawan
		LEFT JOIN user as c ON c.username = a.nik
		WHERE a.nik = '$nik' group by a.nik
		"));
		if($nik == null) {
			return "";
		}
		return $user;	
	}

	public function uptime_lastlogin($nik,$last_log = "")
	{
		//date_default_timezone_set("Asia/Bangkok");
		$last_login = $last_log == ""?date("Y-m-d H:i:s"):$last_log;
		$user = DB::table('user')
            ->where('username', $nik)
            ->update(['last_login'=>$last_login]);
		if($user) {
			return true;
		}else {
			return false;
		}
	}
	
	public function update_login($nik,$status,$last_log = "")
	{
		//date_default_timezone_set("Asia/Bangkok");
		$last_login = $last_log == ""?date("Y-m-d H:i:s"):$last_log;
		$user = DB::table('user')
            ->where('username', $nik)
            ->update(['is_login' =>DB::raw($status),'last_login'=>$last_login]);
		if($user) {
			return true;
		}else {
			return false;
		}
	}
	
	public function update_first_login($nik,$status,$last_log = "")
	{
		//date_default_timezone_set("Asia/Bangkok");
		$last_login = $last_log == ""?date("Y-m-d H:i:s"):$last_log;
		$user = DB::table('user')
            ->where('username', $nik)
            ->update(['first_login' =>DB::raw($status),'last_login'=>$last_login]);
		if($user) {
			return true;
		}else {
			return false;
		}
	}

	public function update_password_login($nik,$password_lama,$password_baru,$password_baru_konfirm)
	{
		//cek nik
		$user = user::where("username",$nik)->first();
		if(count($user) < 1){
			return $this->STATUS_NIK_WRONG;
		}
		//cek password
		$user = user::where("username",$nik)->first();
		
		if($user->password != md5($password_lama)){
			return $this->STATUS_PASS_WRONG;
		}

		if($password_baru != $password_baru_konfirm){
			return $this->STATUS_CONFIRM_PASS_WRONG;
		}

		$user = DB::table('user')
			->where('username', $nik)
			->where('password', md5($password_lama))
			->update(['password' => md5($password_baru)]);
		if($user) {
			return $password_baru;
		}else{
			return $this->STATUS_FAIL;
		}
	}

	public function reset_password_login($nik)
	{
		$password_baru = str_random(8);
		
		$user = DB::table('user')
			->where('username', $nik)
			->update(['password' => md5($password_baru)]);
		if($user) {
			return $password_baru;
		}else{
			return $this->STATUS_FAIL;
		}
	}

}

