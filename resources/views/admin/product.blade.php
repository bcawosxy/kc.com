@extends('admin.layout.master')

@section('content')
<div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>作品管理</h2></div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">作品管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-header">
                            @if($errors->first())
                                <div class="alert alert-error alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button> <strong>Warning !</strong> Data not found. Retry please.
                                </div>
                            @endif
                        </div>
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>編輯</th>
                                        <th>名稱</th>
                                        <th>首頁展示</th>
                                        <th>狀態</th>
                                        <th>修改時間</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $v0)
                                        <tr>
                                            <td>{{$v0['id']}}</td>
                                            <td><a href="{{$v0['url']}}">編輯</a></td>
                                            <td style="color:#1d1d1d;">{{$v0['name']}}</td>
                                            <td>{!! $v0['showcase'] !!}</td>
                                            <td>{!! $v0['status'] !!}</td>
                                            <td>{{$v0['updated_at']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-app " id="add" href="{{url('admin/product/content')}}">
                            <i class="fa fa-plus-square-o"></i> 新增作品
                        </a>
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
    $(function () {
        $("#example").DataTable({
            "order": [[ 0, "asc" ]],
            "pageLength": 25,
        });
    });
</script>
@endsection