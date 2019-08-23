<div class="ui modal medium add">
    <div class="header">Tambah Data</div>
    <div class="content">
        <form id="add_leavegroup_form" action="{{ url('admin/group-cuti/store') }}" class="ui form" method="post" accept-charset="utf-8">
            {{ csrf_field() }}
            <div class="field">
                <label>Nama Group Cuti</label>
                <input type="text" name="leave_group" value="" class="uppercase" placeholder="Enter Leave Group Name">
            </div>
            <div class="field">
                <label>Deskripsi</label>
                <input type="text" name="description" value="" class="uppercase" placeholder="Enter Description for Leave Group">
            </div>
            <div class="field">
                <label>Sebab Cuti</label>
                <select class="ui search dropdown selection multiple uppercase" name="leave_privileges[]" multiple="">
                    <option value="">Pilih Sebab Cuti</option>

                    @foreach($leavetype as $leave)
                    <option value="{{ $leave->id }}">{{ $leave->leave_type }}</option>
                    @endforeach

                </select>
            </div>
            <div class="field">
                <label>Status</label>
                <select class="ui dropdown uppercase" name="status">
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Disabled</option>
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
        <div class="actions">
            <button class="ui positive small button approve" type="submit" name="submit"><i class="ui checkmark icon"></i>
            Save</button>
            <button class="ui grey small button cancel" type="button"><i class="ui times icon"></i> Cancel</button>
        </div>
    </form>
</div>