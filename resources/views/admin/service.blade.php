@extends('admin.layout.master')

@section('content')
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
                            <p>拖曳"#"調整順序,&nbsp;&nbsp;單選欄位後進行編輯或刪除</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="service" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>排序</th>
                                        <th>#id</th>
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
            var table = $('#service').DataTable( {
                order : [[0, "asc"]],
                pageLength : 25,
                columns: [
                    { data: "sort", width : '6%', orderable : true},
                    { data: "id", width : '6%', orderable : true},
                    { data: "name",},
                    { data: "title",},
                ],
                rowReorder: {
                    dataSrc: 'sort',
                },
                select : true,
            } );

            table.on( 'row-reordered', function ( e, diff, edit ) {
                var rows = table.rows().data(),
                    data = [];
                for (i = 0; i < rows.length; i++) {
                    data.push(rows[i]);
                }
                refreshData('update', data, table);
            });

            $('#add').on('click', function() {
                var html = '<div>名稱:<br><input name="name" type="text"><br><br>子名稱:<br><input name="title" type="text"><br><br><input onclick="show();" id="addService" class="btn btn-primary" type="button" value="送出"></div>',
                    model = new jBox('Modal', {
                    width: 'auto',
                    height: 200,
                    title: '新增服務項目',
                    content: html,
                }).open();
            });


        });

        function show(value) {
            alert(value);
        }

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