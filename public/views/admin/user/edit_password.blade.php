@extends('layouts.master')

@section('content')

    <ol class="am-breadcrumb">
        <li><a href="/project" class="am-icon-home">首页</a></li>
        <li><a href="/user/index">用户管理</a></li>
        <li class="am-active">修改密码</li>
    </ol>

    <hr>

    <div class="am-u-sm-6 am-u-lg-offset-3">

        <form action="/user/edit-password" method="post" class="am-form" data-am-validator>
            <fieldset>
                <br><br>
                <div class="am-form-group">
                    <label for="doc-vld-pwd-1">新密码：</label>
                    <input type="password" name="password" id="doc-vld-pwd-1" placeholder="6 位数字或字符" minlength="6" required/>
                </div>

                <div class="am-form-group">
                    <label for="doc-vld-pwd-2">确认密码：</label>
                    <input type="password" id="doc-vld-pwd-2" placeholder="请与上面输入的值一致" data-equal-to="#doc-vld-pwd-1" required/>
                </div>

                <div class="am-form-group">
                    <button class="am-btn am-btn-default am-container am-btn-success" type="submit">提交</button>
                </div>

            </fieldset>
        </form>

    </div>

@endsection

@section('bodyEnd')
    <script language="JavaScript">


    </script>
@endsection