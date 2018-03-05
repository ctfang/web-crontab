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

            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <a href="/crond/create/{{ $group->id  }}" class="am-btn-group am-btn-group-xs">
                            <button class="am-btn am-btn-success">
                                <span class="am-icon-plus"></span>
                                新增
                            </button>
                        </a>
                        <div class="am-btn-group am-btn-group-xs">
                            <button class="am-btn am-btn-success" id="doc-import">
                                <span class="am-icon-cog"></span>
                                从关联服务器导入
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <table class="am-table am-table-bordered" id="doc-modal-list">
                <thead>
                <tr>
                    <th>标题</th>
                    <th>权限</th>
                    <th>状态</th>
                    <th>运行规则</th>
                    <th>命令</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($commands as $command)
                    <tr>
                        <td>{{ $command->title }}</td>
                        <td>{{ $command->sys_user }}</td>
                        <td>{{ $command->status?"启用":"停用" }}</td>
                        <td>{{ implode(" ",json_decode($command->run_time,true)) }}</td>
                        <td> @if(strlen($command->command)>60) {{ substr($command->command,0,60) }}
                            ..... @else {{ $command->command }} @endif</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                       href="/crond/edit/{{ $command->id }}">
                                        <span class="am-icon-pencil-square-o"></span> 编辑
                                    </a>
                                    <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only am-icon-trash-o"
                                       data-id="{{ $command->id }}">
                                        删除
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
    <!-- content end -->

    <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">警告</div>
            <div class="am-modal-bd">
                你，确定要删除这条记录吗？
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-confirm" tabindex="-1" id="my-import">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">导入任务</div>
            <div class="am-modal-bd">
                你，确定要从服务器导入任务？
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>
@endsection

@section('bodyEnd')
    <script language="JavaScript">
        $('#doc-modal-list').find('.am-icon-trash-o').add('#doc-confirm-toggle').on('click', function () {
            $('#my-confirm').modal({
                relatedTarget: this,
                onConfirm: function (options) {
                    var $link = $(this.relatedTarget);
                    var id = $link.data('id');
                    $.post('/crond/destroy/'+id,function (data) {
                        location.reload()
                    })
                }
            });
        });

        $('#doc-import').on('click', function () {
            $('#my-import').modal({
                relatedTarget: this,
                onConfirm: function (options) {
                    var id = "{{ $group->id  }}";
                    $.get('/project/import/'+id,function (data) {
                        location.reload()
                    })
                }
            });
        });
    </script>
@endsection