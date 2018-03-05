@extends('layouts.master')

@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <ol class="am-breadcrumb">
                <li><a href="/project" class="am-icon-home">首页</a></li>
                <li><a href="/env/index">环境</a></li>
                <li class="am-active">便捷修改</li>
            </ol>

            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar am-btn-group am-btn-group-xs">
                        <button class="am-btn am-btn-success" data-am-modal="{target: '#my-popup'}">
                            <span class="am-icon-plus"></span> 创建定时任务
                        </button>
                    </div>
                </div>
            </div>

            <br>

            <div class="am-panel-group" id="doc-modal-list">
                @foreach($commands as $command)
                    <div class="am-panel am-panel-default">
                        <div class="am-panel-hd">
                            <p class="am-panel-title"
                               data-am-collapse="{parent: '#accordion', target: '#{{ $command->id }}'}">
                                {{ $command->title?$command->title:$command->command }}
                                <i class="am-close am-close-alt am-close-spin am-icon-times am-fr am-btn-primary"
                                   data-id="{{ $command->id }}_{{ $command->command }}"
                                   data-env="{{ $envId }}"></i>
                            </p>
                        </div>
                        <div id="{{ $command->id }}" class="am-panel-collapse am-collapse">
                            <div class="am-panel-bd">
                                <table class="am-table am-table-bordered am-table-radius">
                                    <thead>
                                    <tr>
                                        <th>属性</th>
                                        <th>键值</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>标题</td>
                                        <td>{{ $command->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>运行规则</td>
                                        <td>{{ $command->run_time }}</td>
                                    </tr>
                                    <tr>
                                        <td>权限</td>
                                        <td>{{ $command->sys_user }}</td>
                                    </tr>
                                    <tr>
                                        <td>命令</td>
                                        <td>{{ $command->command }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
    <!-- content end -->

    <!-- 删除提示 -->
    <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">你，确定要删除这条记录吗？</div>
            <div class="am-modal-bd"></div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>

    <!-- 新增模糊窗口 -->
    <div class="am-popup" id="my-popup">
        <div class="am-popup-inner">
            <div class="am-popup-hd">
                <h4 class="am-popup-title">往服务器添加定时任务</h4>
                <span data-am-modal-close
                      class="am-close">&times;</span>
            </div>
            <br>
            <div class="am-u-sm-12">
                <form class="am-form am-form-horizontal" action="/env/cmd/create/{{ $envId }}" method="post">
                    <div class="am-form-group">
                        <div class="am-u-sm-12">
                            <input type="text" name="title" placeholder="标题备注">
                        </div>
                    </div>

                    <div class="am-form-group">
                        <div class="am-u-sm-12">
                            <input type="text" name="sysUser" placeholder="运行用户:root">
                        </div>
                    </div>

                    <div class="am-form-group">
                        <div class="am-u-sm-12 am-form-inline">
                            <div class="am-form-group">
                                <input type="text" class="am-form-field" style="width: 108px" placeholder="minute"
                                       name="run_time[minute]">
                            </div>
                            <div class="am-form-group">
                                <input type="text" class="am-form-field" style="width: 108px" placeholder="hour"
                                       name="run_time[hour]">
                            </div>
                            <div class="am-form-group">
                                <input type="text" class="am-form-field" style="width: 108px" placeholder="day"
                                       name="run_time[day]">
                            </div>
                            <div class="am-form-group">
                                <input type="text" class="am-form-field" style="width: 108px" placeholder="month"
                                       name="run_time[month]">
                            </div>
                            <div class="am-form-group">
                                <input type="text" class="am-form-field" style="width: 108px" placeholder="week"
                                       name="run_time[week]">
                            </div>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <div class="am-u-sm-12">
                            <input type="text" name="command" placeholder="执行的命令">
                        </div>
                    </div>

                    <div class="am-form-group">
                        <div class="am-u-sm-12">
                            <button type="submit" class="am-btn am-btn-default am-container am-btn-danger">写入服务器
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('bodyEnd')
    <script language="JavaScript">
        $(function () {
            $('#doc-modal-list').find('.am-close').add('#doc-confirm-toggle').on('click', function () {
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function (options) {
                        var $link = $(this.relatedTarget);
                        if ($link.length) {
                            var msg = $link.data('id')
                            var envId = $link.data('env')
                            $.post('/env/stopCmd', {"strCmd": msg,"envId":envId}, function (data) {
                                console.log(data);
                                if (  0 == data.code ){
                                    window.location.replace("/env/modify/"+envId);
                                }else{
                                    alert(data.msg);
                                }
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection