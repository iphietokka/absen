@extends('admin.layouts.app')
    @section('title','Cuti')

@section('content')
@include('admin.modals.modal-add-leavegroup')


<div class="container-fluid">
    <div class="row">
        <h2 class="page-title">Group Cuti
            <button class="ui positive mini button offsettop5 btn-add float-right"><i class="ui icon plus"></i>Tambah</button>
            <a href="{{ url('admin/jenis-cuti') }}" class="ui basic mini button offsettop5 float-right"><i class="icon angle left"></i>Kembali</a>
        </h2>
    </div>
    <div class="row">
        <div class="box box-success">
            <div class="box-body">
                <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Group Cuti</th>
                            <th>Deskripsi</th>
                            <th>Sebab Cuti</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leavegroup as $lg)
                        <tr>
                            <td>{{ $lg->leave_group }}</td>
                            <td>{{ $lg->description }}</td>
                            <td>
                                @foreach($leavetype as $ln) 
                                @php
                                $lgroup = explode(",",$lg->leave_privileges);
                                foreach ($lgroup as $v) {
                                if($v == $ln->id){
                                echo $ln->leave_type.", ";
                            }
                        }
                        @endphp
                        @endforeach
                    </td>
                    <td>@if($lg->status == 1) Active @else Disabled @endif</td>
                    <td class="align-right">
                             <form class="form-horizontal" method="POST" action="{{url('admin/'.$title.'/'.$lg->id) }}" enctype="multipart/form-data">
              {{ csrf_field() }}

                <input name="_method" type="hidden" value="DELETE">
                                   <a href="{{ url('admin/group-cuti/edit/'.$lg->id) }}" class="ui circular basic icon button tiny"><i class="icon edit outline"></i></a>
                                 
                <button class=" ui circular basic icon button tiny js-submit-confirm">
               <i class="icon trash alternate outline"></i>
              </button>
            </form>

            @include('admin.modals.modal-edit-leavegroup')
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,});        
    });

     $('.btn-edit').click(function(event) {
        var id = $(this).attr('data-id');
        var url = $("#_url").val();
        $.ajax({
             url : '{{url('admin/role/getData')}}',type: 'get',dataType: 'json',data: {id: id},headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                $status = response['status'];
                $('.edit input[name="id"]').val(response['id']);
                $('.edit input[name="name"]').val(response['name']);
                if ($status == 'Active') {
                    $('.ui.dropdown.status').dropdown({values: [{name: 'Active',value: 'Active', selected : true},{name: 'Disabled',value: 'Disabled'}]});
                } else if($status == 'Disabled') {
                    $('.ui.dropdown.status').dropdown({values: [{name: 'Active',value: 'Active'},{name: 'Disabled',value: 'Disabled', selected : true}]});
                } 
                $('ui.modal.edit').modal('show');
            }
        })
    });
</script>

@endsection