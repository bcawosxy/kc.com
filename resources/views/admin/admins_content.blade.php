@extends('admin.layout.master')

@section('content')
    <style>
        dd.tags{
            margin-bottom: 10px;
        }
    </style>

    <div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>管理員設定</h2></div>
        <ol class="breadcrumb">
            <li><a href="{{ url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url()->route('admin::admins')}}"> 管理員設定</a></li>
            <li class="active">{{ $data['admins'] or ''}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="box-body box-solid">
                            <div class="box-header with-border">
                                <i class="fa fa-file-text-o"></i>
                                <h3 class="box-title"> <?php echo ($data['act'] == 'add') ? '新增管理員' : '編輯管理員 ： <span style="color:#3c8dbc;font-weight:bold">'.$data['admin']['name'] ?></span> </h3>
                            </div>
                            <div class="box-body">
                                <dl class="dl-horizontal">
                                    <dt>編號:</dt>
                                    <dd># {{$data['admin']['id'] or ''}}</dd>
                                    <br>
                                    <dt>帳號:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="account" placeholder="管理員帳號" value="{{$data['admin']['account'] or ""}}">
                                    </dd>
                                    <br>
                                    <div <?php if($data['act'] == 'edit') echo 'style="display:none;"' ?> >
                                        <dt>密碼:</dt>
                                        <dd>
                                            <input type="password" class="form-control" name="password" placeholder="管理員密碼">
                                        </dd>
                                        <br>
                                        <dt>再次輸入密碼:</dt>
                                        <dd>
                                            <input type="password" class="form-control" name="re_password" placeholder="再次輸入密碼">
                                        </dd>
                                        <br>
                                    </div>
                                    <dt>管理員名稱:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="name" placeholder="管理員名稱" value="{{$data['admin']['name'] or ""}}">
                                    </dd>
                                    <br>
                                    <dt>Email:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="email" placeholder="管理員Email" value="{{$data['admin']['email'] or ""}}">
                                    </dd>
                                    <br>
                                    <div <?php if($data['act'] == 'add') echo 'style="display:none;"' ?> >
                                        <dt>新增時間:</dt>
                                        <dd>
                                            <p class="text-muted">{{ $data['admin']['created_at'] or '' }}</p>
                                        </dd>
                                        <dt>修改時間:</dt>
                                        <dd>
                                            <p class="text-muted">{{ $data['admin']['updated_at'] or '' }}</p>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" <?php if($data['user']->id != $data['admin']['id']) echo 'style="display:none;' ?>>
                    <div class="col-md-10">
                        <div class="box-body box-solid">
                            <div class="box-header with-border">
                                <i class="fa fa-file-text-o"></i>
                                <h3 class="box-title"> 修改密碼 </h3>
                            </div>
                            <div class="box-body" >
                                <dl class="dl-horizontal">
                                    <dt>舊密碼:</dt>
                                    <dd>
                                        <input type="password" class="form-control" name="old_password" placeholder="舊密碼">
                                    </dd>
                                    <br>
                                    <dt>密碼:</dt>
                                    <dd>
                                        <input type="password" class="form-control" name="edit_password" placeholder="管理員密碼">
                                    </dd>
                                    <br>
                                    <dt>再次輸入密碼:</dt>
                                    <dd>
                                        <input type="password" class="form-control" name="edit_re_password" placeholder="再次輸入密碼">
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <a class="btn btn-app" id="edit">
                            <i class="fa fa-edit"></i> 修改密碼
                        </a>
                    <hr>
                    </div>
                </div>
                <a class="btn btn-app" href="{{url()->route('admin::admins')}}">
                    <i class="fa fa-angle-double-left"></i> 上一頁
                </a>
                <a class="btn btn-app" id="save">
                    <i class="fa fa-save"></i> 儲存(Save)
                </a>
				<?php
                if($data['act'] =='edit' && ($data['user']->id == $data['admin']['id']) ) echo '<a class="btn btn-app" id="delete"><i class="fa fa-trash-o"></i> 刪除(Delete)</a>';
				?>
            </div>
        </div>
    </section>
</div>
@endsection()

@section('footer')
    @parent
<script type="text/javascript">
    $(function () {

        $('#edit').on('click', function() {
            var old_password = $('input[name="old_password"]').val(),
                password = $('input[name="edit_password"]').val(),
                re_password = $('input[name="edit_re_password"]').val(),
                check = false;
                if( old_password.length < 8 || old_password.length > 16 || password.length < 8 || password.length > 16   ) {
                    _swal({'status': 0, 'message': '密碼需為 8-16 字元'});
                    return;
                } else if ( password != re_password ) {
                    _swal({'status': 0, 'message': '密碼輸入不相符'});
                    return;
                } else {
                    check = true;
                }

                if(check) {
                    $.ajax({
                        url: '{{url("admin/admins/edit")}}',
                        type: 'post',
                        data: {
                            id: '{{ $data['admin']['id'] or null}}',
                            act: 'password',
                            old_password : old_password,
                            password : password,
                            re_password : re_password,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function (r) {
                            _swal(r);
                        },
                        error: function (r) {
                            r = r.responseJSON;
                            _swal(r);
                        },
                    });
                }
        });

        $('#save').on('click', function() {
            var account = $('input[name="account"]').val(),
                password = $('input[name="password"]').val(),
                re_password = $('input[name="re_password"]').val(),
                name = $('input[name="name"]').val(),
                email = $('input[name="email"]').val(),
                act = '<?php echo $data['act'] ?>',
                check = false;

                if( account.length < 4 || account.length > 16 ){
                    _swal({'status': 0, 'message': '帳號需為 4-16 字元'});
                    return;
                } else if( name.length == 0) {
                    _swal({'status': 0, 'message': '請填寫名稱'});
                    return;
                } else if (email.length == 0) {
                    _swal({'status': 0, 'message': '請填寫Email'});
                    return;
                }

            if(act == 'add') {
                if( password.length < 8 || password.length > 16 || re_password.length < 8 || re_password.length > 16 ) {
                    _swal({'status': 0, 'message': '密碼需為 8-16 字元'});
                    return;
                } else if(password != re_password ) {
                    $('input[name="password"], input[name="re_password"]').val('');
                    _swal({'status': 0, 'message': '密碼輸入不相符'});
                    return;
                } else {
                    check = true;
                }
            } else {
                check = true;
            }

            if(check) {
                $.ajax({
                    url: '{{url("admin/admins/edit")}}',
                    type: 'post',
                    data: {
                        id: '{{ $data['admin']['id'] or null}}',
                        act: act,
                        account : account,
                        password : password,
                        re_password : re_password,
                        name : name,
                        email : email,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (r) {
                        _swal(r);
                    },
                    error: function (r) {
                        r = r.responseJSON;
                        _swal(r);
                    },
                });
            } else {
                _swal({'status': 0, 'message': '異常, 請重新操作', 'redirect' : '<?php echo url()->route('admin::admins') ?>'});
            }
        });

        $('#delete').on('click', function() {
            swal({
                title: '確定刪除: {{$data['admin']['name'] or null}}',
                text: "此動作無法還原",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確定刪除',
                cancelButtonText: '取消',
            }).then(function () {
                $.ajax({
                    url : '{{url("admin/admins/delete")}}',
                    type: 'post',
                    data: {
                        id : {{ $data['admin']['id'] or 'null' }},
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (r) {
                        _swal(r);
                    },
                    error: function (r) {
                        r = r.responseJSON;
                        _swal(r);
                    },
                });
            });
        });
    });

</script>
@endsection