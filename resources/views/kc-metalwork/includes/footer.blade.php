<div class="container">
    <div class="row">

        <div class="col-md-3 col-sm-3">
            <img src="{{$icon}}">
        </div>

        <div id="_address6" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="col-md-4 col-sm-4">
            <p itemprop="streetAddress" title="address"><i class="fa fa-map-marker fa-lg"></i>&nbsp;&nbsp;{{$info['address']}}</p>
        </div>

        <div class="col-md-offset-1 col-md-4 col-sm-offset-1 col-sm-3">
            <p title="Email"><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:{{$info['email']}}"><span id="_email5" itemprop="email">{{$info['email']}}</span></a></p>
            <p id="_telephone3" itemprop="telephone" title="Telephone"><i class="fa fa-phone fa-lg"></i>&nbsp;&nbsp;{{$info['telephone']}}</p>
            <p id="_telephone4" itemprop="telephone" title="Fax"><i class="fa fa-fax"></i>&nbsp;&nbsp;{{$info['fax']}}</p>
        </div>

        <div class="clearfix col-md-12 col-sm-12">
            <hr>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="footer-copyright">
                <p> &copy; 2017 All Rights Reserved.</p>
            </div>
        </div>

        {{--<div class="col-md-6 col-sm-6">--}}
            {{--<ul class="social-icon">--}}
                {{--<li><a href="#" class="fa fa-facebook"></a></li>--}}
                {{--<li><a href="#" class="fa fa-twitter"></a></li>--}}
                {{--<li><a href="#" class="fa fa-linkedin"></a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}

    </div>
</div>