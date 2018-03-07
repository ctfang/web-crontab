<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>WEB - CRONTAB</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
    <style>
        .get {
            background: #1E5B94;
            color: #fff;
            text-align: center;
            padding: 100px 0;
        }

        .get-title {
            font-size: 200%;
            border: 2px solid #fff;
            padding: 20px;
            display: inline-block;
        }

        .get-btn {
            background: #fff;
        }

        .detail {
            background: #fff;
        }

        .detail-h2 {
            text-align: center;
            font-size: 150%;
            margin: 40px 0;
        }

        .detail-h3 {
            color: #1f8dd6;
        }

        .detail-p {
            color: #7f8c8d;
        }

        .detail-mb {
            margin-bottom: 30px;
        }

        .hope {
            background: #0bb59b;
            padding: 50px 0;
        }

        .hope-img {
            text-align: center;
        }

        .hope-hr {
            border-color: #149C88;
        }

        .hope-title {
            font-size: 140%;
        }

        .footer p {
            color: #7f8c8d;
            margin: 0;
            padding: 15px 0;
            text-align: center;
            background: #2d3e50;
        }
    </style>
</head>
<body>
<header class="am-topbar am-topbar-fixed-top">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="#">WEB-CRONTAB</a>
        </h1>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
                data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
                    class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="collapse-head">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li class="am-active"><a href="#">首页</a></li>
                <li><a href="/project/index">项目</a></li>
            </ul>

            <div class="am-topbar-right">
                <a href="/sign_in">
                    <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm"><span class="am-icon-pencil"></span> 注册</button>
                </a>
            </div>

            <div class="am-topbar-right">
                <a href="/login">
                    <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm"><span class="am-icon-user"></span> 登录</button>
                </a>
            </div>
        </div>
    </div>
</header>

<div class="get">
    <div class="am-g">
        <div class="am-u-lg-12">
            <h1 class="get-title">web-crontab 多目标主机的定时任务管理</h1>

            <p>
                期待你的参与，共同打造一个简单易用的定时任务管理系统
            </p>

            <p>
                <a href="http://amazeui.org" class="am-btn am-btn-sm get-btn">获取新get技能√</a>
            </p>
        </div>
    </div>
</div>

<div class="detail">
    <div class="am-g am-container">
        <div class="am-u-lg-12">
            <h2 class="detail-h2">基于web的 、多主机的，安全的任务管理!</h2>

            <div class="am-g">
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

                    <h3 class="detail-h3">
                        <i class="am-icon-mobile am-icon-sm"></i>
                        为WEB而生
                    </h3>

                    <p class="detail-p">
                        部署简单，使用简单。随时随地在浏览器上即可管理过个主机任务。可以使用版本为单位发布，方便查看历史记录，支持回滚；也可以便捷编辑，直接操作远程主机
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-cogs am-icon-sm"></i>
                        多主机
                    </h3>

                    <p class="detail-p">
                        基于项目版本为单位的，可以关联多个主机，一键发布当多个目标主机，省去人工检查，可以一键回滚到历史版本，一切都有跟可寻
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-check-square-o am-icon-sm"></i>
                        开源
                    </h3>

                    <p class="detail-p">
                        不满足已有功能，允许修改任何源码实现，基于MIT协议开源，可以复制、修改、发表、再授权。
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-send-o am-icon-sm"></i>
                        安全
                    </h3>

                    <p class="detail-p">
                        是用ssh扩展链接远程目标主机，在目标机配置好公钥，可以不保存账号密码；如果只是开发者使用，也可以在本地开发机部署，使用账号密码登录；方便安全
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hope">
    <div class="am-g am-container">
        <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
            <img src="assets/i/examples/landing.png" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
            <hr class="am-article-divider am-show-sm-only hope-hr">
        </div>
        <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
            <h2 class="hope-title">同我们一起打造一个简单易用的定时任务管理系统</h2>

            <p>
                在知识爆炸的年代，我们不愿成为知识的过客，拥抱开源文化，发挥社区的力量，参与到web-crontab开源项目能获得自我提升。
            </p>
        </div>
    </div>
</div>

<footer class="footer">
    <p>© 2018 <a href="https://github.com/ctfang/web-crontab" target="_blank">The source address</a> Licensed under <a
                href="http://opensource.org/licenses/MIT" target="_blank">MIT license</a>. by the WEB-CRONTAB Team.</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/assets/js/amazeui.min.js"></script>
</body>
</html>
