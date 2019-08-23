@extends('admin.layouts.app')
    @section('meta')
    <title>Karyawan Baru | Sistem Absensi</title>
    <meta name="description" content="smart timesheet add new employee, delete employee, edit employee">
    @endsection

    @section('styles')
    <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Karyawan Baru</h2>
            </div>    
        </div>

        <div class="row">
            <form id="add_employee_form" action="{{ url('admin/karyawan/store') }}" class="ui form custom" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
            {{ csrf_field() }}

                <div class="col-md-6 float-left">
                    <div class="box box-success">
                        <div class="box-header with-border">Informasi Pribadi</div>
                        <div class="box-body">
                            <div class="two fields">
                                <div class="field">
                                    <label>Nama Awal</label>
                                    <input type="text" class="uppercase" name="first_name" value="">
                                </div>
                                <div class="field">
                                <label>Nama Akhir</label>
                                <input type="text" class="uppercase" name="last_name" value="">
                            </div>
                            </div>
                            
                            <div class="field">
                                <label>Gender</label>
                                <select name="gender" class="ui dropdown uppercase">
                                    <option value="">Select Gender</option>
                                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                                    <option value="PEREMPUAN">PEREMPUAN</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Status Sosial</label>
                                <select name="civil_status" class="ui dropdown uppercase">
                                   
                                   <option value="">Select Civil Status</option>
                                    <option value="SINGLE">SINGLE</option>
                                    <option value="MARRIED">MARRIED</option>
                                    <option value="ANULLED">ANULLED</option>
                                    <option value="WIDOWED">WIDOWED</option>
                                    <option value="LEGALLY SEPARATED">LEGALLY SEPARATED</option>
                                  
                                </select>
                            </div>

                            
                            
                            <div class="two fields">
                            <div class="field">
                                <label>Email Address (Pribadi)</label>
                                <input type="email" name="email" value="" class="lowercase">
                            </div>
                           
                            </div>

                           <div class="two fields">
                                <div class="field">
                                    <label>Umur</label>
                                    <input type="number" name="age" value="" placeholder="00">
                                </div>
                                <div class="field">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" name="birthday" value="" class="airdatepicker" data-position="top right" placeholder="Date"> 
                                </div>
                            </div>
                           
                            <div class="field">
                                <label>Tempat Lahir</label>
                                <input type="text" class="uppercase" name="birth_place" value="" placeholder="City, Province, Country">
                            </div>
                            <div class="field">
                                <label>Alamat</label>
                                <input type="text" class="uppercase" name="address" value="" placeholder="House/Unit Number, Building, Street, City, Province, Country">
                            </div>
                            <div class="field">
                                <label>Upload Profile photo</label>
                                <input class="ui file upload" value="" id="imagefile" name="image" type="file" accept="image/png, image/jpeg, image/jpg" onchange="validateFile()">
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 float-left">
                    <div class="box box-success">
                        <div class="box-header with-border">Detail Karyawan</div>
                        <div class="box-body">
                            <h4 class="ui dividing header">Designation</h4>
                            <div class="field">
                                <label>Perusahaan</label>
                                <select name="company" class="ui search dropdown uppercase">
                                    <option value="">Select Perusahaan</option>
                                    @isset($company)
                                    @foreach ($company as $data)
                                        <option value="{{ $data->company }}"> {{ $data->company }}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="field">
                                <label>Departemen</label>
                                <select name="department" class="ui search dropdown uppercase department">
                                    <option value="">Select Department</option>
                                    @isset($department)
                                    @foreach ($department as $data)
                                        <option value="{{ $data->department }}"> {{ $data->department }}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="field">
                                <label>Jabatan</label>
                                <div class="ui search dropdown selection uppercase jobposition">
                                    <input type="hidden" name="job_position">
                                    <i class="dropdown icon" tabindex="1"></i>
                                    <div class="default text">Select Job Title</div>
                                    <div class="menu">
                                   
                                        @foreach ($jobtitle as $data)
                                            @foreach ($department as $dept)
                                                @if($dept->id == $data->dept_code)
                                                    <div class="item" data-value="{{ $data->job_title }}" data-dept="{{ $dept->department }}">{{ $data->job_title }}</div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                  
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Nomor ID</label>
                                <input type="text" class="uppercase" name="id_no" value="">
                            </div>
                            <div class="field">
                                <label>Email Address (Perusahaan)</label>
                                <input type="email" name="company_email" value="" class="lowercase">
                            </div>
                            <div class="field">
                                <label>Group Cuti</label>
                                <select name="leave_privilege" class="ui dropdown uppercase">
                                    <option value="">Select Leave Privilege</option>
                                    @isset($leavegroup) 
                                        @foreach($leavegroup as $lg)
                                            <option value="{{ $lg->id }}">{{ $lg->leave_group }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            <h4 class="ui dividing header">Informasi Pekerjaan</h4>
                            <div class="field">
                                <label>Tipe Pekerja</label>
                                <select name="employment_type" class="ui dropdown uppercase">
                                    <option value="">Pilih Tipe</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Trainee">Training</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Employment Status</label>
                                <select name="employment_status" class="ui dropdown uppercase">
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Archived">Archived</option>
                                </select>
                            </div>
                            
                            <div class="field">
                                <label>Tanggal Resmi Kerja</label>
                                <input type="text" name="start_date" value="" class="airdatepicker uppercase" data-position="top right" placeholder="Date">
                            </div>
                            <div class="field">
                                <label>Tanggal Regulasi</label>
                                <input type="text" name="date_regularized" value="" class="airdatepicker uppercase" data-position="top right" placeholder="Date">
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 float-left">
                    <div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header"></div>
                        <ul class="list">
                            <li class=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 float-left">
                    <div class="action align-right">
                        <button type="submit" name="submit" class="ui green button small"><i class="ui checkmark icon"></i>Save</button>
                        <a href="{{ url('employees') }}" class="ui grey button small"><i class="ui times icon"></i>Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>
    <script type="text/javascript">
    $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd', autoClose: true });
    
    $('.ui.dropdown.department').dropdown({ onChange: function(value, text, $selectedItem) {
        $('.jobposition .menu .item').addClass('hide disabled');
        $('.jobposition .text').text('');
        $('input[name="job_position"]').val('');
        $('.jobposition .menu .item').each(function() {
            var dept = $(this).attr('data-dept');
            if(dept == value) {$(this).removeClass('hide disabled');};
        });
    }});

    function validateFile() {
        var f = document.getElementById("imagefile").value;
        var d = f.lastIndexOf(".") + 1;
        var ext = f.substr(d, f.length).toLowerCase();
        if (ext == "jpg" || ext == "jpeg" || ext == "png") { } else {
            document.getElementById("imagefile").value="";
            $.notify({
            icon: 'ui icon times',
            message: "Please upload only jpg/jpeg and png image formats."},
            {type: 'danger',timer: 400});
        }
    }
    </script>
    @endsection