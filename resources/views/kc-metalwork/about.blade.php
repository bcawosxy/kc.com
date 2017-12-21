@extends('kc-metalwork.layout.master')

@section('content')

    <section id="about">
        <div class="container">
            <div class="row">
                {{ htmlentities($data['value']) }}
                {{--<div class="col-md-offset-1 col-md-10 col-sm-12">--}}
                    {{--<div class="section-title">--}}
                        {{--<h3>About Us</h3>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-12 col-sm-12">--}}
                        {{--<img src="images/about-image.jpg" class="img-responsive" alt="About">--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}
                    {{--<hr>--}}
                    {{--<h3>凱詮金屬</h3>--}}
                    {{--<br>--}}

                    {{--<p>專注於各樣鐵作及鐵件樣式的設計，廣受眾多建設公司和民宅住戶青睞。</p>--}}
                    {{--<p>致力於將鐵作藝術融入作品中，突破鐵材的塑造限制，將鍛鐵造成各種造型，</p>--}}
                    {{--<p>不論是簡單的直線造型或是繁複的風格，皆能製造出讓您稱心滿意及美觀耐用的產品。</p>--}}
                    {{--<p>鐵件裝飾藝術，這起源自歐洲的古典建築風格，已廣泛地運用在現代建築裝飾藝術中，鐵件以其渾厚、沉實、堅固、耐磨和獨特的藝術線條，而引起眾多使用者的青睞，亦發展成為建築裝潢工程中重要的元素。</p>--}}

                {{--</div>--}}

            </div>
        </div>
    </section>

@endsection

