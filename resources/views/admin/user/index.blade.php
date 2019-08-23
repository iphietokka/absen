@extends('admin.layouts.app')
@section('meta')
<title>Data Users | Sistem Absensi</title>
<meta name="description" content="smart timesheet users, view all users, add, edit, delete users.">
@endsection 

@section('content')
@include('admin.modals.modal-add-user')

<div class="container-fluid">
    <div class="row">
        <h2 class="page-title">Data Users
            <button class="ui positive button mini offsettop5 btn-add float-right"><i class="ui icon plus"></i>Add</button>
            <a href="{{ url('admin/role') }}" class="ui blue button mini offsettop5 float-right"><i class="ui icon user"></i>Role</a>
             <a href="{{ url('admin/level') }}" class="ui blue button mini offsettop5 float-right"><i class="ui icon user"></i>Level</a>
        </h2>
    </div>

    <div class="row">
        <div class="box box-success">
            <div class="box-body">
                <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($data)
                        @foreach ($data as $dt)
                        <tr>
                            <td>{{$dt->username}}</td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->email }}</td>
                            <td>{{ $dt->roles->name }}</td>
                            <td>{{ $dt->levels->name }} </td>
                            <td>
                                <span>
                                    @if($dt->status == '1') 
                                    Aktif
                                    @else
                                    Non-Aktif
                                    @endif
                                </span>
                            </td>
                            <td class="align-right">
                                <form class="form-horizontal" method="POST" action="{{url('admin/'.$title.'/'.$dt->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <input name="_method" type="hidden" value="DELETE">
                                    <a href="{{ url('/admin/user/edit/'.$dt->id) }}" class="ui circular basic icon button tiny"><i class="icon edit outline"></i></a>

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

    $('.ui.dropdown.getemail').dropdown({ onChange: function(value, text, $selectedItem) {
        $('select[name="name"] option').each(function() {
            if($(this).val()==value) {var e = $(this).attr('data-e');var r = $(this).attr('data-ref');$('input[name="email"]').val(e);$('input[name="ref"]').val(r);};
        });
    }});

</script>
@endsection