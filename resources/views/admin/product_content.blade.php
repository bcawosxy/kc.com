@extends('admin.layout.master')

@section('content')
    <style>
        dd.tags{
            margin-bottom: 10px;
        }
    </style>

    <script src="{{ URL::asset('js/admin/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/admin/ckfinder/ckfinder.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/admin/ckeditor/adapters/jquery.js')}}" type="text/javascript"></script>

    <div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>作品管理</h2></div>
        <ol class="breadcrumb">
            <li><a href="{{ url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url()->route('admin::product')}}"> 作品管理</a></li>
            <li class="active">{{ $data['product']['name'] or ''}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="box-body box-solid">
                            <!--tab1-->
                            <div class="box-header with-border">
                                <i class="fa fa-file-text-o"></i>
                                <h3 class="box-title"> <?php echo ($data['act'] == 'add') ? '新增產品' : '編輯產品 ： <span style="color:#3c8dbc;font-weight:bold">'.$data['product']['name'] ?></span> </h3>
                            </div>
                            <div class="box-body">
                                <dl class="dl-horizontal">
                                    <dt>編號:</dt>
                                    <dd># {{$data['product']['id'] or ''}}</dd>
                                    <br>
                                    <dt>名稱:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="name" placeholder="產品名稱" value="{{$data['product']['name'] or ""}}">
                                    </dd>
                                    <br>
                                    <dt>狀態:</dt>
                                    <dd>
                                        <div class="form-group">
                                            <label for="r1">
                                                <input id="r1" type="radio" name="status" class="minimal-red" value="open" <?php if($data['product']['status'] == 'open' || $data['product']['status'] == '') echo 'checked'; ?>>
                                                &nbsp;開啟
                                            </label>&nbsp;&nbsp;&nbsp;
                                            <label for="r2">
                                                <input id="r2" type="radio" name="status" class="minimal-red" value="close" <?php if($data['product']['status'] == 'close') echo 'checked'; ?>>
                                                &nbsp;關閉
                                            </label>
                                        </div>
                                    </dd>
                                    <br>
                                    <dt>首頁展示:</dt>
                                    <dd>
                                        <div class="form-group">
                                            <label for="s1">
                                                <input id="s1" type="radio" name="showcase" class="minimal-red" value="1" <?php if($data['product']['showcase']) echo 'checked'; ?>>
                                                &nbsp;是
                                            </label>&nbsp;&nbsp;&nbsp;
                                            <label for="s2">
                                                <input id="s2" type="radio" name="showcase" class="minimal-red" value="0" <?php if(!$data['product']['showcase']) echo 'checked'; ?>>
                                                &nbsp;否
                                            </label>
                                        </div>
                                    </dd>
                                    <br>
                                    <dt>內文:</dt>
                                    <dd>
                                        <textarea rows="10" cols="30" name="product_content" class="ckeditor" id="product_content">{{$data['product']['content'] or ''}}</textarea>
                                        <script type="text/javascript">
                                            var content = CKEDITOR.replace('product_content',
                                                {
                                                    toolbar : 'Full',
                                                    width: '100%',
                                                    height: '300px'
                                                });
                                            CKFinder.setupCKEditor(content);
                                        </script>
                                    </dd>
                                    <br>
                                    <dt>封面:</dt>
                                    <dd>
                                        <div class="form-group">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-success fileinput-button">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Select files...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                                <input id="fileupload" type="file" name="files[]" accept="image/png,image/jpg,image/jpeg">
                                            </span>
                                            <br><br>
                                            <!-- The global progress bar -->
                                            <div id="progress" class="progress">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
                                            <img style="width:360px;height: 320px;" id="cover" alt="{{$data['product']['cover'] or ''}}" src="{{$data['product']['coverUrl'] or ''}}"    onerror="this.src='{{asset('images/origin.png')}}'" data-state="old" class="img-responsive">
                                        </div>
                                    </dd>
                                    <br>
                                    <dt>新增時間:</dt>
                                    <dd>
                                        <p class="text-muted">{{ $data['product']['created_at'] or '' }}</p>
                                    </dd>
                                    <br>
                                    <dt>修改時間:</dt>
                                    <dd>
                                        <p class="text-muted">{{ $data['product']['updated_at'] or '' }}</p>
                                    </dd>
                                    <br>
                                    <dt>修改人員:</dt>
                                    <dd>
                                        <p class="text-light-blue">{{$data['product']['admin'] or ''}}</p>
                                    </dd>
                                    <br>
                                </dl>
                            </div>
                            <!--end tab1-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-app" href="{{url()->route('admin::product')}}">
            <i class="fa fa-angle-double-left"></i> 上一頁
        </a>
        <a class="btn btn-app" id="save">
            <i class="fa fa-save"></i> 儲存(Save)
        </a>
        <?php
        if($data['act'] =='edit') echo '<a class="btn btn-app" id="delete"><i class="fa fa-trash-o"></i> 刪除(Delete)</a>';
        ?>
    </section>
</div>
@endsection()

@section('footer')
    @parent
<script type="text/javascript">
    $(function () {
        'use strict';

        $('#fileupload').fileupload({
            url: "{{ url()->route('admin::fileUpload')  }}",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if( file.error ) {
                        _swal({'status': 0, 'message': file.error});
                        $('#progress .progress-bar').css('width', '0%');
                    } else {
                        var target = '<?php echo URL('upload/files'); ?>/';
                        $('#cover').data('state', 'new');

                        //croppie
                        swal({
                            html : `<div style="width:1060px;height:760px;" id="demo"><div>`,
                            confirmButtonText : '裁切',
                            cancelButtonText : '<i class="fa fa-thumbs-down"></i>',
                            width: 'auto',
                            onOpen : function() {
                                var cover = $('#demo').croppie({
                                    url :  target + file.name,
                                    viewport: { width: 360, height: 320 },
                                    boundary: { width: 960, height: 720 },
                                });
                                window.cover = cover;
                            }
                        }).then(function(){
                            cover.croppie('result', {
                                type : 'canvas',
                                size : { width: 360, height: 320 },
                                format : 'png',
                            }).then(function (resp) {
                                $('#cover').attr('src', resp);
                            });

                            $('#progress .progress-bar').css('width', '0%');
                        });
                    }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css('width', progress + '%');
            }
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });

        $('#save').on('click', function() {
            var  [id, act, name, content, status, showcase, cover_state] = [
                    '{{ $data['product']['id'] or null}}',
                    '{{ $data['act'] }}',
                    $('input[name="name"]').val(),
                    CKEDITOR.instances['product_content'].getData(),
                    $('input[name="status"]:checked').val(),
                    $('input[name="showcase"]:checked').val(),
                    $('#cover').data('state'),
                ],
                cover = (cover_state == 'new') ? $('#cover').attr('src') : $('#cover').attr('alt') ;

            if(act == '' || name == '' || content == '' || status == '' ||  showcase == '' || cover == '') {
                _swal({'status': 0, 'message': '資料未填寫完成, 請重新操作'});
            } else {
                $.ajax({
                    url : '{{url("admin/product/edit")}}',
                    type: 'post',
                    data: {
                        id : id,
                        act : act,
                        name : name,
                        content : content,
                        status : status,
                        showcase : showcase,
                        cover : cover,
                        cover_state : cover_state,
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
        })

        $('#delete').on('click', function() {
            swal({
                title: '確定刪除: {{$data['product']['name'] or null}}',
                text: "此動作無法還原",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確定刪除',
                cancelButtonText: '取消',
            }).then(function () {
                $.ajax({
                    url : '{{url("admin/product/delete")}}',
                    type: 'post',
                    data: {
                        id : {{ $data['product']['id'] or 'null' }},
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