@extends('admin.layouts.app')
    @section('title', 'Data Cuti')

    @section('content')

    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Edit Data Cuti</h2>
        </div>    
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">
                <form id="edit_leave_form" action="{{ url('admin/cuti/edit') }}" class="ui form" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}
                    <div class="field">
                        <label>Karyawan</label>
                        <input type="text" class="readonly" readonly="" value="{{ $l->employee }}">
                    </div>
                    <div class="field">
                        <label>Sebab Cuti</label>
                        <input type="text" class="readonly" readonly="" value="{{ $l->type }}">
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label for="">Mulai</label>
                            <input type="text" class="readonly" readonly="" value="{{ $l->leave_from }}"/>
                            
                        </div>
                        <div class="field">
                            <label for="">Selesai</label>
                            <input type="text" class="readonly" readonly="" value="{{ $l->leave_to }}"/>
                        </div>
                    </div>
                    <div class="field">
                        <label for="">Tanggal Kembali</label>
                        <input id="returndate" type="text" class="readonly" readonly="" value="{{ $l->return_date }}"/>
                    </div>
                    <div class="field">
                        <label>Alasan</label>
                        <textarea class="uppercase readonly" readonly="" rows="5">{{ $l->reason }}</textarea>
                    </div>
                    <div class="field">
                        <p class="ui horizontal divider tiny sub header">Hak Akses Manager</p>
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select class="ui dropdown uppercase" name="status">
                            <option value="Approved"@if($l->status == 'Approved') selected @endif>Approved</option>
                            <option value="Pending" @if($l->status == 'Pending') selected @endif>Pending</option>
                            <option value="Declined" @if($l->status == 'Declined') selected @endif>Declined</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Tambah Komentar <span class="help">(OPTIONAL)</span></label>
                        <textarea name="comment" class="uppercase" rows="5">{{ $l->comment }}</textarea>
                    </div>
                    <div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header"></div>
                        <ul class="list">
                            <li class=""></li>
                        </ul>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" class="readonly" readonly="" name="id" value="{{ $l->id }}">
                    <button class="ui positive small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Update</button>
                    <a href="{{ url('leaves') }}" class="ui black grey small button"><i class="ui times icon"></i> Cancel</a>
                </div>
                </form>
                
                </div>
            </div>
        </div>
    </div>

    @endsection
