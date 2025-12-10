@extends('adminlte::page')

@php 
$target = $_REQUEST['target'] == null ? '' : $_REQUEST['target']; 
function convert($target){
  if($target == 'sinar_anugrah'){
    return "SINAR ANUGRAH";
  }else if($target == 'demo'){
    return "DEMO QEY";
  }else if($target == 'pma'){
    return "PINUS MERAH ABADI";
  }else if($target == 'jalusi'){
    return "JALUSI";
  }else if($target == 'DEMO'){
    return "DEMO";
  }else if($target == 'SELULAR'){
    return "SELULAR";
  }
  else{
    return "";
  }
}
@endphp
@section('title', 'ESS - User Monitoring')

@section('content_header')
    <h1>User Monitoring - {!! convert($target) !!}</h1>
@stop

@section('content')

{{--  <div class="row">
    <!-- Apply any bg-* class to to the info-box to color it -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">User Login</span>
          <span class="info-box-number" id='jml_user_login'>{{ $jml_user_login }}</span>
          <!-- The progress section is optional -->
          <div class="progress">
            <div class="progress-bar" id='prog_jml_user_login' style="width: {{ $persen_jml_user_login }}%"></div>
          </div>
          <span class="progress-description" id='prog_desc_jml_user_login'>
              {{ $persen_jml_user_login }}% User Login Today
          </span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>

    <!-- Apply any bg-* class to to the info-box to color it -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">User Logout</span>
          <span class="info-box-number" id='jml_user_logout'>{{ $jml_user_logout }}</span>
          <!-- The progress section is optional -->
          <div class="progress">
            <div class="progress-bar" id='prog_jml_user_logout' style="width: {{ $persen_jml_user_logout }}%"></div>
          </div>
          <span class="progress-description" id='prog_desc_jml_user_logout'>
              {{ $persen_jml_user_logout }}% User Logout Today
          </span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>
  </div>  --}}

  <table class="table table-bordered table-hover" id="table">
      <thead>
        <tr>
            <th>NO</th>
            <th>CODE USER</th>
            <th>NAME USER</th>
            <th>USERNAME</th>
            <th>JOB</th>
            <th>STATUS</th>
            <th>LAST LOGIN</th>
            <th></th>
        </tr>
      </thead>
  </table>
@stop

@section('adminlte_js')
  <script>
    var no = 1;  
    var jml_logout = 0;
    var jml_login = 0;
{{--  
    setInterval(function(){
        $dtbl.ajax.reload();
        console.log('reload datatable complete/.....');
        no = 1;
    }, 10000) /* time in milliseconds (ie 2 seconds)*/  --}}
    
	var host = "";
    
    $dtbl = $('#table').DataTable({
       "processing": true,
       "serverSide": true,
       
       ajax: {
         {{--  url: "{{ url('http://localhost:8000/api/login/data/user?pass=$2y$12$pEtbFeVYpdXlP9CmVjffhuEk9WDM0pCbTjmVnWgO9qgQo.U0OtsX2') }}",  --}}
         url: host+"/api/{{ $target }}/null/login/data/user?pass=$2y$12$pEtbFeVYpdXlP9CmVjffhuEk9WDM0pCbTjmVnWgO9qgQo.U0OtsX2",
         type: "GET",
         crossDomain: true,
         headers: {
          "accept": "application/json",
          "Access-Control-Allow-Origin":"*"
         },
       },
       order: [['1', "desc"]],
       columnDefs: [{ "orderable": false, "searchable": false, "targets": 0 }],
       columns: [
                {
                  "data": "kd_user",
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                  },
                  "orderable": "false"
               },
               { data: 'kd_user', name: 'kd_user' },
               { data: 'nm_user', name: 'nm_user' },
               { data: 'username', name: 'username' },
               {
                "render": function (data, type, JsonResultRow, meta) {


                  if(JsonResultRow.nm_jabatan == '' || JsonResultRow.nm_jabatan == null){  
                    return "--NOT HAVE JOB--";
                  }else{
                    return JsonResultRow.nm_jabatan;
                  }
                }
               },
               {
                 "render": function (data, type, JsonResultRow, meta) {
                  {{--  jml_login = data.recordsTotal;
                  jml_logout = data.recordsTotal;  --}}


                   if(JsonResultRow.is_login == '1'){  
                     return "<i class='fas fa-lock-open' style='color:green;'> Login</i>";
                   }else{return "<i class='fas fa-lock' style='color:red;'> Logout</i>";
                   }
                 }
               },
               { data: 'last_login', name: 'last_login' },
               {
                "render": function (data, type, JsonResultRow, meta) {
                  if(JsonResultRow.is_login == '1'){  
                    return "<button onClick=force_logout('"+JsonResultRow.username+"') class='btn btn-info'><i class='glyphicon glyphicon-log-in'> FORCE LOGOUT</i></button>";
                  }else{
                    return '';
                  }
                }
              },
             ]
       ,select: true,
    });


    function force_logout(username){
      console.log("logout....");
      $.ajax({
        type: 'POST',
        url: host+"/api/{{ $target }}/null/login/data/user/logout?username="+username,
        {{--  headers: {
            "My-First-Header":"first value",
        }  --}}
        //OR
        //beforeSend: function(xhr) { 
        //  xhr.setRequestHeader("My-First-Header", "first value"); 
        //  xhr.setRequestHeader("My-Second-Header", "second value"); 
        //}
      }).done(function(data,d,xhr) {   
        $dtbl.ajax.reload();
      });
    }

    
    var versionNo = $.fn.dataTable.version;
    {{--  alert(versionNo);  --}}
  </script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    
  
    
    @stack('js')
    @yield('js')
@stop