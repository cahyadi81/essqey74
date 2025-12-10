@extends('adminlte::page')

@section('title', 'ESS - Server List')

@section('content_header')
    <h1>User Monitoring - {!! convert($target) !!}</h1>
@stop

@section('content')

  <table class="table table-bordered table-hover" id="table">
      <thead>
        <tr>
            <th>NO</th>
            <th>CODE</th>
            <th>NAME</th>
            <th>LOCATION</th>
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
    
    
    $dtbl = $('#table').DataTable({
       "processing": true,
       "serverSide": true,
       
       ajax: {
         url: "localhost:8000/api/login/server/connect",
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
                  "data": "id",
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                  },
                  "orderable": "false"
                },
                { data: 'code', name: 'code' },
                { data: 'name', name: 'name' },
                { data: 'location', name: 'location' },,
             ]
       ,select: true,
    });


    function force_logout(username){
      console.log("logout....");
      $.ajax({
        type: 'POST',
        {{-- url: "http://phpstack-160315-572402.cloudwaysapps.com/api/{{ $target }}/login/data/user/logout?username="+username, --}}
        url: "localhost:8000/api/login/server/connect
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