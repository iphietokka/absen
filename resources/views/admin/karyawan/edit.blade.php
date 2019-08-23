@extends('admin.layouts.app')
    @section('meta')
    <title>Edit Profile Karyawan | Sistem Absensi</title>
    <meta name="description" content="smart timesheet edit employee profile.">
    @endsection 

    @section('styles')
    <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Edit Profile Karyawan
                    <a href="{{ url('admin/karyawan') }}" class="ui basic blue button mini offsettop5 float-right"><i class="ui icon chevron left"></i>Kembali</a>
                </h2>
            </div>    
        </div>

        <div class="row">
                <form id="edit_employee_form" action="{{ url('admin/karyawan/edit') }}" class="ui form custom" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="col-md-6 float-left">
                        <div class="box box-success">
                            <div class="box-header with-border">Personal Infomasi</div>
                            <div class="box-body">
                                <div class="two fields">
                                    <div class="field">
                                        <label>First Name</label>
                                        <input type="text" class="uppercase" name="first_name" value="{{ $person_details->first_name }}">
                                    </div>
                                     <div class="field">
                                    <label>Last Name</label>
                                    <input type="text" class="uppercase" name="last_name" value="{{ $person_details->last_name }}">
                                </div>
                                </div>
                               
                                <div class="field">
                                    <label>Gender</label>
                                    <select name="gender" class="ui dropdown uppercase">
                                        <option value="">Select Gender</option>
                                        <option value="LAKI-LAKI" @if($person_details->gender == 'LAKI-LAKI') selected @endif>LAKI-LAKI</option>
                                        <option value="PEREMPUAN" @if($person_details->gender == 'PEREMPUAN') selected @endif>PEREMPUAN</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Civil Status</label>
                                    <select name="civil_status" class="ui dropdown uppercase">
                                        <option value="">Select Civil Status</option>
                                        <option value="SINGLE"@if($person_details->civil_status == 'SINGLE') selected @endif>SINGLE</option>
                                        <option value="MARRIED"@if($person_details->civil_status == 'MARRIED') selected @endif>MARRIED</option>
                                        <option value="ANULLED" @if($person_details->civil_status == 'ANULLED') selected @endif>ANULLED</option>
                                        <option value="WIDOWED" @if($person_details->civil_status == 'WIDOWED') selected @endif>WIDOWED</option>
                                        <option value="LEGALLY SEPARATED" @if($person_details->civil_status == 'LEGALLY SEPARATED') selected @endif>LEGALLY SEPARATED</option>
                                    </select>
                                </div>

                                
                                
                                <div class="two fields">
                                <div class="field">
                                    <label>Email Address (Personal)</label>
                                    <input type="email" name="email" value="{{ $person_details->email}}" class="lowercase">
                                </div>
                                 <div class="field">
                                        <label>Age</label>
                                        <input type="text" name="age" value="{{ $person_details->age }}" placeholder="00">
                                    </div>
                                </div>
                                <div class="two fields">
                                   
                                    <div class="field">
                                        <label>Date of Birth</label>
                                        <input type="text" name="birthday" value="{{ $person_details->birthday }}" class="airdatepicker" placeholder="Date">
                                    </div>
                                    <div class="field">
                                    <label>Place of Birth</label>
                                    <input type="text" class="uppercase" name="birthplace" value="{{ $person_details->birthplace }}" placeholder="City, Province, Country">
                                </div>
                                </div>
                                
                                
                                <div class="field">
                                    <label>Address</label>
                                    <input type="text" class="uppercase" name="address" value="{{ $person_details->address }}" placeholder="House/Unit Number, Building, Street, City, Province, Country">
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
                            <div class="box-header with-border">Employee Details</div>
                            <div class="box-body">
                                <h4 class="ui dividing header">Designation</h4>
                                <div class="field">
                                    <label>Company</label>
                                    <select name="company" class="ui search dropdown uppercase">
                                        <option value="">Select Company</option>
                                     
                                        @foreach ($company as $data)
                                            <option value="{{ $data->company }}" @if($data->company == $company_details->company) selected @endif> {{ $data->company }}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Department</label>
                                    <select name="department" class="ui search dropdown uppercase department">
                                        <option value="">Select Department</option>
                                      
                                        @foreach ($department as $data)
                                            <option value="{{ $data->department }}" @if($data->department == $company_details->department) selected @endif> {{ $data->department }}</option>
                                        @endforeach
                                     
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Job Title / Position</label>
                                    <div class="ui search dropdown selection uppercase jobposition">
                                        <input type="hidden" name="job_position" value="{{$company_details->job_position}}">
                                        <i class="dropdown icon"></i>
                                        <div class="text">{{$company_details->job_position}}</div>
                                        <div class="menu">
                                      
                                            @foreach ($jobtitle as $data)
                                                @foreach ($department as $dept)
                                                    @if($dept->id == $data->dept_code)
                                                        <div class="item" data-value="{{ $data->job_title }}" data-dept="{{ $dept->department }}" @if($data->jobtitle == $company_details->job_position) selected @endif>{{ $data->job_title }}</div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                     
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>ID Number</label>
                                    <input type="text" class="uppercase" name="id_no" value="{{ $company_details->id_no }}">
                                </div>
                                <div class="field">
                                    <label>Email Address (Company)</label>
                                    <input type="email" name="company_email" value="{{ $company_details->company_email }}" class="lowercase">
                                </div>
                                <div class="field">
                                    <label>Leave Privilege</label>
                                    <select name="leave_privilege" class="ui dropdown uppercase">
                                        <option value="">Select Leave Privilege</option>
                                        @isset($leavegroup) 
                                            @foreach($leavegroup as $lg)
                                                <option value="{{ $lg->id }}"  @if($lg->id == $company_details->leave_privilege) selected @endif >{{ $lg->leave_group }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <h4 class="ui dividing header">Employment Information</h4>
                                <div class="field">
                                    <label>Employment Type</label>
                                    <select name="employment_type" class="ui dropdown uppercase">
                                        <option value="">Select Type</option>
                                        <option value="Regular" @if($person_details->employment_type == 'Regular') selected @endif>Regular</option>
                                        <option value="Trainee" @if($person_details->employment_type == 'Trainee') selected @endif>Trainee</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Employment Status</label>
                                    <select name="employment_status" class="ui dropdown uppercase">
                                        <option value="">Select Status</option>
                                        <option value="Active" @if($person_details->employment_status == 'Active') selected @endif>Active</option>
                                        <option value="Archived" @if($person_details->employment_status == 'Archived') selected @endif>Archived</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Official Start Date</label>
                                    <input type="text" name="start_date" value="{{ $company_details->start_date }}" class="airdatepicker" placeholder="Date">
                                </div>
                                <div class="field">
                                    <label>Date Regularized</label>
                                    <input type="text" name="date_regularized" value="{{ $company_details->date_regularized }}" class="airdatepicker" placeholder="Date">
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
                            <input type="hidden" name="id" value="{{ $person_details->id }}">
                            <button type="submit" name="submit" class="ui green button small"><i class="ui checkmark icon"></i> Update</button>
                            <a href="{{ url('employees') }}" class="ui grey button small"><i class="ui times icon"></i> Cancel</a>
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
        $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });
        $('.ui.dropdown.department').dropdown({ onChange: function(value, text, $selectedItem) {
            $('.jobposition .menu .item').addClass('hide');
            $('.jobposition .text').text('');
            $('input[name="job_position"]').val('');
            $('.jobposition .menu .item').each(function() {
                var dept = $(this).attr('data-dept');
                if(dept == value) {$(this).removeClass('hide');};
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

        var selected = "{{ $company_details->leave_privilege }}";
        var items = selected.split(',');
        $('.ui.dropdown.multiple.leaves').dropdown('set selected', items);
    </script>
    @endsection