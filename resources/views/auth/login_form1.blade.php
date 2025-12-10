
@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>ESS Login</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

  <div class="panda">
  <div class="ear"></div>
  <div class="face">
    <div class="eye-shade"></div>
    <div class="eye-white">
      <div class="eye-ball"></div>
    </div>
    <div class="eye-shade rgt"></div>
    <div class="eye-white rgt">
      <div class="eye-ball"></div>
    </div>
    <div class="nose"></div>
    <div class="mouth"></div>
  </div>
  <div class="body"> </div>
  <div class="foot">
    <div class="finger"></div>
  </div>
  <div class="foot rgt">
    <div class="finger"></div>
  </div>
</div>
<form id="loginform" action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
  <div class="hand"></div>
  <div class="hand rgt"></div>
  <h1>ESS Login</h1>
  <div class="form-group has-feedback {{ $errors->has('nik') ? 'has-error' : '' }}">
      <input type="nik" id="nik" name="nik" class="form-control" value="{{ old('nik') }}"
             placeholder="{{ trans('adminlte::adminlte.nik') }}">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      @if ($errors->has('nik'))
          <span class="help-block">
              <strong>{{ $errors->first('nik') }}</strong>
          </span>
      @endif
  </div>
  <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
      <input type="password" id="password" name="password" class="form-control"
             placeholder="{{ trans('adminlte::adminlte.password') }}">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
  </div>
  <div class="row">
      <div class="col-xs-8">
          <div class="checkbox icheck">
              <label>
                  <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
              </label>
          </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
          <button type="submit"
                  class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
      </div>
      <!-- /.col -->
  </div>
</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>
    
    @section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
  @stop



</body>

</html>
