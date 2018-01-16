@extends('kc-metalwork.layout.master')

@section('content')

    <section id="home" class="padbot0">
        <div class="flexslider top_slider">
            <ul class="slides">
                <?php
                    foreach ($data['banner'] as $k0 => $v0) {
						echo '<li class="slide1" data-thumb="'.$v0['url'].'">
                            <img id="_image2" itemprop="image" src="'.$v0['url'].'" />
                        </li>';
                    }
                ?>
            </ul>
        </div>
    </section>

    <section id="portfolio" style="padding-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="section-title">
                        <h3>Service</h3><hr>
                    </div>
                    <?php
                    foreach ($data['service'] as $k0 => $v0) {
                        $title = ($v0['title']) ? '<ul><li>'.$v0['title'].'</li></ul>' : '<ul><li style="list-style: none;">&nbsp;</li></ul>' ;

                    	echo '<div class="col-md-4 col-sm-6">
                            <h3>'.$v0['name'].'</h3>
                            <div style="border-bottom: 1px solid #ff00003b;width: 10px;"></div>'.$title.'
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" style="padding-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h3>Product</h3><hr>
                </div>
                <?php
                foreach ($data['showcase'] as $k0 => $v0) {
                	echo ' <div class="col-md-4 col-sm-6">
                        <a href="'.$v0['url'].'">
                            <div class="portfolio-thumb">
                                <img src="'.$v0['cover'].'" style="opacity: 0.8" class="img-responsive" alt="'.$v0['name'].'">
                                <div class="portfolio-overlay">
                                    <div class="portfolio-item">
                                        <h3 style="font-size:18px;">'.$v0['name'].'</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
                ?>
            </div>
        </div>
    </section>

@endsection

