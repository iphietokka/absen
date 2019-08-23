@extends('admin.layouts.app')

@section('meta')
<title>Edit Data User | Sistem Absensi</title>
<meta name="description" content="smart timesheet edit user.">
@endsection 

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Edit User</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">

                    <form id="edit_user_form" action="{{ url('admin/user/edit') }}" class="ui form add-user" method="post"
                        accept-charset="utf-8">
                        {{ csrf_field() }}
                         <div class="field">
                            <label>Username</label>
                            <input type="text" name="username" value="{{ $u->username }}" class="uppercase">
                        </div>
                        <div class="field">
                            <label>Karyawan</label>
                            <input type="text" name="employee" value="@isset($u->name){{ $u->name }}@endisset" class="readonly uppercase"
                                readonly>
                        </div>
                        <div class="field">
                            <label>Email</label>
                            <input type="text" name="email" value="@isset($u->email){{ $u->email }}@endisset" class="readonly lowercase"
                                readonly>
                        </div>
                        <div class="sixteen wide field role">
                <label>Level </label>
                <select class="ui dropdown uppercase" name="level_id">
                        <option value="{{$u->level_id}}">{{$u->levels->name}}</option>
                       
                        @foreach ($level as $key=>$levels)
                        <option value="{{ $key }}">{{ $levels }}</option>
                        @endforeach
                     
                    </select>
            </div>
                         <div class="fields">
                            <div class="sixteen wide field role">
                                <label for="">Role</label>
                                <select class="ui dropdown uppercase" name="role_id">
                                    <option value="{{$u->role_id}}">{{$u->roles->name}}</option>
                                  
                                    @foreach ($r as $key=>$roles)
                                    <option value="{{ $key}}">{{
                                        $roles }}</option>
                                    @endforeach
                                 
                                </select>
                            </div>
                        </div>
                        <div class="field">
                            <label>Status</label>
                            <select class="ui dropdown uppercase" name="status">
                                <option value="">Select Status</option>
                                <option value="1" @isset($u->status) @if($u->status == 1) selected @endif
                                    @endisset>Enabled</option>
                                <option value="0" @isset($u->status) @if($u->status == 0) selected @endif
                                    @endisset>Disabled</option>
                            </select>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label for="">New Password</label>
                                <input type="password" name="password" class="" placeholder="********">
                            </div>
                            <div class="field">
                                <label for="">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="" placeholder="********">
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

                <div class="box-footer">
                    <input type="hidden" value="@isset($u->reference){{ $u->reference }}@endisset" name="ref">
                    <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i>
                        Update</button>
                    <a href="{{ url('users') }}" class="ui black grey small button"><i class="ui times icon"></i>
                        Cancel</a>
                </div>

                </form>

            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.opt-radio .checkbox').first().checkbox({
                ischecked: function () {
                    $('.role, .role .ui.dropdown').addClass('disabled');
                    $('select[name="role_id"]').addClass('disabled').val('');
                }
            });
        });
    </script>
    @endsection