@extends('admin.auth.roleBase')

 
@section('javascriptFooter')
<script>
layui.use('form', function(){
  var form = layui.form;

  //监听提交
  form.on('submit(submit)', function(data){
    $.post('/backdata/role/add',data.field,function(info){
        if(info.code != 0) {
            layer.msg(info.msg);
        } else {
            layer.msg('添加成功',{time:1000},function(){
                location.href = '/backdata/role';
            });

        }
    });
    return false;
  });
});
</script>
@endsection
