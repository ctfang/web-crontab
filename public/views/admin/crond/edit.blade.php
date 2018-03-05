@extends('layouts.master')

@section('content')
    <ol class="am-breadcrumb">
        <li><a href="/project" class="am-icon-home">首页</a></li>
        <li><a href="/project">命令</a></li>
        <li class="am-active">创建</li>
    </ol>

    <hr>

    <div class="am-u-sm-10">
        <form class="am-form am-form-horizontal" action="/crond/update/{{ $command->id }}" method="post">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">命令的标题</label>
                <div class="am-u-sm-10">
                    <input type="text" name="title" value="{{ $command->title }}">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">运行用户</label>
                <div class="am-u-sm-10">
                    <input type="text" name="sysUser" placeholder="root">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">状态</label>
                <div class="am-u-sm-10">
                    <label class="am-radio-inline">
                        <input type="radio" name="status" value="1"
                               {{ $command->status?'checked="checked"':'' }} data-am-ucheck> 启用
                    </label>
                    <label class="am-radio-inline">
                        <input type="radio" name="status" value="0"
                               {{ !$command->status?'checked="checked"':'' }} data-am-ucheck> 停用
                    </label>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">crond规则</label>
                <div class="am-u-sm-10 am-form-inline">
                    <div class="am-form-group">
                        <input type="text" class="am-form-field" value="{{ $command->run_time->minute }}" style="width: 117px" placeholder="minute"
                               name="run_time[minute]">
                    </div>
                    <div class="am-form-group">
                        <input type="text" class="am-form-field" value="{{ $command->run_time->hour }}" style="width: 117px" placeholder="hour"
                               name="run_time[hour]">
                    </div>
                    <div class="am-form-group">
                        <input type="text" class="am-form-field" value="{{ $command->run_time->day }}" style="width: 117px" placeholder="day"
                               name="run_time[day]">
                    </div>
                    <div class="am-form-group">
                        <input type="text" class="am-form-field" value="{{ $command->run_time->month }}" style="width: 117px" placeholder="month"
                               name="run_time[month]">
                    </div>
                    <div class="am-form-group">
                        <input type="text" class="am-form-field" value="{{ $command->run_time->week }}" style="width: 117px" placeholder="week"
                               name="run_time[week]">
                    </div>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">执行的命令</label>
                <div class="am-u-sm-10">
                    <input type="text" name="command" value="{{ $command->command }}">
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