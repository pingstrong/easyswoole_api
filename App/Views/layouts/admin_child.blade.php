<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="keywords" content="pingo,swoole管理系统">
    <meta name="description" content="基于layui+swoole的轻量级前端后台管理框架，最简洁、易用的后台框架模板，面向所有层次的前后端程序,只需提供一个接口就直接初始化整个框架，无需复杂操作。">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="images/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="/lib/layui-v2.5.6/css/layui.css" media="all">
    <link rel="stylesheet" href="/lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="/css/public.css" media="all">
    
    @yield('header_style')
    <!-- 注意， 只需要引用 JS，无需引用任何 CSS ！！！-->
    <script src="/lib/layui-v2.5.6/layui.js" charset="utf-8"></script>
    <script src="/js/lay-config.js?v=1.0.5" charset="utf-8"></script>
    <script src="/js/axios.min.js" charset="utf-8"></script>
    <script src="/js/global.js" charset="utf-8"></script>
    @yield('header_js')
</head>
<body class="@yield('body-class', "")">
    <div class="layuimini-container">
        <div class="layuimini-main">
        @yield('body')
        </div>
    </div>
    @yield('footer')
    @yield('footer_js')
</body>
</html>