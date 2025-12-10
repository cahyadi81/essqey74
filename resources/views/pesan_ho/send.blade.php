@extends('adminlte::page')

@section('title', 'PESAN HO')

@section('content_header')
  <div class="box-body">
    <form id="send_pesan_ho" action="">
    <div class="row">
      <div class="col-md-12">
      <div class="form-group">
        <label>Option</label>
          <select class="form-control select2" name="option" id="option" style="width: 100%;" tabindex="-1" aria-hidden="true">
            <option value='ALL'>ALL</option>
            <option value='NIK'>NIK</option>
          </select>
        </div>
        <div class="form-group">
          <label>Comp</label>
          <select class="form-control select2" name="comp" id="comp" style="width: 100%;" tabindex="-1" aria-hidden="true">
            <option value='addroo' selected="selected">ADDROO</option>
            <option value='pma'>PINUS MERAH ABADI</option>
            <option value='jalusi'>JALUSI</option>
            <option value='sinar_anugrah'>SINAR ANUGRAH</option>
            <option value='demo'>DEMO</option>
          </select>
        </div>
        <div class="form-group">
            <label>NIK</label>
            <input type="text" disabled id="nik" name="nik" class="form-control" placeholder="NIK">
          </div>
      </div>
      <!-- /.col -->
      <div class="col-md-12 form-group">
          <div class="form-group">
              <label>HEADER</label>
              <input type="text" id="header" name="header" class="form-control" placeholder="HEADER">
          </div>
          <textarea rows="10", cols="54" id="content" name="content" style="resize:none, "></textarea>
      </div>
      <div class="col-md-12 form-group">
          <input type="submit" id="send" name="send" class="form-control btn btn-default" value="SEND" >
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    </form>
  </div>
@stop

{{--  @section('content')
    <p>You are logged in!</p>
@stop  --}}

@section('adminlte_js')
  <script>
    $(document).ready(function(){
        $('.select2').select2();
        /* Attach a submit handler to the form */
        $(document).on("submit", "#send_pesan_ho", function(event) {
          {{-- alert('sending.....'); --}}
          var ajaxRequest;

          var isDisabled = $('#nik').prop('disabled');

          $('#send').attr('disabled','disabled');
          $("#send").attr('value','Sending...');
          
          /* Stop form from submitting normally */
          event.preventDefault();

          /* Clear result div*/
          $("#result").html('');

          /* Get from elements values */
          var values = $(this).serialize();
          var target = "";
          var option = $("#option :selected").val();
          var comp = $("#comp :selected").val();
          var nik = $("#nik").val();
          if(isDisabled){
            target = option;
          }else{
            target = nik;
          }

          /* Send the data using post and put the results in a div */
          /* I am not aborting previous request because It's an asynchronous request, meaning 
            Once it's sent it's out there. but in case you want to abort it  you can do it by  
            abort(). jQuery Ajax methods return an XMLHttpRequest object, so you can just use abort(). */
            ajaxRequest= $.ajax({
                url: 'http://apiess.fintac.co.id:82/api/'+comp+'/pesan_ho/send?target='+target,
                type: "post",
                data: values
            });

          /*  request cab be abort by ajaxRequest.abort() */

          ajaxRequest.done(function (response, textStatus, jqXHR){
              // show successfully for submit message
              $('#send').removeAttr('disabled');
              $("#send").attr('value','Send');
              alert('Send Pesan successfully');
              location.reload();
              

          });

            /* On failure of request this function will be called  */
          ajaxRequest.fail(function (){

            // show error
            $('#send').removeAttr('disabled');
            $("#send").attr('value','Send');
            alert('There is error while submit');
            
          });
          return false;
        });
     });



     $(function() { $('#content').froalaEditor({
        codeBeautifierOptions: {
          end_with_newline: true,
          indent_inner_html: true,
          extra_liners: "['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre', 'ul', 'ol', 'table', 'dl']",
          brace_style: 'expand',
          indent_char: ' ',
          indent_size: 4,
          wrap_line_length: 0
        },
        height:180,
      }) 
    })
    
    $("#option").change(function(){
      val = $("#option :selected").val();
      if(val == "ALL"){
        $("#nik").prop( "disabled", true );
      }else if(val == "NIK"){
        $("#nik").prop( "disabled", false );
      }
      
    })

  </script>
  <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

    @stack('js')
    @yield('js')
@stop