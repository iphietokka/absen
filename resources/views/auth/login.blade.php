<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
  <title>Sign in | Sistem Absensi</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- VENDOR CSS -->
  <link href="{{ asset('/assets/vendor/semantic-ui/semantic.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('/assets/css/auth.css') }}" rel="stylesheet">

</head>

<body>
  <!-- WRAPPER -->
  <div id="wrapper">

    <div class="vertical-align-wrap">
      <div class="vertical-align-middle">
        <div class="auth-box">
          <div class="content">
            <div class="header">

              <p class="lead">Silahkan Login</p>
            </div>
            <form class="form-auth-small ui form" action="{{ route('login') }}" method="POST">
              {{ csrf_field() }}

              <div class="fields">
                <div class="sixteen wide field {{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="email" class="color-white">Username</label>
                  <input id="email" type="text" class="" name="email" value="{{ old('username') }}" placeholder="Username" required autofocus>

                  @if ($errors->has('username'))
                  <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                  </span>
                  @endif  
                </div>
              </div>
              <div class="fields">
                <div class="sixteen wide field {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="color-white">Password</label>
                  <input id="password" type="password" class="" name="password" placeholder="Your password" required>

                  @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="fields">
                <div class="sixteen wide field">
                  <div class="ui checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="color-white">Remember me</label>
                  </div>
                </div>
              </div>

              <button type="submit" class="ui blue button large fluid">SIGN IN</button>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- END WRAPPER -->

  <!--   Core JS Files   -->
  <script src="{{ asset('/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/semantic-ui/semantic.min.js') }}"></script>
  <script>
    $('.ui.checkbox').checkbox('uncheck', 'toggle');

    $( document ).ready(function() {
      $('input').attr('autocomplete','off');
    });
  </script>
</body>

</html>
