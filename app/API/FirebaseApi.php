<?php
namespace App\API;

use Illuminate\Support\Facades\DB;

class FirebaseApi
{

    public function insertDataTokenDevice($nik, $token)
    {
        $device = array(
            'nik' => $nik,
            'token' => $token,
        );

        $update = DB::table('token_device')->insert($device);
    }

    public function updateDataTokenDevice($nik, $token)
    {
        $device = array(
            'nik' => $nik,
            'token' => $token,
        );

        if($token != null || $token != "" || $token != "-"){
            $update = DB::table('token_device')->where('nik', $nik)
            ->update(['token' => $token]);
        }
        
    }

    public function postData($token, $send_to = "", $data = array())
    {
        $firebase_token = $token; //device id
        $firebase_api = 'AAAAisxSmsU:APA91bF1aIBgLj0VZY68YoCgIyMWrGlrnZbtR5uB4yh4CJg1jQfmNhxWJE7sDyv0K9KyOuBRg1QAFACLgrmp0FJCD4BagLaf8BKAwbDhofKck2bo7QuFTAPb_OgQ5KXqi1Vjblb7eCSGx7lDzX3AGAmaGLWFMreq5g';

        $topic = 'global';

        // $requestData = array(
        //     'title' => $title,
        //     'message' => $message,
        //     'image_url' => $image_url,
        //     'action' => $action,
        //     'action_destination' => $action_destination,
        // );

        if ($send_to == 'topic') {
            $fields = array(
                'to' => '/topics/' . $topic,
                'data' => $requestData,
            );

        } else {

            $fields = array(
                'to' => $firebase_token,
                'data' => $data,
            );
        }

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                'Authorization: key=' . $firebase_api,
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
            return false;
        } else {
            // print_r(json_decode($response));
            return true;
        }
    }

}
