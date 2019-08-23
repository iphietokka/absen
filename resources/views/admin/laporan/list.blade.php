@extends('admin.layouts.app')
    @section('meta')
    <title>Laporan Daftar Karyawan| Sistem Absensi</title>
    <meta name="description" content="smart timesheet reports, view reports, and export or download reports.">
    @endsection

    @section('content')
    
    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">Laporan Daftar Karyawan
                <a href="{{ url('admin/export/karyawan') }}" class="ui basic button mini offsettop5 btn-export float-right"><i class="ui icon download"></i>Export to CSV</a>
                <a href="{{ url('reports') }}" class="ui basic blue button mini offsettop5 float-right"><i class="ui icon chevron left"></i>Kembali</a>
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Karyawan</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Nikah</th>
                       
                                <th>E-mail</th>
                                <th>Jenis Kerja</th>
                                <th>Status Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($empList)
                            @foreach ($empList as $et)
                                <tr>
                                    <td>{{ $et->id }}</td>
                                    <td>{{ $et->last_name }}, {{ $et->first_name }}</td>
                                    <td>{{ $et->age }}</td>
                                    <td>{{ $et->gender }}</td>
                                    <td>{{ $et->civil_status }}</td>
                                    <td>{{ $et->email }}</td>
                                    <td>{{ $et->employment_type }}</td>
                                    <td>{{ $et->employment_status }}</td>
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
        $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,});
    });
    </script>
    @endsection 