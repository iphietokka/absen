@extends('admin.layouts.app')
   
    @section('title', 'Absensi')

    
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">Absensi
                <a href="{{ url('clock') }}" class="ui positive button mini offsettop5 float-right"><i class="ui icon clock"></i>Masuk/Pulang</a>
            </h2>
        </div>  

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>Tanggal</th>
                                <th>Karyawan</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                                <th>Total Jam</th>
                                <th>Status (In / Out)</th>
                                @isset($clock_comment)
                                    @if($clock_comment == 1)
                                        <th>Comment</th>
                                    @endif
                                @endisset
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($data)
                            @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->id_no }}</td>
                                <td>{{ $d->date }}</td>
                                <td>{{ $d->employee }}</td>
                                <td>@php $IN = date('h:i:s A', strtotime($d->time_in)); echo $IN; @endphp</td>
                                <td>
                                    @isset($d->time_out)
                                        @php 
                                            $OUT = date('h:i:s A', strtotime($d->time_out));
                                        @endphp
                                        @if($d->time_out != NULL)
                                            {{ $OUT }}
                                        @endif
                                    @endisset
                                </td>
                                <td class="align-right">
                                    @isset($d->total_hours)
                                        @if($d->total_hours != null) 
                                            @php
                                                if(stripos($d->total_hours, ".") === false) {
                                                    $h = $d->totalhours;
                                                } else {
                                                    $HM = explode('.', $d->total_hours); 
                                                    $h = $HM[0]; 
                                                    $m = $HM[1];
                                                }
                                            @endphp
                                        @endif
                                        @if($d->total_hours != null)
                                            @if(stripos($d->total_hours, ".") === false) 
                                                {{ $h }} hr
                                            @else 
                                                {{ $h }} hr {{ $m }} minutes
                                            @endif
                                        @endif
                                    @endisset
                                </td>
                                <td>
                                    @if($d->status_time_in != null OR $d->status_time_out != null) 
                                        <span class="@if($d->status_time_in == 'Terlambat') orange @else blue @endif">{{ $d->status_time_in }}</span> / 
                                        
                                        @isset($d->status_time_out) 
                                            <span class="@if($d->status_time_out == 'Cepat Masuk') red @else green @endif">
                                                {{ $d->status_time_out }}
                                            </span> 
                                        @endisset
                                    @else
                                        <span class="blue">{{ $d->status_time_in }}</span>
                                    @endif 
                                </td>
                                @isset($clock_comment)
                                    @if($clock_comment == 1)
                                        <td>{{ $d->comment }}</td>
                                    @endif
                                @endisset
                                <td class="align-right">
                                     <form class="form-horizontal" method="POST" action="{{url('admin/'.$title.'/'.$d->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                     <a href="{{ url('/admin/absensi/edit/'.$d->id) }}" class="ui circular basic icon button tiny"><i class="edit outline icon"></i></a>
                                    <button class=" ui circular basic icon button tiny js-submit-confirm">
                                        <i class="icon trash alternate outline"></i>
                                    </button>
                                </form>
                                   
                                  
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

    @endsection

    @section('scripts')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,sorting: false,});
    });
    </script> 

    @endsection