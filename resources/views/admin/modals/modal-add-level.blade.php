<div class="ui add modal small">
    <div class="header">Tambah Level Baru</div>
    <div class="content">
    <form id="add_role_form" action="{{ url('admin/level/store') }}" class="ui form" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
        <div class="field">
            <label>Nama Level</label>
            <input class="uppercase" name="name" value="" type="text">
        </div>
        <div class="field">
            <label>Deskripsi</label>
            <input class="uppercase" name="desc" value="" type="text">
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
        <button class="ui positive small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Save</button>
        <button class="ui grey cancel small button" type="button"><i class="ui times icon"></i> Cancel</button>
    </div>
    </form>  
</div>
