@extends('admin.layout.master')

@section('content')
    <style>
        td:first-child:hover {
            cursor: move;
        }
    </style>
    <div class="content-wrapper" style="height: auto;">
        <section class="content-header">
            <div class="box-body"><h2>服務項目管理</h2></div>
            <ol class="breadcrumb">
                <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">服務項目管理</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div style="height: auto">
                        <div id="alert_w" class="callout">
                            <p>*拖曳"#"調整順序</p>
                            <p>*雙擊欄位進行編輯</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="service" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#排序</th>
                                        <th>id</th>
                                        <th>名稱</th>
                                        <th>子名稱</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['services'] as $k0 => $v0)
                                    <tr class="data">
                                        <td name="sort">{{$v0['sort']}}</td>
                                        <td name="id">{{$v0['id']}}</td>
                                        <td name="name">{{$v0['name']}}</td>
                                        <td name="title">{{$v0['title']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a class="btn btn-app " id="add" href="javascript:void(0);">
                    <i class="fa fa-plus-square-o"></i> 新增服務項目
                </a>
            </div>
        </section>
    </div>
@endsection()

@section('footer')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#service').DataTable({
                order : [[0, "asc"]],
                pageLength : 25,
                columns: [
                    { data: "sort", width : '8%', orderable : true},
                    { data: "id", width : '6%', orderable : true},
                    { data: "name",},
                    { data: "title",},
                ],
                rowReorder: {
                    dataSrc: 'sort',
                },
                select : true,
            });

            table.on( 'row-reordered', function ( e, diff, edit ) {
                var rows = table.rows().data(),
                    data = [];
                for (i = 0; i < rows.length; i++) {
                    data.push(rows[i]);
                }
                refreshData('update', data, table);
            });

            $('#add').on('click', function() {
                if($('#addView').length > 0) $('#addView').remove();
                var html = '<div>名稱:<br><input name="name" type="text"><br><br>子名稱:<br><input name="title" type="text"><br><br><input id="addService" class="btn btn-primary" type="button" value="送出"></div>',
                    model = new jBox('Modal', {
                        id : 'addView',
                        width: 'auto',
                        height: 200,
                        title: '新增服務項目',
                        content: html,
                        onOpen : function() {
                            $('#addService').on('click', function(){
                                var name = $('input[name="name"]').val(),
                                    title = $('input[name="title"]').val() || '';

                                if(!name) {
                                    alert('必須輸入服務項目名稱');
                                } else {
                                    $.ajax({
                                        url : '{{url("admin/service/edit")}}',
                                        type: 'post',
                                        data: {
                                            act : 'add',
                                            data : {'name' : name, 'title' : title},
                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        dataType: 'json',
                                        success: function (response) {
                                            model.destroy();
                                            _swal(response);
                                        },
                                        error: function (response) {
                                            model.destroy();
                                            r = response.responseJSON;
                                            _swal(r);
                                        },
                                    });
                                }
                            })
                        }
                    }).open();
            });

            $('#service tbody').on( 'dblclick', 'tr', function () {
                if($('#editView').length > 0) $('#editView').remove();
                var data = table.row( this ).data(),
                    html = '<div>名稱:<br><input name="name" type="text" value="'+data.name+'"><br><br>子名稱:<br><input name="title" type="text" value="'+data.title+'"><br><br><div class="row"><input id="editService" class="btn btn-primary col-md-8" style="margin:0 3px;" type="button" value="送出"><input style="margin:0 3px;" id="deleteService" class="btn btn-danger col-md-3" type="button" value="刪除"></div></div>',
                    model = new jBox('Modal', {
                        id : 'editView',
                        width: 'auto',
                        height: 200,
                        title: '編輯 / 刪除服務項目',
                        content: html,
                        zIndex : '1058',
                        onOpen : function() {

                            $('#editService').on('click', function() {
                                var name = $('input[name="name"]').val(),
                                    title = $('input[name="title"]').val() || '';

                                if(!name) {
                                    alert('必須輸入服務項目名稱');
                                } else {
                                    $.ajax({
                                        url : '{{url("admin/service/edit")}}',
                                        type: 'post',
                                        data: {
                                            act : 'update',
                                            data : {'id' : data.id, 'name' : name, 'title' : title},
                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        dataType: 'json',
                                        success: function (response) {
                                            model.destroy();
                                            _swal(response);
                                        },
                                        error: function (response) {
                                            model.destroy();
                                            r = response.responseJSON;
                                            _swal(r);
                                        },
                                    });
                                }
                            });

                            $('#deleteService').on('click', function() {
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
                                        url : '{{url("admin/service/edit")}}',
                                        type: 'post',
                                        data: {
                                            act : 'delete',
                                            data : {'id' : data.id, 'sort' : data.sort},
                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        dataType: 'json',
                                        success: function (response) {
                                            model.destroy();
                                            _swal(response);
                                        },
                                        error: function (response) {
                                            model.destroy();
                                            r = response.responseJSON;
                                            _swal(r);
                                        },
                                    });
                                });
                            })
                        }
                    }).open();
            });

        });

        function refreshData(act, data, table) {
            $.ajax({
                url : '{{url("admin/service/refresh")}}',
                type: 'post',
                data: {
                    act : act,
                    data : data,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (response) {},
                error: function (response) {},
            });
        }
    </script>
@endsection