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
                            <table id="admins" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>編輯</th>
                                        <th>帳號</th>
                                        <th>名稱</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['admins'] as $k0 => $v0)
                                    <tr class="data">
                                        <td name="id">{{$v0['id']}}</td>
                                        <td><a href="{{url()->route('admin::adminsContent', ['id' => $v0['id'] ])}}">編輯</a></td>
                                        <td name="id">{{$v0['account']}}</td>
                                        <td name="id">{{$v0['name']}}</td>
                                        <td name="id">{{$v0['email']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-app " id="add" href="{{url('admin/admins/content')}}">
                            <i class="fa fa-plus-square-o"></i> 新增管理員
                        </a>
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
            $(function () {
                $("#admins").DataTable({
                    "order": [[ 0, "asc" ]],
                    "pageLength": 25,
                });
            });
        });
    </script>
@endsection