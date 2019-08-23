@extends('karyawan.layouts.app')
    @section('meta')
    <title>Absensi | Sistem Absensi</title>
    <meta name="description" content="Sistem Absensi my attendance, view all my attendances, and clock-in/out.">
    @endsection

    @section('styles')
    <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h2 class="page-title">Absensi</h2>
            </div>    
        </div>

        <div class="row">
            <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body reportstable">
                    <form action="" method="get" accept-charset="utf-8" class="ui small form form-filter" id="filterform">
                        {{ csrf_field() }}
                        <div class="inline two fields">
                            <div class="three wide field">
                                <label>Date Range</label>
                                <input id="datefrom" type="text" name="" value="" placeholder="Start Date" class="airdatepicker">
                                <i class="ui icon calendar alternate outline calendar-icon"></i>
                            </div>

                            <div class="two wide field">
                                <input id="dateto" type="text" name="" value="" placeholder="End Date" class="airdatepicker">
                                <i class="ui icon calendar alternate outline calendar-icon"></i>
                            </div>
                            <button id="btnfilter" class="ui button positive small"><i class="ui icon filter alternate"></i> Filter</button>
                        </div>
                    </form>

                    <table width="100%" class="table table-bordered table-hover" id="dataTables-example" data-order='[[ 0, "desc" ]]'>
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                                <th>Total Jam</th>
                                <th>Status (In/Out)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($a)
                            @foreach ($a as $v)
                                <tr>
                                    <td>{{ $v->date }}</td>
                                    <td>@php echo e(date('h:i:s A', strtotime($v->time_in))) @endphp</td>
                                    <td>@php echo e(date('h:i:s A', strtotime($v->time_out))) @endphp</td>
                                    <td>
                                    @isset($v->total_hours)
                                        @if($v->total_hours != null) 
                                            @php
                                                if(stripos($v->total_hours, ".") === false) {
                                                    $h = $v->total_hours;
                                                } else {
                                                    $HM = explode('.', $v->total_hours); 
                                                    $h = $HM[0]; 
                                                    $m = $HM[1];
                                                }
                                            @endphp
                                        @endif
                                        @if($v->total_hours != null)
                                            @if(stripos($v->total_hours, ".") === false) 
                                                {{ $h }} hr
                                            @else 
                                                {{ $h }} hr {{ $m }} minutes
                                            @endif
                                        @endif
                                    @endisset
                                    </td>
                                    <td>
                                        @if($v->status_time_in != '' && $v->status_time_out != '') 
                                            <span class="@if($v->status_time_in == 'Terlambat') orange @else blue @endif">{{ $v->status_time_in }}</span> / 
                                            <span class="@if($v->status_time_out == 'Cepat Masuk') red @else green @endif">{{ $v->status_time_out }}</span> 
                                        @elseif($v->status_time_in == 'Terlambat') 
                                            <span class="orange">{{ $v->status_time_in }}</span>
                                        @else 
                                            <span class="blue">{{ $v->status_time_in }}</span>
                                        @endif 
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
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>

    <script type="text/javascript">
    $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,});

    $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });

    $('#filterform').submit(function(event) {
        event.preventDefault();
        var date_from = $('#datefrom').val();
        var date_to = $('#dateto').val();
        var url = $("#_url").val();

        $.ajax({
            url: '{{url('karyawan/absensi/get')}}',type: 'get',dataType: 'json',data: {date_from: date_from, date_to: date_to},headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                showdata(response);
                function showdata(jsonresponse) {
                    var employee = jsonresponse;
                    var tbody = $('#dataTables-example tbody');
                    
                    // clear data and destroy datatable
                    $('#dataTables-example').DataTable().destroy();
                    tbody.children('tr').remove();

                    // append table row data
                    for (var i = 0; i < employee.length; i++) {
                        var in_status = employee[i].status_time_in;
                        var out_status = employee[i].status_time_out;
                        
                        function t_in_status(in_status) {
                            if(in_status == 'Terlambat'){
                                return 'orange';
                            } else {
                                return 'blue';
                            }
                        }
                        
                        function t_out_status(out_status) {
                            if(out_status == 'Cepat Masuk'){
                                return 'red';
                            } else {
                                return 'green';
                            }
                        }

                        function d_status(in_status, out_status) {
                            if(in_status != '' && out_status != '') {
                                return "<span class=' " + t_in_status(in_status) + "'>" +employee[i].status_time_in+ "</span>" + ' / ' + "<span class='" + t_out_status(out_status) + "'>" +employee[i].status_time_out+ "</span>";
                            } else if (in_status != '' && out_status == '') {
                                return "<span class=' " + t_in_status(in_status) + "'>" +employee[i].status_time_in+ "</span>";
                            } else {
                                return "";
                            }
                        }
                        var time_in = employee[i].time_in;
                        var t_in = time_in.split(" ");
                        var time_out = employee[i].time_out;
                        var t_out = time_out.split(" ");

                        tbody.append("<tr>"+ 
                                        "<td>"+employee[i].date+"</td>" + 
                                        "<td>"+t_in[1]+" "+t_in[2]+"</td>" + 
                                        "<td>"+t_out[1]+" "+t_out[2]+"</td>" + 
                                        "<td>"+employee[i].total_hours+"</td>" + 
                                        "<td>"+ d_status(in_status, out_status) +"</td>" + 
                                    "</tr>");
                    }

                    // initialize datatable
                    $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,});
                }            
            }
        })
    });
    </script>
    @endsection 