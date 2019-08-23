@extends('admin.layouts.app')
@section('meta')
<title>Karyawan | Sistem Absensi</title>
<meta name="description" content="smart timesheet employees, view all employees, add, edit, delete, and archive employees.">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <h2 class="page-title">Karyawan
            <a class="ui positive button mini offsettop5 float-right" href="{{ url('admin/karyawan/create') }}"><i class="ui icon plus"></i>Tambah</a>
        </h2>
    </div>

    <div class="row">
        <div class="box box-success">
            <div class="box-body">
                <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ID #</th> 
                            <th>Karyawan</th> 
                            <th>Perusahaan</th>
                            <th>Departemen</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($data)
                        @foreach ($data as $employee)
                        <tr class="">
                            <td>{{ $employee->id_no }}</td>
                            <td>{{ $employee->last_name }}, {{ $employee->first_name }}</td>
                            <td>{{ $employee->company }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>{{ $employee->job_position }}</td>
                            <td>
                                @if($employee->employment_status == 'Active') Active @else Archived @endif
                            </td>
                            <td class="align-right">
                                <form class="form-horizontal" method="POST" action="{{url('admin/'.$title.'/'.$employee->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a href="{{ url('admin/karyawan/profile/'.$employee->reference) }}" class="ui circular basic icon button tiny"><i class="file alternate outline icon"></i></a>
                                    <a href="{{ url('/admin/karyawan/edit/'.$employee->reference) }}" class="ui circular basic icon button tiny"><i class="edit outline icon"></i></a>

                                    <a href="{{ url('/admin/karyawan/archive/'.$employee->reference) }}" class="ui circular basic icon button tiny"><i class="archive icon"></i></a>
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
        $('#dataTables-example').DataTable({responsive: true,pageLength: 10,lengthChange: false,searching: true,sorting: false,});
    });
</script>
@endsection