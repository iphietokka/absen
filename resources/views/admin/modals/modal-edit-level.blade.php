<div class="ui modal small edit">
    <div class="header">Edit Role</div>
    <div class="content">
    <form id="edit_role_form" action="{{ url('admin/level/update') }}" class="ui form" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
        <div class="field">
            <label>Nama Level</label>
            <input class="uppercase" name="name" value="" type="text">
        </div>
        <div class="field">
            <label>Deskripsi</label>
            <input name="desc" value="" type="text">
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
        <input type="hidden" value="" name="id" class="" readonly="">
        <button class="ui positive small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Update</button>
        <button class="ui grey cancel small button" type="button"><i class="ui times icon"></i> Cancel</button>
    </div>
    </form>  
</div>
