@extends('layouts.master')

@section('content')
    <ol class="am-breadcrumb">
        <li><a href="/project" class="am-icon-home">首页</a></li>
        <li><a href="/project">项目</a></li>
        <li class="am-active">创建</li>
    </ol>

    <hr>

    <div class="am-u-sm-10">
        <form class="am-form am-form-horizontal" action="/project/store" method="post">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">标题</label>
                <div class="am-u-sm-10">
                    <input type="text" name="title">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">备注</label>
                <div class="am-u-sm-10">
                    <textarea name="remark" rows="5" id="doc-ta-1"></textarea>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">对应环境</label>
                <div class="am-u-sm-10">
                    <select multiple data-am-selected name="type">
                        <option value="1" selected>测试环境</option>
                        <option value="2">预发布环境</option>
                        <option value="3">线上环境</option>
                    </select>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">状态</label>
                <div class="am-u-sm-10">
                    <label class="am-radio-inline">
                        <input type="radio" name="status" value="1" checked="checked"  data-am-ucheck> 启用
                    </label>
                    <label class="am-radio-inline">
                        <input type="radio" name="status" value="0" data-am-ucheck> 停用
                    </label>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">关联环境</label>
                <div class="am-u-sm-10">
                    @foreach($envGroup as $groupName=>$envs)
                        @foreach($envs as $env)
                            <label class="am-checkbox am-secondary">
                                <input type="checkbox" name="hosts[]" value="{{ $env->id }}" data-am-ucheck>
                                {{ $env->title }} : {{ $env->host }}
                            </label>
                        @endforeach
                    @endforeach
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

    <style>
        .am-ucheck-icons {
            color: #999;
            display: block;
            height: 20px;
            top: 0;
            left: 0;
            position: absolute;
            width: 20px;
            text-align: center;
            line-height: 36px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
@endsection