<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">後台首頁</li>
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-home"></i><span>  首頁資訊</span></a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="header">網站內容管理</li>
            <li>
                <a href="{{url('admin/about')}}"><i class="fa fa-book"></i><span>關於{{config('app.name_CHT')}}</span></a>
            </li>
            <li>
                <a href="{{url('admin/service')}}"><i class="fa fa-thumbs-o-up"></i><span>服務項目管理</span></a>
            </li>
            <li>
                <a href="{{url('admin/info')}}"><i class="fa fa-legal"></i><span>資料設定</span></a>
            </li>
            <li>
                <a href="{{url('admin/banner')}}"><i class="fa fa-sliders"></i><span>橫幅圖片設定</span></a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="header">作品成果管理</li>
            <li>
                <a href="{{url('admin/product')}}"><i class="fa fa-server"></i><span> 作品管理</span></a>
            </li>
            <li>
                <a href="{{url('admin/showcase')}}"><i class="fa fa-sliders"></i><span>作品展示設定</span></a>
            </li>
        </ul>

        <!--
        <ul class="sidebar-menu">
            <li class="header">商品資訊</li>
            <li>
                <a href="{{url('admin/categoryarea')}}"><i class="fa fa-list"></i> <span>產品類別管理</span></a>
            </li>
            <li>
                <a href="{{url('admin/category')}}"><i class="fa fa-list-ul"></i> <span>產品項目管理</span></a>
            </li>
            <li>
                <a href="{{url('admin/product')}}"><i class="fa fa-heart"></i> <span>產品管理</span></a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="header">社群網站</li>
            <li>
                <a href="{{url('admin/sociallink')}}"><i class="fa fa-facebook"></i> <span>社群網站連結</span></a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="header">聯繫我們 / 產品詢價</li>
            <li>
                <a href="{{url('admin/contact')}}"><i class="fa fa-reply"></i> <span>聯繫我們</span></a>
            </li>
            <li>
                <a href="{{url('admin/inquiry')}}"><i class="fa fa-question"></i> <span>產品詢價</span></a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="header">系統</li>
            <li>
                <a href="{{url('admin/system')}}"><i class="fa fa-gear"></i> <span>系統參數</span></a>
            </li>
            <li>
                <a href="{{url('admin/admins')}}"><i class="fa fa-list-ul"></i> <span>管理員設定</span></a>
            </li>
        </ul>
         -->
        <ul class="sidebar-menu">
            <li class="header">登出</li>
            <li>
                <a href="{{url('admin/logout')}}"><i class="fa fa-sign-out"></i> <span>登出</span></a>
            </li>
        </ul>

    </section>
</aside>