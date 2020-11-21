<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="images/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
    @yield('stylesheet')
    {{-- <script src="/js/jquery.min.js" charset="utf-8"></script>
    <script src="/layui/layui.js" charset="utf-8"></script>
    <script src="/layer/layer.min.js"></script> --}}
    <script src="/layuiadmin/layui/layui.js"></script>  
    <script src="/js/jquery.min.js" charset="utf-8"></script>
    <script src="/js/axios.min.js" charset="utf-8"></script>
    <script src="/js/global.js" charset="utf-8"></script>
    <script>

         layui.config({
            base: '/layuiadmin/', //静态资源所在路径
            //echarts: '/layuiadmin/lib/extend/echart.js',
        }).extend({
            index: 'lib/index', //主入口模块
        }).use(['index']);
    </script>

    @yield('javascriptHeader')
	<style type="text/css">
    	* {
    		margin: 0px;
			padding: 0px;
			list-style: none;
    	}

        .white {
            background-color: #fff;
        }

        .p20 {
            padding:20px;
        }
    </style>
</head>
<body class="@yield('body-class', "")">
	@yield('header')

	@yield('body')

	@yield('footer')

    
    @yield('javascriptFooter')
</body>
</html>