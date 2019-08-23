<div class="ui modal medium edit">
    <div class="header">Edit Data</div>
    <div class="content">
                <form id="edit_leavegroup_form" action="{{url('admin/group-cuti/edit')}}" class="ui form" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}
                    <div class="field">
                        <label>Nama Group Cuti</label>
                        <input type="text" name="leave_group" value="{{$lg->leave_group}}" class="uppercase" placeholder="Enter Leave Group Name">
                    </div>
                    <div class="field">
                        <label>Dekripsi</label>
                        <input type="text" name="description" value="{{$lg->description}}" class="uppercase" placeholder="Enter Description for Leave Group">
                    </div>
                    <div class="field">
                        <label>Sebab Cuti</label>
                        <select class="ui search dropdown selection multiple leaves uppercase" name="leave_privileges[]" multiple="">
                           <option selected value="">Pilih Sebab Cuti</option>
                           
                                @foreach($leavetype as $leave) 
                                    <option value="{{ $leave->id }}">{{ $leave->leave_type }}</option>
                                @endforeach
                          
                        </select>
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select class="ui dropdown uppercase" name="status">
                            <option value="">Select Status</option>
                            <option value="1" @isset($lg) @if($lg->status == 1) selected @endif @endisset>Active</option>
                            <option value="0" @isset($lg) @if($lg->status == 0) selected @endif @endisset>Disabled</option>
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
                    <input type="hidden" name="id" value="@isset($lg){{$lg->id}}@endisset">
                    <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Update</button>
                    <a href="" class="ui black grey small button"><i class="ui times icon"></i> Cancel</a>
                </div>
                </form>
                
                </div>
            </div>
        </div>
    </div>

 

    @section('scripts')
    <script>
        var selected = "{{$lg->leave_privileges}}";
        var items = selected.split(',');
        $('.ui.dropdown.multiple.leaves').dropdown('set selected', items);
    </script>
    @endsection