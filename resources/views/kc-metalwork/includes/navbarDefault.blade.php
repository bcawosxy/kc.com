<div class="container">
    <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon icon-bar"></span>
            <span class="icon icon-bar"></span>
            <span class="icon icon-bar"></span>
        </button>
        <a href="{{url()->route('KC::index')}}" class="navbar-brand">
            <span style="letter-spacing: 0.2em;padding-left: 10px;">
                <img style="max-width: 300px;" src="../images/logo.png">
            </span>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li class="<?php if($action == 'index') echo 'active'; ?>"><a href="{{url()->route('KC::index')}}">首頁</a></li>
            <li itemscope itemtype="http://schema.org/LocalBusiness" itemref="_image2 _telephone3 _telephone4 _email5 _address6" class="<?php if($action == 'about') echo 'active'; ?>"><a href="{{url()->route('KC::about')}}"><span itemprop="name">關於我們</span></a></li>
            <li itemscope itemtype="http://schema.org/LocalBusiness" itemref="_image2 _telephone3 _telephone4 _email5 _address6" class="<?php if($action == 'product') echo 'active'; ?>"><a href="{{url()->route('KC::product')}}"><span itemprop="name">實績案例</span></a></li>
            <li itemscope itemtype="http://schema.org/LocalBusiness" itemref="_image2 _telephone3 _telephone4 _email5 _address6" class="<?php if($action == 'contact') echo 'active'; ?>"><a href="{{url()->route('KC::contact')}}"><span itemprop="name">聯絡我們</span></a></li>
        </ul>
    </div>
</div>