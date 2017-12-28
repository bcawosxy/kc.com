@extends('admin.layout.master')

@section('content')
    <style>
        .contactTitle {
            border-bottom : 2px #d6d6d6 solid;
            color : #1166e8;
        }
    </style>
    <div class="content-wrapper" style="height: auto;">
        <section class="content-header">
            <div class="box-body"><h2>聯絡我們-清單 </h2></div>
            <ol class="breadcrumb">
                <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">聯絡我們-清單 </li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div style="height: auto">
                        <div id="alert_w" class="callout">
                            <p>*雙擊欄位查看詳細內容</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="service" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>名稱</th>
                                        <th>電話</th>
                                        <th>Email</th>
                                        <th>項目</th>
                                        <th>時間</th>
                                        <th>內容</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['contacts'] as $k0 => $v0)
                                    <tr class="data">
                                        <td name="id">{{$v0['id']}}</td>
                                        <td name="name">{{$v0['name']}}</td>
                                        <td name="telephone">{{$v0['phone']}}</td>
                                        <td name="Email">{{$v0['email']}}</td>
                                        <td name="service">{{$v0['service']}}</td>
                                        <td name="service">{{$v0['created_at']}}</td>
                                        <td name="content">{{$v0['content']}}</td>
                                    </tr>
                                @endforeach
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
        $(document).ready(function() {
            var table = $('#service').DataTable({
                order : [[0, "asc"]],
                pageLength : 25,
                columns: [
                    { data: "id", width : '6%', orderable : true},
                    { data: "name", width : '8%', orderable : true},
                    { data: "telephone",},
                    { data: "email",},
                    { data: "service",},
                    { data: "created_at",},
                    { data: "content", visible : false,},
                ],
                select : true,
            });


            $('#service tbody').on( 'dblclick', 'tr', function () {
                if($('#editView').length > 0) $('#editView').remove();
                var data = table.row( this ).data(),
                    html = '<div><span class="contactTitle">名稱 : </span><br>'+data.name+'<br><br><span class="contactTitle">Email : </span><br>'+data.email+'<br><br><span class="contactTitle">服務項目 : </span><br>'+data.service+'<br><br><span class="contactTitle">聯絡內容 : </span><br>'+data.content+'<br><br><span class="contactTitle">建立時間 : </span><br>'+data.created_at+'',
                    model = new jBox('Modal', {
                        id : 'editView',
                        width: 'auto',
                        height: 'auto',
                        minWidth : 300,
                        title: '聯絡內容',
                        content: html,
                        zIndex : '1058',
                    }).open();
            });

        });

    </script>
@endsection