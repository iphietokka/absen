@extends('karyawan.layouts.app')
    @section('meta')
    <title>My Dashboard | Sistem Absensi</title>
    <meta name="description" content="smart timesheet my dashboard, view recent attendance, view recent leave of absence, and view previous schedules.">
    @endsection

    @section('content')
    
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h2 class="page-title">DASHBOARD</h2>
            </div>    
        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ui icon clock outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ABSENSI <span class="text-hint">(Bulan Ini)</span> </span>
                        <div class="progress-group">
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                            </div>
                            <div class="stats_d">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>Terlambat</td>
                                            <td><span class="bolder">@isset($la) {{ $la }} @endisset</span></td>
                                        </tr>
                                        <tr>
                                            <td>Cepat Masuk</td>
                                            <td><span class="bolder">@isset($ed) {{ $ed }} @endisset</span></td>
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
                    <span class="info-box-icon bg-aqua"><i class="ui icon user circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jadwal Kerja</span>
                        <div class="progress-group">
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                            </div>
                            <div class="stats_d">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>Waktu</td>
                                            <td><span class="bolder">@isset($cs->in_time) {{ $cs->in_time }} @endisset - @isset($cs->out_time) {{ $cs->out_time }} @endisset</span></td>
                                        </tr>
                                        <tr>
                                            <td>Hari Libur</td>
                                            <td><span class="bolder">@isset($cs->restday) {{ $cs->restday }} @endisset</span></td>
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
                        <span class="info-box-text">Data Cuti</span>
                        <div class="progress-group">
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-orange" style="width: 100%"></div>
                            </div>
                            <div class="stats_d">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>Approved </td>
                                            <td><span class="bolder">@isset($al) {{ $al }} @endisset</span></td>
                                        </tr>
                                        <tr>
                                            <td>Pending </td>
                                            <td><span class="bolder">@isset($pl) {{ $pl }} @endisset</span></td>
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
                        <h3 class="box-title">Histori Absensi</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">Tanggal</th>
                                <th class="text-left">Waktu</th>
                                <th class="text-left">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($a)
                            @foreach($a as $v)

                            @if($v->time_in != '' && $v->time_out == '')
                            <tr>
                                <td>@php $date1 = date('M d, Y', strtotime($v->date)); @endphp
                                    {{ $date1 }}
                                </td>
                                <td>@php echo e(date('h:i:s A', strtotime($v->time_in))) @endphp</td>
                                <td>Masuk</td>
                            </tr>
                            @endif
                            
                            @if($v->time_in != '' && $v->time_out != '')
                            <tr>
                                <td>@php $date2 = date('M d, Y', strtotime($v->date)); @endphp
                                    {{ $date2 }}
                                </td>
                                <td>@php echo e(date('h:i:s A', strtotime($v->time_out))) @endphp</td>
                                <td>Pulang</td>
                            </tr>
                            @endif

                            @if($v->time_in != '' && $v->time_out != '')
                            <tr>
                                <td>@php $date3 = date('M d, Y', strtotime($v->date)); @endphp
                                    {{ $date3 }}
                                </td>
                                <td>@php echo e(date('h:i:s A', strtotime($v->time_in))) @endphp</td>
                                <td>Masuk</td>
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
                        <h3 class="box-title">Jadwal Kerja Sebelumnya</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <table class="table table-striped nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">Waktu</th>
                                <th class="text-left">Dari / Sampai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($ps)
                            @foreach($ps as $s)
                            <tr>
                                <td>{{ $s->in_time }} - {{ $s->out_time }}</td>
                                <td>
                                    @php 
                                        $date4 = date('M d',strtotime($s->date_from)).' - '.date('M d, Y',strtotime($s->date_to)); 
                                    @endphp
                                    {{ $date4 }}
                                </td>
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
                        <h3 class="box-title">Histori Cuti</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <table class="table table-striped nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">Deskripsi</th>
                                <th class="text-left">Tanggal</th>
                            </tr>
                        </thead>
                            <tbody>
                                @isset($ald)
                                @foreach($ald as $l)
                                <tr>
                                    <td>{{ $l->type }}</td>
                                    <td>
                                        @php
                                            $fd = date('M', strtotime($l->leave_from));
                                            $td = date('M', strtotime($l->leave_to));

                                            if($fd == $td){
                                                $var = date('M d', strtotime($l->leave_from)) .' - '. date('d, Y', strtotime($l->leave_to));
                                            } else {
                                                $var = date('M d', strtotime($l->leave_from)) .' - '. date('M d, Y', strtotime($l->leave_to));
                                            }
                                        @endphp
                                        {{ $var }}
                                    </td>
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
    
    @section('scripts')
    <script type="text/javascript">
    

    </script>
    @endsection 