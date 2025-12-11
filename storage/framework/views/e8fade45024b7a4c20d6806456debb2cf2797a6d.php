<?php 
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
?>
<?php $__env->startSection('title', 'ESS - User Monitoring'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>User Monitoring - <?php echo convert($target); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>
  <script>
    var no = 1;  
    var jml_logout = 0;
    var jml_login = 0;

    
	var host = "";
    
    $dtbl = $('#table').DataTable({
       "processing": true,
       "serverSide": true,
       
       ajax: {
         
         url: host+"/api/<?php echo e($target); ?>/null/login/data/user?pass=$2y$12$pEtbFeVYpdXlP9CmVjffhuEk9WDM0pCbTjmVnWgO9qgQo.U0OtsX2",
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
        url: host+"/api/<?php echo e($target); ?>/null/login/data/user/logout?username="+username,
        
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
    
  </script>
    <script src="<?php echo e(asset('vendor/adminlte/dist/js/adminlte.min.js')); ?>"></script>
    
  
    
    <?php echo $__env->yieldPushContent('js'); ?>
    <?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>