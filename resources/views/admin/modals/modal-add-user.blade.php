<div class="ui modal medium add">
    <div class="header">Tambah User Baru</div>
    <div class="content">
        <form id="add_user_form" action="{{ url('admin/user/store') }}" class="ui form add-user" method="post"
            accept-charset="utf-8">
            {{ csrf_field() }}
             <div class="field">
                <label>Username</label>
                <input type="text" name="username" class="lowercase" value="">
            </div>
            <div class="field">
                <label>Karyawan</label>
                <select class="ui search dropdown getemail uppercase" name="name">
                    <option value="">Select Employee</option>
                
                    @foreach ($employees as $data)
                    <option value="{{ $data->last_name }}, {{ $data->first_name }}" data-e="{{$data->email }}"
                        data-ref="{{ $data->id }}">{{ $data->last_name }}, {{ $data->first_name }}</option>
                    @endforeach
                  
                </select>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" name="email" class="readonly lowercase" value="" readonly>
            </div>
             <div class="sixteen wide field role">
                <label>Level </label>
                <select class="ui dropdown uppercase" name="level_id">
                        <option value="">Select Level</option>
                       
                        @foreach ($level as $key=>$levels)
                        <option value="{{ $key }}">{{ $levels }}</option>
                        @endforeach
                     
                    </select>
            </div>
            <div class="fields">
                <div class="sixteen wide field role">
                    <label for="">Role</label>
                    <select class="ui dropdown uppercase" name="role_id">
                        <option value="">Select Role</option>
                       
                        @foreach ($role as $key=>$roles)
                        <option value="{{ $key }}">{{ $roles }}</option>
                        @endforeach
                     
                    </select>
                </div>
            </div>
            <div class="fields">
                <div class="sixteen wide field">
                    <label>Status</label>
                    <select class="ui dropdown uppercase" name="status">
                        <option value="">Select Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label for="">Password</label>
                    <input type="password" name="password" class="">
                </div>
                <div class="field">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="">
                </div>
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
        <input type="hidden" value="" name="ref">
        <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i>
            Tambah</button>
        <button class="ui grey cancel small button" type="button"><i class="ui times icon"></i> Cancel</button>
    </div>
    </form>
</div>
 @section('scripts')
    <script type="text/javascript">
 

    $('.ui.dropdown.getemail').dropdown({ onChange: function(value, text, $selectedItem) {
        $('select[name="name"] option').each(function() {
            if($(this).val()==value) {var e = $(this).attr('data-e');var r = $(this).attr('data-ref');$('input[name="email"]').val(e);$('input[name="ref"]').val(r);};
        });
    }});
    
    </script>
    @endsection