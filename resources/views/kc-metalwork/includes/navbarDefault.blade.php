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
            <li class="<?php if($action == 'about') echo 'active'; ?>"><a href="{{url()->route('KC::about')}}">關於我們</a></li>
            <li class="<?php if($action == 'product') echo 'active'; ?>"><a href="{{url()->route('KC::product')}}">作品</a></li>
{{--            <li><a href="{{url()->route('KC::contact')}}">聯絡我們</a></li>--}}
        </ul>
    </div>
</div>