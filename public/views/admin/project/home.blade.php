@extends('layouts.master')

@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">

            <ol class="am-breadcrumb">
                <li><a href="/project" class="am-icon-home">首页</a></li>
                <li><a href="/project">项目</a></li>
                <li class="am-active">列表</li>
            </ol>

            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="/project/create" class="am-btn am-btn-success">
                                <span class="am-icon-plus"></span>
                                新增
                            </a>
                        </div>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field">
                        <span class="am-input-group-btn">
                            <button class="am-btn am-btn-default" type="button">搜索</button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form" id="doc-modal-list">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="table-id">ID</th>
                                <th class="table-title">标题(进入任务)</th>
                                <th class="table-type">状态</th>
                                <th class="table-author am-hide-sm-only">作者</th>
                                <th class="table-date am-hide-sm-only">修改日期</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td><a href="/project/commands/{{ $group->id }}">{{ $group->title }}</a></td>
                                    <td>{{ $group->status?'开启':'关闭' }}</td>
                                    <td class="am-hide-sm-only">{{ $group->getAuthor->username }}</td>
                                    <td class="am-hide-sm-only">{{ $group->updated_at }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="/project/show/{{ $group->id }}" class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                                    <span class="am-icon-pencil-square-o"></span> 编辑
                                                </a>
                                                <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only am-icon-trash-o" data-id="{{ $group->id }}">
                                                    删除
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="am-cf">
                            共 {{ $groups->count() }} 条记录

                            <div class="am-fr">
                                <ul class="am-pagination">
                                    <li><a href="{{ $groups->previousPageUrl() }}">«</a></li>
                                    <li><a href="{{ $groups->nextPageUrl() }}">»</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
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
@endsection

@section('bodyEnd')
    <script language="JavaScript">
        $('#doc-modal-list').find('.am-icon-trash-o').add('#doc-confirm-toggle').on('click', function () {
            $('#my-confirm').modal({
                relatedTarget: this,
                onConfirm: function (options) {
                    var $link = $(this.relatedTarget);
                    var id = $link.data('id');
                    $.post('/project/destroy/'+id,function (data) {
                        location.reload()
                    })
                }
            });
        });
    </script>
@endsection