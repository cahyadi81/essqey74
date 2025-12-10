<?php
	require_once("../library/inc.connection.php")


  //echo json_encode(store($koneksidb));

  $send  = store($koneksidb);
  echo $send;
  
  //post firebase
  function postData($token, $send_to = "", $data = array())
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
          //print_r(json_decode($response));
          return true;
      }
  }

  //post
  function store($conn)
  {
      $data = "";
      $status = ['code'=>200,'description'=>'ok'];
      $request = $_GET;
      $jPesan = 1;

      //jml count pesan header
      if(!mysql_query($conn,"select id from pesan_ho")){
          $jPesan = 1;
      }else{
          mysql_query($conn,"select id from pesan_ho")['id'] + 1;
      }
      
      if($jPesan < 1)
      {
          $jPesan = 1;
      }

      $image_url = $request->image_url == null ? "" : $request->image_url; 

      $no = 0;
      // return $karyawan->get()[1]->nik;
      if($request['target'] == "ALL"){
          $dataPesan = [
              'id'=> $jPesan,
              'header'=>$request->header,
              'content'=>$request->content,
          ];
          $insert = mysql_query($conn,"insert into pesan_ho values('$jPesan','".$request['header']."','".$request['content']."')");

          $DataPesanKry = [];
          $requestData = array();
          // $karyawan = $karyawan::whereIn('nik',['1700102453','1800101265','1600100964'])->get();
          $karyawan = mysql_query($conn,"
          select * from kry_h as a 
          left join kry_d1 as a.kode_karyawan = b.kode_karyawan
          where in kry_d1.status_karyawan ('TETAP','KONTRAK 1','KONTRAK 2')
          ");
          $nik_kry = "";

         
          
          while($kry_data = mysql_fetch_array($karyawan)){
              
              $DataPesanKry[$i] =  $PesanKry;
              $insert_psn = mysql_query($conn,"insert into pesan_ho_kry values('','$jPesan','".$kry_data['nik']."','0')");
              
              if($insert_psn){
              //     send notif
                  $device = mysql_query($conn,"select token from token_device where nik = '".$kry_data['nik']."'");
                  $token = ""; 
                  $dev_data = mysql_fetch_array($device);
                  if($dev_data){
                      $token = $dev_data['token'];		
                      $requestData = array(
                          'title' => "Pesan dari HO - ".$request['header'],
                          'message' => $request['content'],
                          'image_url' => '',
                          'action' => "activity",
                          'action_destination' => "PesanHOList",
                      );
                      $send_to = "";
                      postData($token, $send_to, $requestData);	
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
              'header'=>$request['header'],
              'content'=>$request['content'],
          ];

          $insert = mysql_query($conn,"insert into pesan_ho values('$jPesan','".$request['header']."','".$request['content']."')");   

          $dataPesanKry = array();
          $PesanKry = [
                  'id' => '',
                  'id_pesan_ho'=> $jPesan,
                  'nik'=>$request->target,
                  'read'=>0,
          ];

          $insert_psn = mysql_query($conn,"insert into pesan_ho_kry values('','$jPesan','".$request['target']."','0')");
          if($insPesanKry){
              //send notif pesan
              $device = DB::table('token_device')->where("nik", $request['target'])->first();
              // dd($device);
              $token = ""; 
              if($device){
                  $device = mysql_query($conn,"select token from token_device where nik = '".$kry_data['nik']."'");
                  $token = ""; 
                  $dev_data = mysql_fetch_array($device);

                  $requestData = array(
                        'title' => "Pesan dari HO - ".$request['header'],
                        'message' => $request['content'],
                        'image_url' => '',
                        'action' => "activity",
                        'action_destination' => "PesanHOList",
                  );
                  $send_to = "";
                  $this->postData($token, $send_to, $requestData);    
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

  
?>
