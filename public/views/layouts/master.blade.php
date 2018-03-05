<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>APP - crond管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
    <style>
        .detail {
            background: #fff;
        }
    </style>
</head>
<body>
<header class="am-topbar am-topbar-fixed-top">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="#">Crontab</a>
        </h1>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
                data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
                class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="collapse-head">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li class="{{ $active=="env"?'am-active':"" }}"><a href="/env/index">环境管理</a></li>
                <li class="{{ $active=="project"?'am-active':"" }}"><a href="/project">项目</a></li>
                <li class="{{ $active=="use"?'am-active':"" }}"><a href="/use/index">上线</a></li>
                <li class="{{ $active=="publish"?'am-active':"" }}"><a href="/publish/log">发布历史</a></li>
                <li class="{{ $active=="user"?'am-active':"" }}"><a href="/user/index">用户管理</a></li>
            </ul>

            <div class="am-topbar-right">
                <div class="am-dropdown" data-am-dropdown="{boundary: '.am-topbar'}">
                    <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm am-dropdown-toggle" data-am-dropdown-toggle>用户 <span class="am-icon-caret-down"></span></button>
                    <ul class="am-dropdown-content">
                        <li><a href="https://github.com/ctfang">源码地址</a></li>
                        <li><a href="/user/edit-password">修改密码</a></li>
                        <li><a href="/index/logout">退出登录</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="detail">
    <div class="am-g am-container">
        @section('content')
            这是内容块
        @show
    </div>
</div>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/assets/js/amazeui.min.js"></script>

@section('bodyEnd')
@show

</body>
</html>
