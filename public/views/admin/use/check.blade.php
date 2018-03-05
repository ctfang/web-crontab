@extends('layouts.master')

@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <ol class="am-breadcrumb">
                <li><a href="/project" class="am-icon-home">首页</a></li>
                <li><a href="/project">分类</a></li>
                <li class="am-active">编辑</li>
            </ol>


            <table class="am-table am-table-compact">
                <thead>
                <tr>
                    <th style="padding: 0 0 0 0">上线</th>
                    <th>标题</th>
                    <th>权限</th>
                    <th>运行规则</th>
                    <th>命令</th>
                </tr>
                </thead>
                <tbody>
                @foreach($commands as $command)
                    <tr>
                        <td>
                            <span class="am-badge {{ $command->status?"am-badge-success":"am-badge-danger"  }}">{{ $command->status?"YES":"NO"  }}</span>
                        </td>
                        <td>{{ $command->title }}</td>
                        <td>{{ $command->sys_user }}</td>
                        <td>{{ implode(" ",json_decode($command->run_time,true)) }}</td>
                        <td>{{ $command->command }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <button id="doc-prompt-toggle" class="am-btn am-btn-primary">确认上线</button>

            <a href="/project/commands/{{ $command->group_id }}" class="am-btn am-btn-secondary">返回编辑</a>

        </div>

        <br> <br>

    </div>
    <!-- content end -->

    <div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">上线</div>
            <div class="am-modal-bd">
                 输入上线备注
                <input type="text" class="am-modal-prompt-input">
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>

@endsection

@section('bodyEnd')
    <script language="JavaScript">
        $(function() {
            $('#doc-prompt-toggle').on('click', function() {
                $('#my-prompt').modal({
                    relatedTarget: this,
                    onConfirm: function(e) {
                        $.post('/use/push',{"title":e.data,"project":"{{ $command->group_id }}"},function (data) {
                            window.location.replace('/publish/log')
                        })
                    },
                });
            });
        });
    </script>
@endsection