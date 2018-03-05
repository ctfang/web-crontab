@extends('layouts.master')

@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">

            <ol class="am-breadcrumb">
                <li><a href="/project" class="am-icon-home">首页</a></li>
                <li><a href="/env">环境管理</a></li>
                <li class="am-active">列表</li>
            </ol>

            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="/env/create" class="am-btn am-btn-success">
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
                                <th class="table-title">标题</th>
                                <th class="table-type">地址(点击查看)</th>
                                <th class="table-author am-hide-sm-only">类型</th>
                                <th class="table-date am-hide-sm-only">修改日期</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td><a href="/env/modify/{{ $data->id }}">{{ $data->title }}</a></td>
                                    <td class="am-hide-sm-only"><a href="/env/modify/{{ $data->id }}">{{ $data->host }}</a></td>
                                    <td class="am-hide-sm-only">{{ $data->type }}</td>
                                    <td class="am-hide-sm-only">{{ $data->updated_at }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="/env/edit/{{ $data->id }}" class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                                    <span class="am-icon-pencil-square-o"></span> 编辑
                                                </a>
                                                <a class="am-btn am-btn-default am-btn-xs am-text-secondary test-button" data-id="{{ $data->id }}">
                                                    <span class="am-icon-pencil-square-o"></span> 测试
                                                </a>
                                                <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only am-icon-trash-o" data-id="{{ $data->id }}">
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
                            共 {{ $lists->count() }} 条记录

                            <div class="am-fr">
                                <ul class="am-pagination">
                                    <li><a href="{{ $lists->previousPageUrl() }}">«</a></li>
                                    <li><a href="{{ $lists->nextPageUrl() }}">»</a></li>
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
                    $.post('/env/destroy/'+id,function (data) {
                        location.reload()
                    })
                }
            });
        });

        $('#doc-modal-list').find('.test-button').on('click', function (e) {
            var id = $(e.target).data('id');
            $.get('/env/test/'+id,function (data) {
                if( data.code==0 ){
                    alert("链接成功");
                }else{
                    alert("链接失败");
                }
            })
        });
    </script>
@endsection