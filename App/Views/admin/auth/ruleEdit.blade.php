@extends('admin.auth.ruleBase')
@section('header_style')
<link rel="stylesheet" href="/lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
<link rel="stylesheet" href="/css/public.css" media="all">
@endsection
@section('footer_js')
<script>

layui.use(['form', 'iconPickerFa', 'jquery'], function(){
	var form = layui.form, iconPickerFa = layui.iconPickerFa, $ = layui.jquery;

	form.val("form", {
		"name": "{{ $info['name'] }}"
		,"node": "{{ $info['node'] }}"
		,"icon": "{{ $info['icon'] }}"
		,"status": {{ $info['status'] }}
		,"is_menu": {{ $info['is_menu'] }}
		,"route_uri": "{!! $info['route_uri'] !!}"
		,"route_handler": "{!! $info['route_handler'] !!}"
	});

	iconPickerFa.render({
        // 选择器，推荐使用input
        elem: '#iconPicker',
        // fa 图标接口
        url: "/lib/font-awesome-4.7.0/less/variables.less",
        // 是否开启搜索：true/false，默认true
        search: true,
        // 是否开启分页：true/false，默认true
        page: true,
        // 每页显示数量，默认12
        limit: 12,
        // 点击回调
        click: function (data) {
            console.log(data);
        },
        // 渲染成功后的回调
        success: function (d) {
            console.log(d);
        }
    });

	//监听提交
	form.on('submit(submit)', function(data){
		data.field.status = data.field.status ? 1 : 0;
		data.field.is_menu = data.field.is_menu ? 1 : 0;
		$.post('/backdata/rule/edit/'+{{ $info['id'] }},data.field,function(info){
		    if(info.code != 0) {
				layer.msg(info.msg);
			} else {
				layer.msg('编辑成功',{time:1000},function(){
		            parent.layer.close(parent.layer.getFrameIndex(window.name));
		            parent.refresh();
		        });
			}
		});
		return false;
	});
});
</script>
@endsection