@extends('kc-metalwork.layout.master')

@section('content')
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="section-title">
                        <h4>錯誤的頁面連結, 3秒將為您引導回首頁...</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @parent
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                location.href="<?php echo url()->route('KC::index') ?>";
            }, 3000);
        })
    </script>
@endsection
