@extends('admin.layout.master')

@section('content')
<div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>首頁 - 作品展示排列預覽</h2></div>
        <ol class="breadcrumb">
            <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">作品展示排列預覽</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div style="height: 90px;">
                    <div id="alert_w" class="callout callout-warning">
                        <p>在 <a href="{{url()->route('admin::product')}}">作品管理</a> 設定該作品可做 "首頁展示" 才能在此進行排列</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- 未排序作品 -->
                    <div class="row col-md-3">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">未排序作品</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body text-center" style="background-color: #fcfcfc;">
                                <div class="col-md-12 col-sm-12" id="product" style="min-height: 100px;">
                                    <?php
                                        foreach ($data['product'] as $k0 => $v0) {
                                            echo '<div class="col-md-12 col-sm-3 item" style="margin:10px 0px" data-id="'.$v0['id'].'">
                                                <img class="img-responsive" src="'.$v0['cover'].'">
                                            </div>';
                                        }
                                    ?>
                                </div>
                            <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <!-- //未排序作品 -->

                    <!-- 排列展示作品 -->
                    <div class="row col-md-8 col-md-offset-1">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">首頁作品展示預覽</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body text-center"  style="background-color: #fcfcfc;">
                                <div class="col-md-12" id="showcase" style="min-height: 100px;">
                                    <?php
                                    foreach ($data['showcase'] as $k0 => $v0) {
                                        echo '<div class="col-md-4 col-sm-4 item" style="margin:10px 0px" data-id="'.$v0['id'].'" >
                                                <img class="img-responsive" src="'.$v0['cover'].'">
                                            </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //排列展示作品 -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection()

@section('footer')
    @parent
    <script>
        $( function() {
            $( "#product ,#showcase" ).sortable({
                connectWith: "div",
                dropOnEmpty: true,
                receive : function (e, ui) {
                    switch (e.target.id) {
                        case 'product' :
                            $('#product').find('div.col-md-4').removeClass('col-md-4 col-sm-4').addClass('col-md-12 col-sm-3');
                            break;

                        case 'showcase' :
                            $('#showcase').find('div.col-md-12').removeClass('col-md-12 col-sm-3').addClass('col-md-4 col-sm-4');
                            break;
                    }
                }
            });

            $('#showcase').on('sortupdate', function(){
                showcaseUpdate();
            })
        });

        function showcaseUpdate() {
            var id = [];

            $('#showcase>.item').each(function () {
                id.push($(this).data('id'));
            });

            $.ajax('<?php echo url()->route('admin::showcaseupdate') ?>', {
                type : 'post',
                data: {
                    id : id ,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (r) {
                    $('#alert_w').hide().removeClass('callout-warning').addClass('callout-success')

                    setTimeout(function(){
                        $('#alert_w').show().find('p').html('首頁成果排序更新完成');
                    }, 100);
                },
                error : function (r) {
                },

            });
        }
    </script>
    @endsection



