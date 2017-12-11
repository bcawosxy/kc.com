@extends('admin.layout.master')

@section('content')
<div class="content-wrapper" style="height: auto;">
    <section class="content col-lg-11">
        <div class="box">
            <div class="box-header with-border">
                <h3>
                    類別 / 項目 / 產品 / 瀏覽人數 逐周統計數量
                </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div id="container" style="height: auto; margin: 0 auto;width:95%;"></div>
                </div>
            </div>
            <hr>
            <div class="box-header with-border">
                <h3>
                    各類別下的項目 / 產品數量
                </h3>
            </div>
            <div class="box-body">
                <div class="row">

                </div>
            </div>
        </div>
    </section>
</div>
@endsection()



