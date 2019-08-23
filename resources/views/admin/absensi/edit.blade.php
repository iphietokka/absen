@extends('admin.layouts.app')
    @section('title', 'Edit Absensi')
  

    @section('styles')
    <link href="{{ asset('/assets/vendor/mdtimepicker/mdtimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Edit Absensi</h2>
        </div>    
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">
                    
                    <form id="edit_attendance_form" action="{{ url('admin/absensi/edit') }}" class="ui form" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    
                    @if($a->time_out != null)
                        <div class="two fields">
                            <div class="field">
                                <label>Karyawan</label>
                                <input type="text" name="employee" class="readonly" readonly="" value="{{ $a->employee }}">
                            </div>
                            <div class="field">
                                <label for="">Tanggal</label>
                                <input class="readonly" type="text" placeholder="Date" name="date" value="{{ $a->date }}" readonly="" />
                            </div>
                        </div>
                    @else 
                        <div class="field">
                            <label>Karyawan</label>
                            <input type="text" name="employee" class="readonly" readonly="" value="{{ $a->employee }}">
                        </div>
                    @endif
                    
                    @if($a->time_out != null)
                        <div class="field">
                            <label for="">Waktu Masuk</label>
                          
                                @php 
                                    $t_in = date("h:i:s A",strtotime($a->time_in)); 
                                    $t_in_date = date("m/d/Y",strtotime($a->time_in)); 
                                @endphp
                           
                            <input type="hidden" name="timein_date" value="{{ $t_in_date }}">
                            <input class="jtimepicker" type="text" placeholder="00:00:00 AM" name="time_in" value="{{ $t_in }}"/>
                        </div>
                    @else
                        <div class="two fields">
                            <div class="field">
                                <label for="">Waktu Masuk</label>
                               
                                    @php 
                                        $t_in = date("h:i:s A",strtotime($a->time_in)); 
                                        $t_in_date = date("m/d/Y",strtotime($a->time_in)); 
                                    @endphp
                             
                                <input type="hidden" name="timein_date" value="{{ $t_in_date }}">
                                <input class="jtimepicker" type="text" placeholder="00:00:00 AM" name="time_in" value="{{ $t_in }}"/>
                            </div>
                            <div class="field">
                                <label for="">Tanggal Masuk</label>
                                <input class="readonly" type="text" placeholder="Date" name="date" value="{{ $a->date }}" readonly="" />
                            </div>
                        </div>
                    @endif
                    
                    @if($a->time_out != null)
                        <div class="field">
                            <label for="">Waktu Pulang</label>
                                @php 
                                    $t_out = date("h:i:s A",strtotime($a->time_out)); 
                                    $t_out_date = date("m/d/Y",strtotime($a->time_out)); 
                                @endphp
                            <input type="hidden" name="timeout_date" value="@if($a->time_out != null){{ $t_out_date }}@endif">
                            <input class="jtimepicker" type="text" placeholder="00:00:00 AM" name="time_out" value="@if($a->time_out != null){{ $t_out }}@endif"/>
                        </div>
                    @else
                        <div class="two fields">
                            <div class="field">
                                <label for="">Waktu Pulang</label>
                               
                                    @php 
                                        $t_out = date("h:i:s A",strtotime($a->time_out)); 
                                        $t_out_date = date("m/d/Y",strtotime($a->time_out)); 
                                    @endphp
                            
                                <input type="hidden" name="timeout_date" value="@if($a->time_out != null){{ $t_out_date }}@endif">
                                <input class="jtimepicker" type="text" placeholder="00:00:00 AM" name="time_out" value="@if($a->time_out != null){{ $t_out }}@endif"/>
                            </div>
                            <div class="field">
                                <label for="">Tanggal Pulang</label>
                                <input type="text" name="timeout_date" value="" class="airdatepicker">
                            </div>
                        </div>
                    @endif

                    <div class="fields">
                        <div class="sixteen wide field">
                            <label>Alasan</label>
                            <textarea class="" rows="5" name="reason">{{ $a->reason }}</textarea>
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer">
                    <input type="hidden" name="id" value="{{ $a->id }}">
                    <input type="hidden" name="id_no" value="{{ $a->id_no }}">
                    <button class="ui positive small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Update</button>
                    <a class="ui grey small button" href="{{ url('attendance') }}"><i class="ui times icon"></i> Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    @endsection

    @section('scripts')
    <script src="{{ asset('/assets/vendor/mdtimepicker/mdtimepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>

    <script type="text/javascript">
    $('.jtimepicker').mdtimepicker({format:'h:mm:ss tt', theme: 'blue', hourPadding: true});
    $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });
    </script>

    @endsection