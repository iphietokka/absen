@extends('admin.layouts.app')
    @section('meta')
    <title>Edit Jadwal Kerja | Sistem Absensi</title>
    <meta name="description" content="smart timesheet edit employee schedule.">
    @endsection 

    @section('styles')
    <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/mdtimepicker/mdtimepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Edit Jadwal</h2>
        </div>    
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">
                <form id="edit_schedule_form" action="{{ url('admin/jadwal/edit') }}" class="ui form" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}
                    <div class="field">
                        <label>Karyawan</label>
                        <input type="text" value="{{ $sc->employee }}" name="employee" class="readonly" readonly="" />
                    </div>

                    <div class="two fields">
                        <div class="field">
                            <label for="">Waktu Mulai</label>
                            <input type="text" placeholder="00:00:00 AM" name="in_time" class="jtimepicker" value="{{ $sc->in_time }}"/>
                        </div>
                        <div class="field">
                            <label for="">Waktu Selesai</label>
                            <input type="text" placeholder="00:00:00 PM" name="out_time" class="jtimepicker" value="{{ $sc->out_time }}"/>
                        </div>
                    </div>

                    <div class="field">
                        <label for="">Dari</label>
                        <input type="text" placeholder="Date" name="date_from" class="airdatepicker" value="{{ $sc->date_from }}"/>
                    </div>
                    <div class="field">
                        <label for="">Sampai</label>
                        <input type="text" placeholder="Date" name="date_to" class="airdatepicker" value="{{ $sc->date_to }}"/>
                    </div>

                    <div class="eight wide field">
                        <label for="">Jam</label>
                        <input type="text" placeholder="0" name="hours" value="{{ $sc->hours }}"/>
                    </div>

                    <div class="grouped custom fields field">
                        <label>Hari Libur</label>
                        <div class="field">
                        <div class="ui checkbox sunday  @if(in_array('Minggu', $rest) == true) checked @endif">
                            <input type="checkbox" name="restday[]" value="Minggu" @if(in_array('Minggu', $rest) == true) checked @endif>
                            <label>Minggu</label>
                        </div>
                        </div>
                        <div class="field">
                        <div class="ui checkbox @if(in_array('Senin', $rest) == true) checked @endif">
                            <input type="checkbox" name="restday[]" value="Senin" @if(in_array('Senin', $rest) == true) checked @endif>
                            <label>Senin</label>
                        </div>
                        </div>
                        <div class="field">
                        <div class="ui checkbox @if(in_array('Selasa', $rest) == true) checked @endif">
                            <input type="checkbox" name="restday[]" value="Selasa" @if(in_array('Selasa', $rest) == true) checked @endif>
                            <label>Selasa</label>
                        </div>
                        </div>
                        <div class="field">
                        <div class="ui checkbox @if(in_array('Rabu', $rest) == true) checked @endif">
                            <input type="checkbox" name="restday[]" value="Rabu" @if(in_array('Rabu', $rest) == true) checked @endif>
                            <label>Rabu</label>
                        </div>
                        </div>
                        <div class="field">
                        <div class="ui checkbox @if(in_array('Kamis', $rest) == true) checked @endif ">
                            <input type="checkbox" name="restday[]" value="Kamis" @if(in_array('Kamis', $rest) == true) checked @endif>
                            <label>Kamis</label>
                        </div>
                        </div>
                        <div class="field">
                        <div class="ui checkbox  @if(in_array('Jumat', $rest) == true) checked @endif ">
                            <input type="checkbox" name="restday[]" value="Jumat"  @if(in_array('Jumat', $rest) == true) checked @endif >
                            <label>Jumat</label>
                        </div>
                        </div>
                        <div class="field">
                        <div class="ui checkbox saturday  @if(in_array('Sabtu', $rest) == true) checked @endif ">
                            <input type="checkbox" name="restday[]" value="Sabtu"  @if(in_array('Sabtu', $rest) == true) checked @endif >
                            <label>Sabtu</label>
                        </div>
                        </div>
                    </div>
                    <div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header"></div>
                        <ul class="list">
                            <li class=""></li>
                        </ul>
                    </div>
                </div>

                <div class="box-footer">
                    <input type="hidden" name="id" value="{{ $sc->id }}">
                    <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Update</button>
                    <a href="{{ url('schedules') }}" class="ui black grey small button"><i class="ui times icon"></i> Cancel</a>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>
    <script src="{{ asset('/assets/vendor/mdtimepicker/mdtimepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-example').DataTable({ responsive: true, pageLength: 15, lengthChange: false, });
        });

        $('.jtimepicker').mdtimepicker({ format: 'h:mm:ss tt', hourPadding: true });
        $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });
        
        $('.ui.dropdown.getid').dropdown({ onChange: function(value, text, $selectedItem) {
            $('select[name="employee"] option').each(function() {
                if($(this).val()==value) { var id = $(this).attr('data-id'); $('input[name="id"]').val(id); };
            });
        }});

    </script>
    @endsection