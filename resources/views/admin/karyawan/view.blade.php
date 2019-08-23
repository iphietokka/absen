@extends('admin.layouts.app')
    @section('meta')
    <title>Profile | Sistem Absensi</title>
    <meta name="description" content="smart timesheet view employee profile, edit employee profile, update employee profile">
    @endsection

    @section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Profile Karyawan
                    <a href="{{ url('admin/karyawan') }}" class="ui basic blue button mini offsettop5 float-right"><i class="ui icon chevron left"></i>Kembali</a>
                </h2>
            </div>    
        </div>

        <div class="row">
            <div class="col-md-4 float-left">
                <div class="box box-success">
                    <div class="box-body employee-info">
                            <div class="author">
                            @if($i != null)
                                <img class="avatar border-white" src="{{ asset('/assets/faces/'.$i) }}" alt="profile photo"/>
                            @else
                                <img class="avatar border-white" src="{{ asset('/assets/images/faces/default_user.jpg') }}" alt="profile photo"/>
                            @endif
                            </div>
                            <p class="description text-center">
                                <h4 class="title">{{ $p->first_name }} {{ $p->last_name }}</h4>
                                <table style="width: 100%" class="profile-tbl">
                                    <tbody>
                                        <tr>
                                            <td>Email</td>
                                            <td><span class="p_value"> {{ $p->email }} </span></td>
                                        </tr>
                                        <tr>
                                            <td>ID No.</td>
                                            <td><span class="p_value">{{ $c->id_no }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8 float-left">
                <div class="box box-success">
                    <div class="box-header with-border">Personal Infomasi</div>
                    <div class="box-body employee-info">
                            <table class="tablelist">
                                <tbody>
                                    <tr>
                                        <td><p>Status Pernikahan</p></td>
                                        <td><p> {{ $p->civil_status }}</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Umur</p></td>
                                        <td><p> {{ $p->age }}</p></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><p>Jenis Kelamin</p></td>
                                        <td><p>{{ $p->gender }} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Tanggal Lahir</p></td>
                                        <td>
                                            <p>
                                               
                                                    @php echo e(date("F d, Y", strtotime($p->birthday))) @endphp
                                                
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>Tempat Lahir</p></td>
                                        <td><p>{{ $p->birthplace }} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Alamat</p></td>
                                        <td><p>{{ $p->address }}</p></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2">
                                            <h4 class="ui dividing header">Designation</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Perusahaan</td>
                                        <td>{{ $c->company }} </td>
                                    </tr>
                                    <tr>
                                        <td><p>Departemen</p></td>
                                        <td><p>{{ $c->department }} </p></td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>{{ $c->job_position }} </td>
                                    </tr>
                                    <tr>
                                        <td>Leave Privilege</td>
                                        <td>
                                            
                                                @foreach($leavegroup as $lg)
                                                    @if($lg->id == $c->leave_privilege)
                                                        @php
                                                            $lp = explode(",", $lg->leave_privileges);
                                                        @endphp
                                                        @foreach($lp as $rights) 
                                                            @foreach($leavetype as $lt)
                                                                @if($lt->id == $rights) {{ $lt->leave_type }}, @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                         
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>Tipe Karyawan</p></td>
                                        <td><p> {{ $p->employment_type }} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Employement Status</p></td>
                                        <td><p>{{ $p->employment_status }}</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Tanggal Mulai Kerja</p></td>
                                        <td>
                                            <p>
                                         
                                                @php echo e(date("F d, Y", strtotime($c->start_date))) @endphp
                                           
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>Tanggal Regulasi</p></td>
                                        <td>
                                            <p>
                                           
                                                @php echo e(date("F d, Y", strtotime($c->date_regularized))) @endphp
                                           
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

        </div><!-- end of row -->
    </div>

    @endsection
    
    @section('scripts')

    <script type="text/javascript">

    </script>
    @endsection 




