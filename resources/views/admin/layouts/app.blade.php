<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>@yield('title') | Sistem Absensi</title>
    <meta name="description" content="smart timesheet attendance, view all employee attendances, clock-in, edit, and delete attendances.">
  

  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/bootstrap/css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/semantic-ui/semantic.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/DataTables/datatables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css') }}">
  <link href="{{ asset('js/sweetalert.css') }}" rel="stylesheet" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="{{ asset('/assets/js/html5shiv.js') }}></script>
<script src="{{ asset('/assets/js/respond.min.js') }}"></script>
<![endif]-->

@yield('styles')
</head>
<body>

  <div class="wrapper">

    @include('Admin.layouts.sidebar')

    <div id="body">
      <nav class="navbar navbar-expand-lg navbar-light bg-lightblue">
        <div class="container-fluid">

          <button type="button" id="slidesidebar" class="ui icon button btn-light-outline">
            <i class="ui icon bars"></i> Show/Hide
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto navmenu">
              <li class="nav-item">
                <div class="ui pointing link dropdown item" tabindex="0">
                  <i class="ui icon th"></i> <span class="navmenutext">Quick Access</span>
                  <i class="dropdown icon"></i>
                  <div class="menu" tabindex="-1">
                    <a href="{{ url('admin/karyawan/create') }}" class="item"><i class="ui icon user plus"></i> Tambah Karyawan</a>
                    <a href="{{ url('clock') }}" target="_blank" class="item"><i class="ui icon clock outline"></i> Absensi</a>
                    <div class="divider"></div>
                    <a href="{{ url('admin/perusahaan') }}" class="item"><i class="ui icon university"></i> Perusahaan</a>
                    <a href="{{ url('admin/departemen') }}" class="item"><i class="ui icon cubes"></i> Departemen</a>
                    <a href="{{ url('admin/jabatan') }}" class="item"><i class="ui icon pencil alternate"></i>Jabatan</a>

                  </div>
                </div>
              </li>
              <li class="nav-item">
                <div class="ui pointing link dropdown item" tabindex="0">
                  <i class="ui icon user outline"></i> <span class="navmenutext">{{ Auth::user()->name }} </span>
                  <i class="dropdown icon"></i>
                  <div class="menu" tabindex="-1">
                    <a href="{{ url('admin/user/update-profile') }}" class="item"><i class="ui icon user"></i> Update Account</a>
                    <a href="{{ url('admin/user/password-update') }}" class="item"><i class="ui icon lock"></i> Ganti Password</a>
                    <a href="{{ url('karyawan') }}" target="_blank" class="item"><i class="ui icon sign-in"></i> Pindah Akun</a>
                    <div class="divider"></div>
                    <a href="{{ url('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="item"><i class="ui icon power"></i> Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </nav>

      <div class="content">

        @yield('content')
      </div>
    </div>
  </div>

  <script src="{{ asset('/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/semantic-ui/semantic.min.js') }}"></script>
  <script src="{{ asset('/assets/js/bootstrap-notify.js') }}"></script>
  <script src="{{ asset('/assets/vendor/DataTables/datatables.min.js') }}"></script>
  <script src="{{ asset('/assets/js/script.js') }}"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}"></script>

@if ($success = Session::get('success'))
<script>
  $(document).ready(function() {
    $.notify({
      icon: 'ui icon check',
      message: "{{ $success }}"},
      {type: 'success',timer: 400}
      );
  });
</script>
@endif

@if ($error = Session::get('error'))
<script>
  $(document).ready(function() {
    $.notify({
      icon: 'ui icon times',
      message: "{{ $error }}"},
      {type: 'danger',timer: 400});
  });
</script>
@endif 
<script>
  $(document.body).on('click', '.js-submit-confirm', function (event) {
    event.preventDefault();
    var $form = $(this).closest('form');
    swal({
      title: "Anda Yakin Ingin Menghapus..?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes",
      closeOnConfirm: true
    },
    function () {
      $form.submit();
    });
  });
</script>

<script>
  $(function() {
    $('#sidebar a[href~="' + location.href + '"]').parents('li').addClass('active');
  });

  $( document ).ready(function() {
    $('input').attr('autocomplete','off');
  });
</script>
@yield('scripts')

</body>
</html>