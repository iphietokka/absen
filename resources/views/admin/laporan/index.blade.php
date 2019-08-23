@extends('admin.layouts.app')
    @section('meta')
    <title>Laporan | Sistem Absensi</title>
    <meta name="description" content="smart timesheet reports, view reports, and export or download reports.">
    @endsection 

    @section('content')
    
    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">Laporan</h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                <table width="100%" class="reports-table table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Report name</th>
                            <th class="odd">Last Viewed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="{{ url('admin/laporan/list') }}"><i class="ui icon users"></i> Laporan Daftar Karyawan</a></td>
                            <td class="odd">
                                @isset($lastviews)
                                @foreach ($lastviews as $views)
                                    @if($views->report_id == 1)
                                       {{ $views->last_viewed }}
                                    @endif
                                @endforeach
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><a href="{{ url('admin/laporan/absen') }}"><i class="ui icon clock"></i> Laporan Data Absensi</a></td>
                            <td class="odd">
                                @isset($lastviews)
                                @foreach ($lastviews as $views)
                                    @if($views->report_id == 2)
                                       {{ $views->last_viewed }}
                                    @endif
                                @endforeach
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><a href="{{ url('admin/laporan/cuti') }}"><i class="ui icon calendar plus"></i> Laporan Data Cuti</a></td>
                            <td class="odd">
                                @isset($lastviews)
                                @foreach ($lastviews as $views)
                                    @if($views->report_id == 3)
                                       {{ $views->last_viewed }}
                                    @endif
                                @endforeach
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><a href="{{ url('admin/laporan/jadwal') }}"><i class="ui icon calendar alternate outline"></i> Laporan Data Jadwal</a></td>
                            <td class="odd">
                                @isset($lastviews)
                                @foreach ($lastviews as $views)
                                    @if($views->report_id == 4)
                                       {{ $views->last_viewed }}
                                    @endif
                                @endforeach
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><a href="{{ url('reports/organization-profile') }}"><i class="ui icon chart pie"></i> Organization Profile</a></td>
                            <td class="odd">
                                @isset($lastviews)
                                @foreach ($lastviews as $views)
                                    @if($views->report_id == 5)
                                       {{ $views->last_viewed }}
                                    @endif
                                @endforeach
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><a href="{{ url('reports/employee-birthdays') }}"><i class="ui icon birthday cake"></i> Employee Birthdays</a></td>
                            <td class="odd">
                                @isset($lastviews)
                                @foreach ($lastviews as $views)
                                    @if($views->report_id == 7)
                                       {{ $views->last_viewed }}
                                    @endif
                                @endforeach
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><a href="{{ url('reports/user-accounts') }}"><i class="ui icon address book outline"></i> User Accounts Report</a></td>
                            <td class="odd">
                                @isset($lastviews)
                                @foreach ($lastviews as $views)
                                    @if($views->report_id == 6)
                                       {{ $views->last_viewed }}
                                    @endif
                                @endforeach
                                @endisset
                            </td>
                        </tr>

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
        $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,sorting: false,});
    });
    </script>
    @endsection 