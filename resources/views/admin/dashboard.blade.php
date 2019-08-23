@extends('admin.layouts.app')
@section('meta')
@section('title','Dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Dashboard</h2>
        </div>    
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ui icon user circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Karyawan</span>
                    <div class="progress-group">
                        <div class="progress sm">
                            <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                        </div>
                        <div class="stats_d">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td>Regular</td>
                                        <td>@isset($emp_typeR) {{ $emp_typeR }} @endisset</td>
                                    </tr>
                                    <tr>
                                        <td>Trainee</td>
                                        <td>@isset($emp_typeT) {{ $emp_typeT }} @endisset</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ui icon clock outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Absensi</span>
                    <div class="progress-group">
                        <div class="progress sm">
                            <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                        </div>
                        <div class="stats_d">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td>Online</td>
                                        <td>@isset($is_online_now) {{ $is_online_now }} @endisset</td>
                                    </tr>
                                    <tr>
                                        <td>Offline</td>
                                        <td>@isset($is_offline_now) {{ $is_offline_now }} @endisset</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-orange"><i class="ui icon home"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Permintaan Cuti</span>
                    <div class="progress-group">
                        <div class="progress sm">
                            <div class="progress-bar progress-bar-orange" style="width: 100%"></div>
                        </div>
                        <div class="stats_d">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td>Approved</td>
                                        <td>@isset($emp_leaves_approve) {{ $emp_leaves_approve }} @endisset</td>
                                    </tr>
                                    <tr>
                                        <td>Pending</td>
                                        <td>@isset($emp_leaves_pending) {{ $emp_leaves_pending }} @endisset</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Karyawan Baru</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table responsive nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">Nama</th>
                                <th class="text-left">Jabatan</th>
                                <th class="text-left">Tanggal Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($emp_all_type)
                            @foreach ($emp_all_type as $data)
                            <tr>
                                <td class="text-left name-title">{{ $data->last_name }}, {{ $data->first_name }}</td>
                                <td class="text-left">{{ $data->job_position }}</td>
                                <td class="text-left">@php echo e(date('M d, Y', strtotime($data->start_date))) @endphp</td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">History Absensi</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table responsive nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">Nama</th>
                                <th class="text-left">Tipe</th>
                                <th class="text-left">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($a)
                            @foreach($a as $v)

                            @if($v->time_in != null && $v->time_out == null)
                            <tr>
                                <td class="name-title">{{ $v->employee }}</td>
                                <td>Waktu Masuk</td>
                                <td>@php echo e(date('h:i:s A', strtotime($v->time_in))) @endphp</td>
                            </tr>
                            @endif
                            
                            @if($v->time_in != null && $v->time_out != null)
                            <tr>
                                <td class="name-title">{{ $v->employee }}</td>
                                <td>Waktu-Pulang</td>
                                <td>@php echo e(date('h:i:s A', strtotime($v->time_out))) @endphp</td>
                            </tr>
                            @endif

                            @if($v->time_in != null && $v->time_out != null)
                            <tr>
                                <td class="name-title">{{ $v->employee }}</td>
                                <td>Waktu-Masuk</td>
                                <td>@php echo e(date('h:i:s A', strtotime($v->time_in))) @endphp</td>
                            </tr>
                            @endif

                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">History Cuti</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table responsive nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">Nama</th>
                                <th class="text-left">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($emp_approved_leave)
                            @foreach ($emp_approved_leave as $leaves)
                            <tr>
                                <td class="text-left name-title">{{ $leaves->employee }}</td>
                                <td class="text-left">@php echo e(date('M d, Y', strtotime($leaves->leave_from))) @endphp</td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

