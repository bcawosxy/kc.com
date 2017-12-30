@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper" style="height: auto;">
        <section class="content-header">
            <div class="box-body"><h2>凱詮金屬有限公司 - 後台管理系統</h2></div>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Home </li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

                                    <div class="info-box-content">
                                        <p class="text-light-blue">歡迎管理員 {{$data['user']['name']}} 登入</p>
                                        <p class="info-box-number">請從左側選單開始您的工作內容。</p>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection()



