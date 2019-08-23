@extends('admin.layouts.app')
    @section('meta')
    <title>Jadwal Kerja | Sistem Absensi</title>
    <meta name="description" content="smart timesheet schedules, view all employee schedules, add schedule or shift, edit, and delete schedules.">
    @endsection

    @section('styles')
    <link href="{{ asset('/assets/vendor/mdtimepicker/mdtimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    <style>
        .ui.active.modal {position: relative !important;}
        .datepicker {z-index: 999 !important;}
        .datepickers-container {z-index: 9999 !important;}
    </style>
    @endsection

    @section('content')
    @include('admin.modals.modal-add-schedule')
    
    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">Jadwal Kerja
        <button class="ui positive button mini offsettop5 btn-add float-right"><i class="ui icon plus"></i>Add</button>
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <table width="100%" class="table table-striped table-hover" id="dataTables-example" data-order='[[ 7, "desc" ]]'>
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>Karyawan</th>
                                <th>Waktu <span class="help">(Masuk - Pulang)</span></th>
                                <th>Jam</th>
                                <th>Hari Libur<span class="help">(s)</span></th>
                                <th>Dari <span class="help">(Date)</span></th>
                                <th>Sampai <span class="help">(Date)</span></th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($schedule as $sched)
                            <tr>
                                <td>{{ $sched->id_no }}</td>
                                <td>{{ $sched->employee }}</td>
                                <td>{{ $sched->in_time }} - {{ $sched->out_time }}</td>
                                <td>{{ $sched->hours }} hours</td>
                                <td>{{ $sched->restday }}</td>
                                <td>@php echo e(date('D, M d, Y', strtotime($sched->date_from))) @endphp</td>
                                <td>@php echo e(date('D, M d, Y', strtotime($sched->date_to))) @endphp</td>
                                <td>
                                    @if($sched->archive == '0') 
                                        <span class="green">Present</span>
                                    @else
                                        <span class="teal">Previous</span>
                                    @endif
                                </td>
                                <td class="align-right">
                                     
                                     <form class="form-horizontal" method="POST" action="{{url('admin/'.$title.'/'.$sched->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                      @if($sched->archive == '0')
                                     <a href="{{ url('/admin/jadwal/edit/'.$sched->id) }}" class="ui circular basic icon button tiny"><i class="icon edit outline"></i></a>
                                    <button class=" ui circular basic icon button tiny js-submit-confirm">
                                        <i class="icon trash alternate outline"></i>
                                    </button>
                                     <a href="{{ url('/schedules/archive/'.$sched->id) }}" class="ui circular basic icon button tiny"><i class="icon archive"></i></a>
                                      @else
                                         <button class=" ui circular basic icon button tiny js-submit-confirm">
                                        <i class="icon trash alternate outline"></i>
                                    </button>
                                    @endif
                                </form>
                                  
                                                                           
                                       
                                   
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
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
        $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,sorting: false,});
    });

    $('.jtimepicker').mdtimepicker({ format: 'h:mm:ss tt', hourPadding: true });
    $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });

    $('.ui.dropdown.getid').dropdown({ onChange: function(value, text, $selectedItem) {
        $('select[name="employee"] option').each(function() {
            if($(this).val()==value) {var id = $(this).attr('data-id');$('input[name="id"]').val(id);};
        });
    }});

    </script>
    @endsection 