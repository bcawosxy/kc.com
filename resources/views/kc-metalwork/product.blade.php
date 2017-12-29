@extends('kc-metalwork.layout.master')

@section('content')
    <style>
        .pagination>li>a {
            border:0px;
        }
    </style>

    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                        <h3>Product</h3>
                    </div>
                    <hr style="width: 100px;">
                    @foreach ($data['products'] as $k0 => $v0)
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
            <br>
            <div class="row">
                <nav style="float: right;" aria-label="...">
                    <ul class="pagination">
                        <?php
                            if($data['currentPage'] == 1) {
                                $previousClass = 'disabled';
                                $previousUrl = 'javascript:void(0);';
                            } else {
                                $previousClass = null;
                                $previousUrl = url()->route('KC::product', ['page' => ($data['currentPage']-1)]);
                            }
                            if($data['allPages'] > 1) {
                               echo '<li class="'.$previousClass.'"><a href="'.$previousUrl.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                            }

                            if($data['allPages'] > 1) {
                                for($i = 1; $i <= $data['allPages']; $i++) {
                                    if($i == $data['currentPage']) {
                                        echo '<li><a href="'.url()->route('KC::product', ['page' => $i]).'"><b>'.$i.'</b></a></li>';
                                    } else {
                                        echo '<li><a href="'.url()->route('KC::product', ['page' => $i]).'">'.$i.'</a></li>';
                                    }
                                }
                            }

                            if($data['currentPage'] == $data['allPages']) {
                            $nextClass = 'disabled';
                            $nextUrl = 'javascript:void(0);';
                            } else {
                            $nextClass = null;
                            $nextUrl = url()->route('KC::product', ['page' => ($data['currentPage']+1)]);
                            }
                            if($data['allPages'] > 1) {
                            echo '<li class="'.$nextClass.'"><a href="'.$nextUrl.'" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection

