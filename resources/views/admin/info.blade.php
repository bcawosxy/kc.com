@extends('admin.layout.master')

@section('content')
<div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>系統參數設定</h2></div>
        <ol class="breadcrumb">
            <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">系統參數設定</li>
        </ol>
    </section>
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title 及 Description</h3>
                <h4>
                    <small><p class="text-light-blue">(網站標題及描述)</p></small>
                </h4>
            </div>
            <div class="box-body">
                <label>Title</label> :
                <input class="form-control" maxlength="30" data-code="system" name="title" style="max-width:500px;" type="text" placeholder="Text" value="{{$data['title']['value']}}"><br>
                <label>Description</label> :
                <input class="form-control" maxlength="50" data-code="system" name="description" style="max-width:500px;" type="text" placeholder="Description" value="{{$data['description']['value']}}">
            </div>
        </div>
    </section>

    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">聯絡資料</h3>
                <h4>
                    <small><p class="text-light-blue">(Contact頁面中的聯絡資料)</p></small>
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
    <a class="btn btn-app " id="save">
        <i class="fa fa-save"></i> Save All
    </a>
</div>
@endsection()

@section('footer')
    @parent
<script type="text/javascript">
    $(function () {

        $('#save').on('click', function() {
            var code, data = [];
            $('input[data-code!=""]').each(function(k ,v){
                code = $(v).data('code');
                data[code].push('1');
            })

            console.log(data);
                return;
            $.ajax({
                url : '{{url("admin/info/edit")}}',
                type: 'post',
                data: {
                    web_title : $(':input[name="web_title"]').val(),
                    web_description : $(':input[name="web_description"]').val(),
                    office_info_phone : $(':input[name="office_info_phone"]').val(),
                    office_info_email : $(':input[name="office_info_email"]').val(),
                    r1 : $('input[name=r1]:checked').val(),
                    r2 : $('input[name=r2]:checked').val(),
                    r3 : $('input[name=r3]:checked').val(),
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

        })
    });
</script>
@endsection