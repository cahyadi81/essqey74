<?php

namespace App\Http\Controllers\API;


use View;
use Response;

use App\API\server;
use App\API\user;
use App\API\karyawan;
use App\API\FirebaseApi;

use App\API\DataDemo\DataPersonalDemo;

use App\library\api_token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\TokenController;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function login(Request $req)
    {
	    //return DB::table('kry_h')->get();
        //return config('database.default');
        
	    $header = [
            'nik' => isset($req->nik) || $req->nik != "" ? $req->nik : null,
        ];
        $token_device = $req->token_device;

        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        if ($req->nik == "") {
            $status = ['code' => 400, 'description' => 'Bad Request - parameter nik required'];
            return Response::json(compact('header', 'data', 'status'), 201);
        }

        $user = DB::table('user')->where("username", $req->nik)->first();

        if ($user == null) {
            $status = ['code' => 200, 'description' => 'ok'];
            return Response::json(compact('header', 'data', 'status'), 201);
        }
		
		if(!isset($req->customer)){
			
		}else if($req->customer != "null"){

            $cust = DB::table('kry_d1')
                ->leftJoin("kry_h","kry_d1.kode_karyawan","kry_h.kode_karyawan")
                ->where("kd_customer", $req->customer)
                ->where("nik", $req->nik)->first();
				
            if(!$cust){
                $status = ['code' => 404, 'description' => 'Wrong-- User Login'];
                return Response::json(compact('header', 'data', 'status'), 201);
            }

        }
		
        
        if ($req->nik == $user->username) {

            //if($req->api_key == "nevermore123") {
            if ($req->password != " " || $req->password != null) {
                //return ($req->password) . '==' .$user->password ;
                if (md5($req->password) == $user->password) {
                    $token = new TokenController();
                    //echo "awww";
		            $user_login = new user();
                    //dd($user_login);
                    $data_token = ($user_login->api_token == null) ? "" : $user_login->api_token;
                    $data = $user_login->getDataUserLogin($req->nik);
                    $is_login = $user->is_login;

            
                    if(config('database.default') == "demo"){
                        $data = $user_login->getDataUserLogin($req->nik);
                        $status = ['is_login' => 0, 'code' => 200, 'description' => 'ok'];

		
                        $device = DB::table('token_device')->where("nik", $req->nik)->first();
                                    
                        $firebaseApi = new FirebaseApi();
                        if ($device == null) {
                            $firebaseApi->insertDataTokenDevice($req->nik, $token_device);
                        } else {
                            $firebaseApi->updateDataTokenDevice($req->nik, $token_device);
                        }
                        return Response::json(compact('header', 'data', 'status'), 201);
                    }


                    if ($user->is_login == '0') {
                        $user_now = DB::table('user')->where("username", $req->nik)->first();
                        $is_login = $user_now->is_login;
                        if ($user_now->first_login == '1') {
                            $user_login->update_login($req->nik, '1');
                            $user_login->update_first_login($req->nik, '0');
                            $token->updateToken($req->nik);
                        } else if ($user_now->first_login == '0') {
                            $user_login->update_login($req->nik, '1');
                        }
                        $data = $user_login->getDataUserLogin($req->nik);
                        $status = ['is_login' => $is_login, 'code' => 200, 'description' => 'ok'];

		
                        $device = DB::table('token_device')->where("nik", $req->nik)->first();
                                    
                        $firebaseApi = new FirebaseApi();
                        if ($device == null) {
                            $firebaseApi->insertDataTokenDevice($req->nik, $token_device);
                        } else {
                            $firebaseApi->updateDataTokenDevice($req->nik, $token_device);
                        }

			

                        return Response::json(compact('header', 'data', 'status'), 201);
                    } else if ($user->is_login == '1') {
                        $status = ['is_login' => $is_login, 'code' => 404, 'description' => 'Bad Request - User telah login '];
                        return Response::json(compact('header', 'data', 'status'), 201);
                    }
                } else {
                    $status = $status = ['code' => 404, 'description' => 'Wrong Password Login...'];
                    return Response::json(compact('header', 'data', 'status'), 201);
                }
            } else {
                $status = ['code' => 400, 'description' => 'Bad Request - parameter nik & password required'];
                return Response::json(compact('header', 'data', 'status'), 201);
            }
            //}else {
            //return Response::json($status2,201);
            //}
        } else {
            $status = ['code' => 404, 'description' => 'Wrong User Login'];
            return Response::json(compact('header', 'data', 'status'), 201);
        }

    }

    public function logout(Request $req)
    {

        $data = "";
        $status = ['code' => 200, 'description' => 'ok'];
        $token = new TokenController();
        
        $nik = $req->nik;

        $header = [
            'nik' => $nik,
        ];

        if(config('database.default') == "demo"){
            $status = ['is_login' => 0, 'code' => 200, 'description' => 'ok'];
            return Response::json(compact('header', 'data', 'status'), 200);
        }

        if ($token->cekTokenForLogout($req->header('Authorization'))) {
            $user_login = new user();
            $user = DB::table('user')->where("username", $nik)->where("is_login", '1')->first();
            $is_login = '0';
            if ($user) {
                $is_login = '0';
                $user_login->update_login($nik, $is_login);
                $user_login->update_first_login($nik, '1');
                $user_now = DB::table('user')->where("username", $nik)->where("is_login", '0')->first();
                if ($user_now) {
                    $del = DB::table('api_token')->where('nik', '=', $req->nik)->delete();
                    $status = ['is_login' => $is_login, 'code' => 200, 'description' => 'ok - Logout'];
                    return Response::json(compact('header', 'data', 'status'), 200);
                } else {
                    $status = ['is_login' => $is_login, 'code' => 200, 'description' => 'failed - Logout'];
                    return Response::json(compact('header', 'data', 'status'), 200);
                }
            } else {
                $is_login = 1;
                $status = ['is_login' => $is_login, 'code' => 404, 'description' => 'Failed - Logout'];
                return Response::json(compact('header', 'data', 'status'), 500);
            }
        } else {

            $status = ['code' => 400, 'description' => 'Bad Request - token not valid'];
            return Response::json(compact('header', 'data', 'status'), 200);

        }
    }

    public function reset(Request $req)
    {
        $data = "";
		$status = ['code'=>200,'description'=>'ok'];
	
		$nik = $req->nik;

		$header = [
			'nik'=>$nik
		];

        $user = new user();
        if(count($user::where("username",$nik)->first()) < 1){
            $status = ['code'=>305,'description'=>'Bad Request - Nik Tidak ditemukan'];
            return Response::json(compact('header','data','status'),305);	
        }

        $oldpass = $user::where("username",$nik)->first()->password;

        if($req->token_reset == "" || $req->token_reset == null || !isset($req->token_reset))
        {
            //send email
            $email = karyawan::where("nik",$nik)->first()->email;
            $target = config('database.default');
            $token_reset = base64_encode(base64_encode("reset".$email.$target.$nik));
            // $link = base64_encode("api/$target/auth/reset?nik=$nik&token_reset=$token_reset");
            $link_reset = "http:://apiess.fintac.co.id:82/api/$target/null/auth/reset?nik=$nik&token_reset=$token_reset";
            
            if($this->send_email_reset_pass($email,$link_reset)){
                $user::where("username",$nik)->update(['defaultpass'=>$token_reset]);
                $status = ['code'=>201,'description'=>'OK - RESET LINK SEND TO EMAIL'];
                return Response::json(compact('header','data','status'),201);	
            }else{
                $status = ['code'=>301,'description'=>'FAILED - RESET LINK SEND TO EMAIL!'];
                return Response::json(compact('header','data','status'),301);	
            }
           
        }else{

            // $link = base64_decode("api/$target/auth/reset?nik=$nik&token_reset=$token_reset");
            // $link_reset = "http://phpstack-160315-572402.cloudwaysapps.com/api/$target/auth/reset?nik=$nik&token_reset=$token_reset";
            $token_reset_true = base64_decode(base64_decode($user::where("username",$nik)->first()->defaultpass));
            // return $token_reset_true;
            $nik = $req->nik;
            $target = config('database.default');
            $email = karyawan::where("nik",$nik)->first()->email;
            // $token_reset_true = "reset".$email.$target.$nik;//
            $token_reset_val = base64_decode(base64_decode($req->token_reset));
            //return $token_reset_true;
            $data = "";
            if($token_reset_true == $token_reset_val){
                // return $token_reset_true. " = " . $token_reset_val;;
                $data = $user->reset_password_login($nik);
                $user::where("username",$nik)->update(['defaultpass'=>base64_decode(base64_decode($token_reset_true.'_0_0'))]);
            }else{
                $message = "
                <div style='margin:auto;width:50%;border:1px dotted;padding:5px 10px;'>
                <d></p>
                <h3>TOKEN RESET TIDAK VALID</h3>
                <p>akan di kembalikan ke menu utama dalam <span id='txt' style='color:red'>30</span> detik
                <script> 
                startCount(); 

                var c = 31;
                var t;

                function timedCount() {
                    c = c - 1;
                    if(c < 1){
                        window.location='/home'
                    }
                    document.getElementById('txt').innerHTML = c;
                    
                    console.log(c);
                    t = setTimeout(timedCount, 1000);
                }

                function startCount() {
                    c = 30;
                    timedCount();
                }

                function stopCount() {
                    clearTimeout(t);
                }
                </script>
                ";

                // $view = View::make('message');
                return $message;
            }
            // return $token_reset_val;
            if($data == "") {
                $status = ['code'=>500,'description'=>'Bad Request - Request data not found'];
                return Response::json(compact('header','data','status'),500);	
            }
        // return $data ." ". $user->STATUS_FAIL;
            // if($data == $user->STATUS_FAIL) {
            //     $status = ['code'=>301,'description'=>'Bad Request - RESET PASSWORD FAILED'];
            //     return Response::json(compact('header','data','status'),301);	
            // }
            
            //send email
            $email = karyawan::where("nik",$nik)->first()->email;
            
            if($this->send_email_new_pass($email,$data)){
                $status = ['code'=>200,'description'=>'OK - EMAIL RESET PASS SEND TO EMAIL'];
            }else{
                $status = ['code'=>200,'description'=>'FAILED - EMAIL RESET PASS SEND TO EMAIL'];
            }

            // $data = [
            //     'password baru' => $data,
            // ];

            $message = "
            <div style='margin:auto;width:50%;border:1px dotted;padding:5px 10px;'>
            <d></p>
            <p>Hai,</p>
            <p>Kata Sandi baru anda telah di buat, anda bisa merubah kata sandi di dalam aplikasi ESS,
            simpan jaga keamanan kata sandi anda, jangan berikan ke orang lain karena ini privasi anda.</p>
            <p>ini adalah kata sandi baru anda:</p>
            <p><span style='text-decoration: underline;'
            ><strong>$data</strong></span></p>
            <p>Terima Kasih,</p>
            <p>Regradz,</p>
            <p>&nbsp;</p>
            <p>ESS Developer Team</p>

            <hr>
            <p>akan di kembalikan ke menu utama dalam <span id='txt' style='color:red'>30</span> detik]
            </div>
            
                <script> 
                startCount(); 

                var c = 31;
                var t;

                function timedCount() {
                    c = c - 1;
                    if(c < 1){
                        window.location='/home'
                    }
                    document.getElementById('txt').innerHTML = c;
                    
                    console.log(c);
                    t = setTimeout(timedCount, 1000);
                }

                function startCount() {
                    c = 30;
                    timedCount();
                }

                function stopCount() {
                    clearTimeout(t);
                }
                </script>
            ";

            // $view = View::make('message');
            return $message;
        }

		return Response::json(compact('header','data','status'),200);	
    }

    public function update(Request $req)
    {
        $data = "";
		$status = ['code'=>200,'description'=>'ok'];
	
        $nik = $req->nik;
        $oldpass = $req->password_lama;
        $newpass = $req->password_baru;
        $newpass_confirm = $req->password_baru_konfirmasi;

		$header = [
			'nik'=>$nik
		];

        $user = new user();
        
        // $kry = new kry_h;
        // $email = $kry->email;
        // if($email == '-' || $email == '' || $email == '-')
        $data = $user->update_password_login($nik,$oldpass,$newpass,$newpass_confirm);
        
        // if(md5($oldpass) == $user::where('nik',$nik)->first()->password) {
		// 	$status = ['code'=>500,'description'=>'Bad Request - Not changed.'];
		// 	return Response::json(compact('header','data','status'),500);	
        // }
        

        if($data == "") {
			$status = ['code'=>305,'description'=>'Bad Request - Request data not found'];
			return Response::json(compact('header','data','status'),305);	
        }
        
        if($data == $user->STATUS_PASS_WRONG) {
			$status = ['code'=>301,'description'=>'Bad Request - PASSWORD Lama Salah'];
			return Response::json(compact('header','data','status'),301);	
        }

        if($data == $user->STATUS_CONFIRM_PASS_WRONG){
            $status = ['code'=>302,'description'=>'Bad Request - password baru dan konfirmasi tidak sama'];
			return Response::json(compact('header','data','status'),302);	
        }
        
        if($data == $user->STATUS_FAIL) {
			$status = ['code'=>303,'description'=>'Bad Request - UPDATE PASSWORD FAILED OR NOT CHANGED ANYTHING'];
			return Response::json(compact('header','data','status'),303);	
        }

        $data = [
            'password lama' => $oldpass,
            'password baru' => $newpass,
            // 'password baru konfirmasi' => $newpass_confirm,
        ];

        //send email
        $email = karyawan::where("nik",$nik)->first()->email;
        
        if($this->send_email_update_pass($email,$newpass)){
            $status = ['code'=>201,'description'=>'OK - EMAIL UPDATE PASS SEND TO EMAIL'];
            return Response::json(compact('header','data','status'),201);	
        }else{
            $status = ['code'=>301,'description'=>'FAILED - EMAIL UPDATE PASS SEND TO EMAIL'];
            return Response::json(compact('header','data','status'),301);	
        }

		return Response::json(compact('header','data','status'),200);	
    }

    public function send_email_update_pass($email,$passwordbaru)
    {
        //$to = "bonjolman@gmail.com";//$email;
        $to = $email;
        $subject = "Notifikasi Ganti Kata Sandi ESS";

        $message = "
        <p></p>
        <p>Dear Bpk/Ibu,</p>
        <p>Anda berhasil merubah kata sandi anda, 
        simpan dan jaga keamanan kata sandi anda, jangan berikan ke orang lain karena ini privasi anda.</p>
        <p>ini adalah kata sandi baru anda:</p>
        <p><span style='text-decoration: underline; font-size:25px'
        ><strong>$passwordbaru</strong></span></p>
        <p>Terima Kasih,</p>
        <p>Regradz,</p>
        <p>&nbsp;</p>
        <p>ESS Developer Team</p>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <helpdesk1@addroogroup.com>' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            return true;
        }
        return false;
        
    }

    public function send_email_new_pass($email,$passwordbaru)
    {
        //$to = "bonjolman@gmail.com";//$email;
        $to = $email;
        $subject = "Notifikasi Kata Sandi Baru ESS";

        $message = "
        <p></p>
        <p>Dear Bpk/Ibu,</p>
        <p>Kata Sandi baru anda telah di buat, anda bisa merubah kata sandi di dalam aplikasi ESS,
        simpan dan jaga keamanan kata sandi anda, jangan berikan ke orang lain karena ini privasi anda.</p>
        <p>ini adalah kata sandi baru anda:</p>
        <p><span style='text-decoration: underline;'
        ><strong>$passwordbaru</strong></span></p>
        <p>Terima Kasih,</p>
        <p>Regradz,</p>
        <p>&nbsp;</p>
        <p>ESS Developer Team</p>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <helpdesk1@addroogroup.com>' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            return true;
        }
        return false;
        
    }

    public function send_email_reset_pass($email,$link_reset)
    {
       //$to = "bonjolman@gmail.com";//$email;
       $to = $email;
        $subject = "Notifikasi Reset Kata Sandi ESS";

        $message = "
        <!-- Latest compiled and minified CSS -->
        <link rel='stylesheet' 
        href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' 
        integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' 
        crossorigin='anonymous'>

        <!-- Optional theme -->
        <link rel='stylesheet' 
        href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' 
        integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' 
        crossorigin='anonymous'>

        <p>Dear Bpk/Ibu,</p>
        <p>Untuk mereset kata sandi anda klik link dibawah ini :</p>
        <p><a class='btn btn-info' href='$link_reset'>KLIK DISINI UNTUK RESET&nbsp;</a></p>
        <p>atau copy link di bawah ini :</p>
        $link_reset
        <p>&nbsp;</p>
        <p>Terima Kasih,</p>
        <p>Regradz,</p>
        <p>&nbsp;</p>
        <p>ESS Developer Team</p>

        <!-- Latest compiled and minified JavaScript -->
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' 
        integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' 
        crossorigin='anonymous'></script>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <dev_ess@addroogroup.com>' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            return true;
        }
        return false;
        
    }
    
    public function data_login(Request $req)
    {
        $data = array();
		$status = ['code'=>200,'description'=>'ok'];

        $lock = "<img src=localhost:8000/icon/icon_lock.png />";
        $unlock = "<img src=localhost:8000/icon/icon_unlock.png />";
        $draw = 1;
        $recordsTotal = 0;
        $recordsFiltered = 0;

        

        if (Hash::check('imam_ganteng_banget', $req->pass))
        {
            $data = user::select(['is_login','kd_user','nm_user','username','last_login','nm_jabatan','token_device.token as token_device'])
            ->leftjoin('kry_h','kry_h.nik', '=', 'user.username')
            ->leftjoin('kry_d1','kry_h.kode_karyawan', '=', 'kry_d1.kode_karyawan')
            ->leftjoin('jabatan','kry_d1.jabatan', '=', 'jabatan.kd_jabatan')
            ->leftjoin('token_device','user.username','=','token_device.nik')
            ->whereNotIn('kry_d1.status_karyawan', ['NON AKTIF'])
            ->orderBy('is_login','desc')->orderBy('last_login','desc')->get();
            $draw = count($data);
            
            return datatables($data)->toJson();
        }else{
            return "error";
        }
		
    }

    

    public function logout_force_user(Request $request)
    {
        $logout = User::where('username',$request->username)->update(['is_login'=>0,'first_login'=>1]);
		return "1";
    }

    public function listServer(Request $request){

        $header = array();
        $status = ['code' => 200, 'description' => ''];

        $data = array();

        if($request->imamgantengbanget != '002305'){
            $status = ['code' => 402, 'description' => 'not access'];
            return Response::json(compact('header','data','status'), 402);
        }
        
        $data = server::all();
        if($data){
            $status = ['code' => 200, 'description' => 'OK - success loading'];
            return Response::json(compact('header','data','status'), 200);
        }

        return Response::json(compact('header','data','status'), 401);


    }

    public function connectToServer(Request $request){

		DB::disconnect(config('database.default'));
        //Config::set('database.default', '');
            //config(['database.connections.demo' => $jalusi ]);
        config(['database.default' => 'mysql' ]);
		
        $header = array();
        $status = ['code' => 200, 'description' => ''];

        $data = array();

        if($request->code_name == '' && $request->code_name == null && $request->code_name == '-'){
            $status = ['code' => 315, 'description' => 'Server Code not found'];
            return Response::json(compact('header','data','status'), 315);
        }
        
        $data = server::where('code',$request->code_name)->first();
        if($data){
            $status = ['code' => 200, 'description' => 'Success get data server'];
            return Response::json(compact('header','data','status'), 200);
        }else{
            $data = array();
            $status = ['code' => 315, 'description' => 'Server Code not found'];
            return Response::json(compact('header','data','status'), 315);
        }

        return Response::json(compact('header','data','status'), 401);


    }

    public function request_demo(Request $request)
    {
        $header = array();
        $data = array();
        $status = array();

        $no_telp = $request->no_telp;
        $email = $request->email;
        $nama_lengkap = $request->nama_lengkap;

        $cek_email = DataPersonalDemo::where('email',$email)->first();
        $cek_no = DataPersonalDemo::where('no_telp',$no_telp)->first();

        $email_ver = array("yahoo.com","gmail.com","yahoo.co.id","outlook.com","apple.com");
        // return explode('@',$email)[1];
        // return count(explode('@',$email));
        if(count(explode('@',$email)) > 1) {
            $em_v = explode('@',$email)[1];
            if(!in_array($em_v,$email_ver)){
                $status = ['desc'=> 'Email not valid, just yahoo.com, gmail.com, yahoo.co.id, outlook.com and apple.com'];
                return Response::json(compact('header','data','status'), 312);
            }
        }else{
            $status = ['desc'=> 'Email not valid'];
            return Response::json(compact('header','data','status'), 312);
        }

        if($cek_email){
            $status = ['desc'=> 'Email is Exist'];
            return Response::json(compact('header','data','status'), 310);
        }else{
            $header = ['no_telp'=>$no_telp, 'email'=>$email, 'nama_lengkap'=>$nama_lengkap];
            $store = DataPersonalDemo::insert($header);
             //cek store
            if($store){
                $send_email = $this->send_email_verif_demo($email,$nama_lengkap);
                //cek send email
                if($send_email){
                    
                    $status = ['desc'=> 'success'];
                    return Response::json(compact('header','data','status'), 200);
                }
                $status = ['desc'=> 'email failed send'];
                return Response::json(compact('header','data','status'), 411);
            }else{
                $status = ['desc'=> 'failed'];
                return Response::json(compact('header','data','status'), 400);
            }
        }


    }

    public function send_email_verif_demo($email, $name)
    {
        //$to = "bonjolman@gmail.com";//$email;
        $to = $email;
        $subject = "Hi $name, Selamat Datang di Aplikasi ESS";

        $message = "
        <!-- Latest compiled and minified CSS -->
        <link rel='stylesheet' 
        href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' 
        integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' 
        crossorigin='anonymous'>

        <!-- Optional theme -->
        <link rel='stylesheet' 
        href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' 
        integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' 
        crossorigin='anonymous'>

        <p>Dear Bpk/Ibu,</p>
        <p>Terima kasih telah mengajukan penggunaan Demo MODE di aplikasi ESS (Employee Self Services) </p>
        <p>Dibawah ini adalah akun penggunaan aplikasi demo:</p>
        <hr>
        <p>User 1:</p>
        <p>    NIK      : 20180002 </p>
        <p>    Password : 20180002 </p>
        <p>User 2:</p>
        <p>    NIK      : 20180001 </p>
        <p>    Password : 20180001 </p>
        <hr>
        <p>&nbsp;</p>
        <p>Terima Kasih,</p>
        <p>Regradz,</p>
        <p>&nbsp;</p>
        <p>ESS Developer Team</p>

        <!-- Latest compiled and minified JavaScript -->
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' 
        integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' 
        crossorigin='anonymous'></script>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <dev_ess@addroogroup.com>' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            return true;
        }
        return false;
        
    }

}

