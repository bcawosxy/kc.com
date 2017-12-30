@extends('admin.layout.master')

@section('content')
<div class="content-wrapper" style="height: auto;">
    <!-- top -->
    <section class="content-header">
        <div class="box-body"><h2>系統參數設定</h2></div>
        <ol class="breadcrumb">
            <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">系統參數設定</li>
        </ol>
    </section>
    <!-- //top -->

    <!-- meta setting -->
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">網頁標籤(title) / 描述(description)</h3>
                <h4>
                    <small><p class="text-light-blue">(網站標題及描述)</p></small>
                </h4>
            </div>
            <div class="box-body">
                <label>Title</label> :
                <input class="form-control" maxlength="32" data-code="system" name="title" style="max-width:500px;" type="text" placeholder="Text" value="{{$data['title']['value']}}"><br>
                <label>Description</label> :
                <input class="form-control" maxlength="50" data-code="system" name="description" style="max-width:500px;" type="text" placeholder="Description" value="{{$data['description']['value']}}">
            </div>
        </div>
    </section>
    <!-- //meta setting -->

    <!-- logo & icon -->
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">網站Logo / 下方圖示</h3>
            </div>
            <div class="box-body">
                <div style="height: auto">
                    <div id="alert_w" class="callout">
                        <p>建議尺寸 : 約300*50 , 圖片格式 : JPG / JPEG / PNG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;檔案大小: 16MB</p>
                    </div>
                </div>
                <div class="form-group">
                    <label>Logo</label> : &nbsp;&nbsp;
                    <span class="btn btn-success fileinput-button fileupload" name="logo">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span >Select files</span>
                    </span>
                    <br><br>
                    <img name="logo" src="{{ url()->asset('images/').DIRECTORY_SEPARATOR.$data['logo']['value'] }}"  onerror="this.src='{{asset('images/origin.png')}}'" data-state="old" data-code="system" class="img-responsive">
                </div>
                <br><br>
                <div style="height: auto">
                    <div id="alert_w" class="callout">
                        <p>建議尺寸 : 約100*70 , 圖片格式 : JPG / JPEG / PNG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;檔案大小: 16MB</p>
                    </div>
                </div>
                <div class="form-group">
                    <label>圖示</label> : &nbsp;&nbsp;
                    <span class="btn btn-success fileinput-button fileupload" name="icon">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Select files</span>
                    </span>
                    <br><br>
                    <img name="icon" src="{{ url()->asset('images/').DIRECTORY_SEPARATOR.$data['icon']['value'] }}"  onerror="this.src='{{asset('images/origin.png')}}'" data-state="old" data-code="system" class="img-responsive">
                </div>

                <div class="form-group">
                    <input id="fileupload" type="file" name="files[]" style="display: none;" data-code="" accept="image/png,image/jpg,image/jpeg">
                    <!-- The global progress bar -->
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <!-- The container for the uploaded files -->
                </div>

            </div>
        </div>
    </section>
    <!-- //logo & icon -->

    <!-- info -->
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">聯絡資料</h3>
                <h4>
                    <small><p class="text-light-blue">(公司聯絡資料)</p></small>
                </h4>
            </div>
            <div class="box-body">

                <label>Phone</label> :
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" data-code="info" name="telephone" style="max-width:465px;" value="{{$data['telephone']['value']}}">
                </div>

                <label>FAX</label> :
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-fax"></i>
                    </div>
                    <input type="text" class="form-control" data-code="info" name="fax" style="max-width:465px;" value="{{$data['fax']['value']}}">
                </div>

                <label>Email</label> :
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <input type="text" class="form-control" data-code="info" name="email" style="max-width:465px;" value="{{$data['email']['value']}}">
                </div>

                <label>地址</label> :
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                    </div>
                    <input type="text" class="form-control" data-code="info" name="address" style="max-width:465px;" value="{{$data['address']['value']}}">
                </div>

            </div>
        </div>
    </section>
    <!-- //info -->

    <a class="btn btn-app " id="save">
        <i class="fa fa-save"></i> Save All
    </a>
</div>
@endsection()

@section('footer')
    @parent
<script type="text/javascript">
    $(function () {
        $('.fileupload').on('click', function(){
           $('#fileupload').data('usefor', $(this).attr('name')).trigger('click');
        });

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
                        $('img[name="'+ $('#fileupload').data('usefor') + '"]').attr({'alt' : file.name, 'src' : target+file.name}).data('state', 'new');
                    }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css('width', progress + '%');
            }
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');


        $('#save').on('click', function() {
            var data = [], images = [];
            $('input[data-code!=""]').each(function(k ,v){
                data.push({'code' : $(v).data('code'), 'key' : $(v).attr('name'), 'value' : $(v).val()});
            });

            $('img[data-code!=""]').each(function(k ,v){
                if($(v).data('state') == 'new') {
                    images.push({'code' : $(v).data('code'), 'key' : $(v).attr('name'), 'value' : $(v).attr('alt')});
                }
            });

            $.ajax({
                url : '{{url("admin/info/edit")}}',
                type: 'post',
                data: {
                    data : JSON.stringify(data),
                    images : JSON.stringify(images),
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
</script>
@endsection