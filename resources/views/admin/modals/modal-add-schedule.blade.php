<div class="ui modal add medium">
    <div class="header">Tambah Jadwal Baru</div>
    <div class="content">
        <form id="add_schedule_form" action="{{ url('admin/jadwal/store') }}" class="ui form" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
            <div class="field">
                <label>Karyawan</label>
                <select class="ui search dropdown getid uppercase" name="employee">
                    <option value="">Pilih Karyawan</option>
                  
                    @foreach ($employee as $data)
                        <option value="{{ $data->last_name }}, {{ $data->first_name }}" data-id="{{ $data->id }}">{{ $data->last_name }}, {{ $data->first_name }}</option>
                    @endforeach
                  
                </select>
            </div>

            <div class="two fields">
                <div class="field">
                    <label for="">Waktu Masuk</label>
                    <input type="text" placeholder="00:00:00 AM" name="in_time" class="jtimepicker" />
                </div>
                <div class="field">
                    <label for="">Waktu Pulang</label>
                    <input type="text" placeholder="00:00:00 PM" name="out_time" class="jtimepicker" />
                </div>
            </div>

            <div class="field">
                <label for="">Dari</label>
                <input type="text" placeholder="Date" name="date_from" id="datefrom" class="airdatepicker" />
            </div>
            <div class="field">
                <label for="">Sampai</label>
                <input type="text" placeholder="Date" name="date_to" id="dateto" class="airdatepicker" />
            </div>

            <div class="eight wide field">
                <label for="">Total Jam</label>
                <input type="number" placeholder="0" name="hours" />
            </div>

           <div class="grouped fields field">
                <label>Pilih Hari Libur</label>
                <div class="field">
                <div class="ui checkbox sunday">
                    <input type="checkbox" name="restday[]" value="Minggu">
                    <label>Minggu</label>
                </div>
                </div>
                <div class="field">
                <div class="ui checkbox ">
                    <input type="checkbox" name="restday[]" value="Senin">
                    <label>Senin</label>
                </div>
                </div>
                <div class="field">
                <div class="ui checkbox ">
                    <input type="checkbox" name="restday[]" value="Selasa">
                    <label>Selasa</label>
                </div>
                </div>
                <div class="field">
                <div class="ui checkbox ">
                    <input type="checkbox" name="restday[]" value="Rabu">
                    <label>Rabu</label>
                </div>
                </div>
                <div class="field">
                <div class="ui checkbox ">
                    <input type="checkbox" name="restday[]" value="Kamis">
                    <label>Kamis</label>
                </div>
                </div>
                <div class="field">
                <div class="ui checkbox ">
                    <input type="checkbox" name="restday[]" value="Jumat">
                    <label>Jumat</label>
                </div>
                </div>
                <div class="field" style="padding:0">
                <div class="ui checkbox saturday">
                    <input type="checkbox" name="restday[]" value="Sabtu">
                    <label>Sabtu</label>
                </div>
                </div>
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
            <input type="hidden" name="id" value="">
            <button class="ui positive small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Save</button>
            <button class="ui grey small button cancel" type="button"><i class="ui times icon"></i> Cancel</button>
        </div>
        </form>  
</div>
