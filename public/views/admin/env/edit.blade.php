@extends('layouts.master')

@section('content')

    <ol class="am-breadcrumb">
        <li><a href="/project" class="am-icon-home">首页</a></li>
        <li><a href="/env/index">环境</a></li>
        <li class="am-active">编辑</li>
    </ol>

    <hr>

    <div class="am-u-sm-10">
        <form class="am-form am-form-horizontal" action="/env/update/{{ $env->id }}" method="post">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">标题</label>
                <div class="am-u-sm-10">
                    <input type="text" name="title" value="{{ $env->title }}">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">地址</label>
                <div class="am-u-sm-10">
                    <input type="text"  name="host" value="{{ $env->host }}"  placeholder="192.168.0.1" >
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">环境类型</label>
                <div class="am-u-sm-10">
                    <input type="text" name="type" value="{{ $env->type }}">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">备注</label>
                <div class="am-u-sm-10">
                    <textarea name="remark" rows="5" id="doc-ta-1">{{ $env->remark }}</textarea>
                </div>
            </div>

            <hr>
            <p>如果已经配置ssh秒密码登录（建议配置），不需要账号密码</p>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">用户名</label>
                <div class="am-u-sm-10">
                    <input type="text"  name="username" placeholder="root" value="{{ $env->username }}">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">登录密码</label>
                <div class="am-u-sm-10">
                    <input type="password" name="password" placeholder="默认不修改" >
                </div>
            </div>

            <div class="am-form-group">
                <div class="am-u-sm-10 am-u-sm-offset-2">
                    <button type="submit" class="am-btn am-btn-default">提交保存</button>
                </div>
            </div>
        </form>

    </div>

@endsection

@section('bodyEnd')
    <script language="JavaScript">


    </script>
@endsection