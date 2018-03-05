@extends('layouts.master')

@section('content')
    <ol class="am-breadcrumb">
        <li><a href="/project" class="am-icon-home">首页</a></li>
        <li><a href="/project">上线</a></li>
        <li class="am-active">列表</li>
    </ol>

    <div class="button-line">
        <h2>测试环境</h2><hr>
        @foreach($TestEnv as $env)
            <a class="am-btn am-btn-success a-line" href="/use/check/{{ $env->id  }}">{{ $env->title }}</a>
        @endforeach
        <h2>预发布环境</h2><hr>
        @foreach($RcEnv as $env)
            <a class="am-btn am-btn-warning a-line" href="/use/check/{{ $env->id  }}">{{ $env->title }}</a>
        @endforeach
        <h2>线上环境</h2><hr>
        @foreach($StableEnv as $env)
            <a class="am-btn am-btn-danger a-line" href="/use/check/{{ $env->id  }}">{{ $env->title }}</a>
        @endforeach

    </div>

@endsection

@section('bodyEnd')
    <style>
        .button-line {
            margin-top: 20px;
        }
        .a-line {
            margin-right: 20px;
            margin-top: 20px;
        }
    </style>
@endsection