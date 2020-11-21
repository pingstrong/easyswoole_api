@extends('admin.auth.roleBase')

@section('javascriptFooter')
<script>
 
layui.use('form', function(){
  var form = layui.form;

    form.val("form", {
      "name": "{{ $info['name'] }}"
      ,"detail": "{{ $info['detail'] }}"
      ,"pid": "{{ $info['pid'] }}"
    });

  //监听提交
  form.on('submit(submit)', function(data){
    http_post("/backdata/role/edit/{{$id}}", data.field, function(result){
       if(result.code != 0) {
            layer.msg(result.msg);
        } else {
            layer.msg('编辑成功',{time:1000},function(){
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
