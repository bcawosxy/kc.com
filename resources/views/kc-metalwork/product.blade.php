@extends('kc-metalwork.layout.master')

@section('content')
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                        <h3>Work</h3>
                    </div>
                    <hr style="width: 100px;">

                    @foreach ($data as $k0 => $v0)
                        <div class="col-md-4 col-sm-6">
                            <a href="{{$v0['url']}}">
                                <div class="portfolio-thumb">
                                    <img src="{{$v0['cover']}}" style="opacity: 0.8" class="img-responsive" alt="{{$v0['name']}}">
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-item">
                                            <h3>{{$v0['name']}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

