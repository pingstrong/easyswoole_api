@extends('admin.auth.userBase')


@section('footer_js')
<script>
layui.use('form', function(){
	var form = layui.form, $ = layui.jquery,form_field;
	form.val("form", {
      "uname": "{{ $user_data['uname'] }}",
      "role_id": {{ $user_data['role_id'] }},
      "display_name": "{{ $user_data['display_name'] }}",
      "status": {{ $user_data['status'] }},
    });

	 
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
		http_post('/backdata/auth/edit/{{$id}}',data.field, function(result){
			if(result.code != 0) {
				layer.msg(result.msg);
			} else {
				layer.msg('修改成功',{time:1000},function(){
					parent.layer.close(parent.layer.getFrameIndex(window.name));
					parent.refresh();

				});

			}
		})
		return false;
	});
});
</script>
@endsection
