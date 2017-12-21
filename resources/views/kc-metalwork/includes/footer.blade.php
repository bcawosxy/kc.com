<div class="container">
    <div class="row">

        <div class="col-md-3 col-sm-3">
            <img src="{{$icon}}">
        </div>

        <div class="col-md-4 col-sm-4">
            <p>{{$info['address']}}</p>
        </div>

        <div class="col-md-offset-1 col-md-4 col-sm-offset-1 col-sm-3">
            <p><a href="mailto:{{$info['email']}}">{{$info['email']}}</a></p>
            <p>{{$info['telephone']}}</p>
        </div>

        <div class="clearfix col-md-12 col-sm-12">
            <hr>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="footer-copyright">
                <p>© 2017 All Rights Reserved.</p>
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