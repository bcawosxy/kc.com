@extends('kc-metalwork.layout.master')

@section('content')
    <section id="single-project">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="section-title">
                        <h3>{{ $data['product']['name'] }}</h3>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="productContent">
                    {!! $data['product']['content'] !!}
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
            if(window.innerWidth < 1200) {
                $('.productContent').find('img').addClass('img-responsive');
            } else {
                $('.productContent').find('img').removeClass('img-responsive');
            }
        })
    </script>
@endsection
