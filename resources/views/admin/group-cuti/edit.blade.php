@extends('admin.layouts.app')
    @section('title','Cuti')
  

    @section('content')

    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Edit Group Cuti</h2>
        </div>    
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">
                <form id="edit_leavegroup_form" action="{{url('admin/group-cuti/edit')}}" class="ui form" method="post" accept-charset="utf-8">
                {{ csrf_field() }}
                    <div class="field">
                        <label>Nama Group Cuti</label>
                        <input type="text" name="leave_group" value="{{$lg->leave_group}}" class="uppercase" placeholder="Enter Leave Group Name">
                    </div>
                    <div class="field">
                        <label>Deskripsi</label>
                        <input type="text" name="description" value="{{$lg->description}}" class="uppercase" placeholder="Enter Description for Leave Group">
                    </div>
                    <div class="field">
                        <label>Sebab Cuti</label>
                        <select class="ui search dropdown selection multiple leaves uppercase" name="leave_privileges[]" multiple="">
                            <option value="">Pilih Sebab Cuti</option>
                           
                                @foreach($lt as $leave) 
                                    <option value="{{ $leave->id }}">{{ $leave->leave_type }}</option>
                                @endforeach
                            
                        </select>
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select class="ui dropdown uppercase" name="status">
                            <option value="">Select Status</option>
                            <option value="1"  @if($lg->status == 1) selected @endif >Active</option>
                            <option value="0"  @if($lg->status == 0) selected @endif >Disabled</option>
                        </select>
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
                </div>
                <div class="box-footer">
                    <input type="hidden" name="id" value="{{$lg->id}}">
                    <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Update</button>
                    <a href="{{ url('admin/group-cuti') }}" class="ui black grey small button"><i class="ui times icon"></i> Cancel</a>
                </div>
                </form>
                
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script>
        var selected = "{{$lg->leave_privileges}}";
        var items = selected.split(',');
        $('.ui.dropdown.multiple.leaves').dropdown('set selected', items);
    </script>
    @endsection