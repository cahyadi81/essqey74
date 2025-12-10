<?php

namespace App\Console\Commands;

use DB;

use App\API\cuti;
use App\API\karyawan;
use App\API\FirebaseApi;

use App\API\Dinas\header;
use App\API\Dinas\approval;

use App\API\Karyawan\kry_d1;
use Illuminate\Console\Command;

class NotifStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NotifStart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->sendNotif('demo');
        $this->sendNotif('pma_testing');
        // $this->sendNotif('pma');
        // $this->sendNotif('jalusi');
    }

    public function sendNotif($target)
    {
        DB::disconnect(config('database.default'));
        //Config::set('database.default', '');
            //config(['database.connections.demo' => $jalusi ]);
        config(['database.default' => $target ]);

        $this->sendDinas($target);
        $this->sendCutiIzin($target);
    }

    private function sendDinas($target)
    {
        $db = config('database.default');
        //notif dinas
        $dinas = header::whereIn('status',[0,10])
        //->where('nik','20180005')
        ->get();
        $action = "";
        foreach($dinas as $h){
            $nik = $h->nik;
            $appr = approval::where('id_dinas',$h->id)->first();
            // $atasan = kry_d1::where('kode_karyawan',$h->kode_karyawan)->first();
            $nik_atasan = ""; 
            // if($atasan){
            //     $nik_atasan = $atasan->nik_atasan;			
            // }else{
            //     continue;
            // }

            // $this->info($appr);
            // return $dinas;
            if($appr){
                if($h->status == 0){
                    $nik_atasan = $appr->atasan2;
                }else if($h->status == 10){
                    $nik_atasan = $appr->atasan;
                }
            }else{
                $nik_atasan = "-";
            }

            $device = DB::table('token_device')->where("nik", $nik_atasan)->first();
            $token = ""; 
            if($device){
                $token = $device->token;
                $firebaseApi = new FirebaseApi();
                $requestData = array(
                    'title' => "Notifikasi Pengajuan Perjalanan Dinas",
                    'message' => "Pengajuan DINAS dari nik : $nik ",
                    'image_url' => "",
                    'action' => "activity",
                    'action_destination' => "DinasApprList",
                );
                $send_to = "";
                if($firebaseApi->postData($token, $send_to, $requestData)){
                    $this->info($db.' <> DINAS - nik atasan telah terima notif DINAS - ('.$nik_atasan.')  --- ('. date("Y-m-d H:i:s") .') ');
                }else{
                    $this->info($db.' <> DINAS - nik atasan tidak terima notif DINAS - ('.$nik_atasan.') --- ('. date("Y-m-d H:i:s") .') ');
                }			
            }
            // $this->info('DINAS - success reminder dinas ('. date("Y-m-d H:i:s") .') ');
            sleep(1);
        }
    }

    private function sendCutiIzin($target)
    {
        $db = config('database.default');
        //notif izin cuti
        $cuti = cuti::whereIn('status',[0,10])
        //->where('atasan','20180005')
        ->get();
        $action = "";
        foreach($cuti as $h){
            $atasan = $h->atasan;
            $nik = $h->nik;
            $tgl_from22 = date("Y/m/d", strtotime($h->tgl_from));
            $tgl_to22 = date("Y/m/d", strtotime($h->tgl_to));


            if($atasan == "" || $atasan == null){
                continue;
            }

            if($h->status == 0){
                $atasan = $h->atasan2;
            }else if($h->status == 10){
                $atasan = $h->atasan;
            }

            $device = DB::table('token_device')->where("nik", $atasan)->first();
            $token = ""; 
            if($device){
                $token = $device->token;
                $tipe_pengajuan = ($h->tipe_pengajuan == 0) ? "CUTI" : "IZIN";

                $firebaseApi = new FirebaseApi();
                $requestData = array(
                    'title' => "Notifikasi Pengajuan $tipe_pengajuan",
                    'message' => "Pengajuan $tipe_pengajuan dari nik : $nik ",
                    'image_url' => "",
                    'action' => "activity",
                    'action_destination' => "CutiIzinApprList",
                );

                $send_to = "";
                if($firebaseApi->postData($token, $send_to, $requestData)){
                    $this->info($db.' <> CUTI/IZIN - nik atasan telah terima notif CUTI IZIN - ('.$atasan.') --- ('. date("Y-m-d H:i:s") .') ');
                }else{
                    $this->info($db.' <> CUTI/IZIN - nik atasan tidak terima notif CUTI IZIN - ('.$atasan.') --- ('. date("Y-m-d H:i:s") .') ');
                }			
            }

            
            // $this->info('CUTI/IZIN - success reminder cuti izin ('. date("Y-m-d H:i:s") .') ');
            sleep(1);
        }
    }
}
