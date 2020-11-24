@extends('admin.auth.userBase')

@section('body-title')
    {{-- <div class="layui-card-header">添加用户</div> --}}
@endsection
@section('footer_js')
<script>
layui.use('form', function(){
	var form = layui.form, $ = layui.jquery,form_field;

 
	form.verify({
		pwd: [
			/^[\S]{6,12}$/
			,'密码必须6到15位，且不能出现空格'
		],
		verify_pwd:function(value, item){
			var pwd = $("input[name='pwd']").val();
			if(pwd !== value) {
				return '两次输入的密码不一致';
			}
		}
	});

	//监听提交
	form.on('submit(submit)', function(data){
		form_field = data;
		delete data.field.verify_pwd;
		data.field.status = data.field.status ? 1 : 0;
		http_post('/backdata/auth/add', data.field, function(result){
			if(result.code != 0) {
				layer.msg(result.msg);
			} else {
				layer.msg("添加成功", {
					icon: 1,
					time: 2000,
					end: function () {
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index);
					}
				});
				 
			}
		})
		 
		return false;
	});
});
</script>
@endsection
