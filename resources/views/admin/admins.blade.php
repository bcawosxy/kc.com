@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper" style="height: auto;">
        <section class="content-header">
            <div class="box-body"><h2>管理員設定</h2></div>
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
                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>帳號</th>
                                        <th>名稱</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
                idSrc:  'id',
                fields: [{
                    label: "ID:",
                    name : "id",
                }, {
                    label: "帳號:",
                    name : "account"
                }, {
                    label: "舊密碼:",
                    name : "old_password"
                }, {
                    label: "新密碼:",
                    name : "new_password"
                }, {
                    label: "再次輸入新密碼:",
                    name : "re_password"
                }, {
                    label: "名稱:",
                    name : "name"
                } ,{
                    label: "Email:",
                    name : "email",
                },
                ],
                i18n: {
                    create: {
                        title:  "新增管理員",
                        submit : '新增',
                    },
                    edit: {
                        title:  "編輯管理員",
                        submit : '修改',
                    },
                    remove: {
                        title:  "刪除管理員",
                        confirm: "刪除後無法復原, 確定要刪除嗎?",
                        submit : '刪除',
                    },
                }
            });

            var table = $('#example').DataTable( {
                dom : "Bfrtip",
                ajax : "{{url('admin/admins/get')}}",
                order : [[0, "asc"]],
                pageLength : 30,
                columns: [
                    { data: "id", width : '6%', orderable : true},
                    { data: 'account',},
                    { data: "name",},
                    { data: "email"},
                ],
                columnDefs: [
                    { orderable: false, targets: [ 0,1,2 ] }
                ],
                select : true,
                buttons: [
                    { extend: "create", editor: editor , text : '新增'},
                    { extend: "edit",   editor: editor , text : '編輯'},
                    { extend: "remove", editor: editor , text : '刪除'}
                ],
            } );

            editor.disable(['id']);
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
            
            editor.on('open', function(e, o, action){
                if(action == 'create'){
                    this.hide(['id']);
                } else {
                    this.show();
                }
            }).on( 'preSubmit', function ( e, o, action ) {

                if ( action !== 'remove' ) {

                    var id = this.field( 'id' ),
                        account = this.field( 'account' ),
                        old_password = this.field( 'old_password' ),
                        new_password = this.field( 'new_password' ),
                        re_password = this.field( 're_password' ),
                        name    = this.field( 'name' ),
                        email   = this.field( 'email' );

                    if ( ! account.isMultiValue() ) {
                        if ( ! account.val() ) {
                            account.error( '必須填寫帳號' );
                        }
                    }

                    if( ! old_password.isMultiValue() || ! new_password.isMultiValue() || ! re_password.isMultiValue()) {
                        if ( ! old_password.val() || ! new_password.val() || ! re_password.val()) {
                            if ( ! old_password.val() ) {
                                old_password.error( '必須填寫密碼' );
                            }

                            if ( ! new_password.val() ) {
                                new_password.error( '必須填寫新密碼' );
                            }

                            if ( ! re_password.val() ) {
                                re_password.error( '請再次輸入密碼' );
                            }
                        } else {

                        }
                    }

                    if ( ! name.isMultiValue() ) {
                        if ( ! name.val() ) {
                            name.error( '必須填寫名稱' );
                        }
                    }

                    if ( ! email.isMultiValue() ) {
                        if ( ! email.val() ) {
                            email.error( '必須填寫Email' );
                        }
                    }

                    // If any error was reported, cancel the submission so it can be corrected
                    if ( this.inError() ) {
                        return false;
                    }
                }
            } );
        });

        function refreshData(act, data, table) {
            $.ajax({
                url : '{{url("admin/admins/refresh")}}',
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