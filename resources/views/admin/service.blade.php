@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper" style="height: auto;">
        <section class="content-header">
            <div class="box-body"><h2>服務項目管理</h2></div>
            <h1>
                <small><p class="text-light-blue"></p></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">服務項目管理</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="box-body">
                                            <table id="example" class="display" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>名稱</th>
                                                    <th>子名稱</th>
                                                    <th style="display: none;">id</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection()

@section('footer')
    @parent
    <script type="text/javascript">
        var editor;

        $(document).ready(function() {
            editor = new $.fn.dataTable.Editor( {
                table: "#example",
                idSrc:  'sort',
                fields: [{
                    label: "排序:",
                    name: "sort",
                    type : "hidden"
                }, {
                    label: "名稱:",
                    name: "name"
                }, {
                    label: "子名稱:",
                    name: "title"
                } ,{
                    label: "id",
                    name: "id",
                    type : "hidden"
                },
                ],
                i18n: {
                    create: {
                        title:  "新增服務項目",
                        submit : '新增',
                    },
                    edit: {
                        title:  "編輯服務項目",
                        submit : '修改',
                    },
                    remove: {
                        title:  "刪除服務項目",
                        confirm: "刪除後無法復原, 確定要刪除嗎?",
                        submit : '刪除',
                    },
                }
            } );

            var table = $('#example').DataTable( {
                dom : "Bfrtip",
                ajax : "{{url('admin/service/get')}}",
                order : [[0, "asc"]],
                pageLength : 30,
                columns: [
                    { data: "sort", width : '6%', orderable : true},
                    { data: "name",},
                    { data: "title",},
                    { data: "id", visible : false},
                ],
                columnDefs: [
                    { orderable: false, targets: [ 0,1,2,3 ] }
                ],
                rowReorder: {
                    dataSrc: 'sort',
                },
                select : true,
                buttons: [
                    { extend: "create", editor: editor , text : '新增'},
                    { extend: "edit",   editor: editor , text : '編輯'},
                    { extend: "remove", editor: editor , text : '刪除'}
                ],
            } );

            editor.on( 'create', function ( e, json, data ) {
                refreshData('add', json.data, table);
            }).on( 'edit', function ( e, json, data ) {
                refreshData('update', json.data, table);
            }).on( 'remove', function ( e, json ) {
                var rows = table.rows().data(),
                    data = [];
                for (i = 0; i < rows.length; i++) {
                    data.push(rows[i]);
                }
                refreshData('delete', data, table);
            });

            table.on( 'row-reordered', function ( e, diff, edit ) {
                var rows = table.rows().data(),
                    data = [];
                for (i = 0; i < rows.length; i++) {
                    data.push(rows[i]);
                }
                refreshData('update', data, table);
            } );
        } );

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
                success: function (response) {
                    table.ajax.reload( null, false );
                },
                error: function (response) {},
            });
        }

    </script>
@endsection