@extends('admin.layouts.app')
     @section('title', 'Data Cuti')

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">DAFTAR CUTI</h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>Karyawan</th>
                                <th>Deskripsi</th>
                                <th>Cuti Dari</th>
                                <th>Cuti Sampai</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($employeleave)
                            @foreach ($employeleave as $data)
                            <tr>
                                <td>{{ $data->id_no }}</td>
                                <td>{{ $data->employee }}</td>
                                <td>{{ $data->type }}</td>
                                <td>@php echo e(date('D, M d, Y', strtotime($data->leave_from))) @endphp</td>
                                <td>@php echo e(date('D, M d, Y', strtotime($data->leave_to))) @endphp</td>
                                <td>@php echo e(date('M d, Y', strtotime($data->return_date))) @endphp</td>
                                <td><span class="">{{ $data->status }}</span></td>
                                <td class="align-right">
                                    <form class="form-horizontal" method="POST" action="{{url('admin/'.$title.'/'.$data->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                     <a href="{{ url('/admin/cuti/edit/'.$data->id) }}" class="ui circular basic icon button tiny"><i class="edit outline icon"></i></a>
                                    <button class=" ui circular basic icon button tiny js-submit-confirm">
                                        <i class="icon trash alternate outline"></i>
                                    </button>
                                </form>
                                
                                    @isset($data->comment)
                                        <button class="ui circular basic icon button tiny uppercase" data-tooltip='{{ $data->comment }}' data-variation='wide' data-position='top right'><i class="ui icon comment alternate"></i></button>
                                    @endisset
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
        $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,});        
    });
    </script>

    @endsection