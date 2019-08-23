@extends('admin.layouts.app')
@section('meta')
<title>Tipe Cuti| Sistem Absensi</title>
<meta name="description" content="smart timesheet leave type, view leave types, add or edit leave types and export or download leave types.">
@endsection

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Tambah Tipe Cuti
                <a href="{{ url('admin/group-cuti') }}" class="ui primary mini button offsettop5 float-right"><i class="icon calendar check outline"></i>Group Cuti</a>
                <button class="ui basic button mini offsettop5 btn-import float-right"><i class="ui icon upload"></i>Import</button>
                <a href="{{ url('export/fields/leavetypes' )}}" class="ui basic button mini offsettop5 btm-export float-right"><i class="ui icon download"></i>Export</a>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-body">
                    <form id="add_leavetype_form" action="{{ url('admin/jenis-cuti/store') }}" class="ui form" method="post"
                    accept-charset="utf-8">
                    {{ csrf_field() }}
                    <div class="field">
                        <label>Nama Cuti <span class="help">e.g. "Cuti Liburan, Cuti Sakit"</span></label>
                        <input class="uppercase" name="leave_type" value="" type="text">
                    </div>
                    <div class="field">
                        <label>Batas <span class="help">e.g. 15 Hari</span></label>
                        <input class="" name="limit" value="" type="text">
                    </div>
                    <div class="grouped fields opt-radio">
                        <label class="">Waktu</label>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="per_calendar" value="Bulanan" checked="checked">
                                <label>Bulan</label>
                            </div>
                        </div>
                        <div class="field" style="padding:0px!important">
                            <div class="ui radio checkbox">
                                <input type="radio" name="per_calendar" value="Tahunan">
                                <label>Tahun</label>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui error message">
                            <i class="close icon"></i>
                            <div class="header"></div>
                            <ul class="list">
                                <li class=""></li>
                            </ul>
                        </div>
                    </div>
                    <div class="actions">
                        <button type="submit" class="ui positive button small"><i class="ui icon check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-success">
            <div class="box-body">
                <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Deskripsi</th>
                            <th>Batas</th>
                            <th>Waktu</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leavetype as $dt)
                        <tr>
                            <td>{{ $dt->leave_type }}</td>
                            <td>{{ $dt->limit }}</td>
                            <td>{{ $dt->per_calendar }}</td>
                            <td class="align-right">
                                <form class="form-horizontal" method="POST" action="{{url('admin/'.$title.'/'.$dt->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class=" ui circular basic icon button tiny js-submit-confirm">
                                        <i class="icon trash alternate outline"></i>
                                    </button>
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
</div>

@endsection

@section('scripts')
<!-- DataTables JavaScript -->
<script src="{{ asset('/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true,
            searching: true,
            ordering: true,
            info: true,
            bLengthChange: false,
        });
    });

    function validateFile() {
        var f = document.getElementById("csvfile").value;
        var d = f.lastIndexOf(".") + 1;
        var ext = f.substr(d, f.length).toLowerCase();
        if (ext == "csv") {} else {
            document.getElementById("csvfile").value = "";
            $.notify({
                icon: 'ui icon times',
                message: "Please upload only CSV file format."
            }, {
                type: 'danger',
                timer: 400
            });
        }
    }
</script>

@endsection