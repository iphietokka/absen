@extends('admin.layouts.app')
    @section('meta')
    <title>Level User| Sistem Absensi</title>
    <meta name="description" content="smart timesheet roles, view all employee roles, add roles, edit roles, and delete roles.">
    @endsection
    
    @section('content')
    @include('admin.modals.modal-add-level')
    @include('admin.modals.modal-edit-level')

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">Level User
                <button class="ui positive button mini offsettop5 btn-add float-right"><i class="ui icon plus"></i>Tambah</button>
                <a href="{{ url('admin/user') }}" class="ui basic blue button mini offsettop5 float-right"><i class="ui icon chevron left"></i>Kembali</a>
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($data)
                            @foreach ($data as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->desc }}</td>
                                <td class="align-right">
                                 <form class="form-horizontal" method="POST" action="{{url('admin/'.$title.'/'.$role->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="button" class="ui circular basic icon button tiny btn-edit" data-id="{{ $role->id }}"><i class="icon edit outline"></i></button>
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
        $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,});
    });
    
    $('.btn-edit').click(function(event) {
        var id = $(this).attr('data-id');
        var url = $("#_url").val();
        $.ajax({
             url : '{{url('admin/level/getData')}}',type: 'get',dataType: 'json',data: {id: id},headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
               
                $('.edit input[name="id"]').val(response['id']);
                $('.edit input[name="name"]').val(response['name']);
                $('.edit input[name="desc"]').val(response['desc']);

                $('ui.modal.edit').modal('show');
            }
        })
    });
    </script>
    
    @endsection