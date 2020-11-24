@extends('admin.auth.ruleBase')
@section('header_style')
<link rel="stylesheet" href="/lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
<link rel="stylesheet" href="/css/public.css" media="all">
@endsection
@section('body-title')
  {{-- <div class="layui-card-header">@if(isset($info)) {{$info['name']}} -- @endif添加权限</div> --}}
@endsection
@section('footer_js')
<script>

layui.use(['form', 'iconPickerFa', 'layer'], function(){
  var form = layui.form, iconPickerFa = layui.iconPickerFa;

  var form_field;

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
    form_field = data;
    let url = '/backdata/rule/add'
    @if(isset($id))
      url += '/{{$id}}'
    @endif
    http_post(url, data.field, function(result){
        if(result.code != 0) {
            layer.msg(result.msg);
        } else {
            layer.msg('添加成功', {time:1000}, function(){
              var index = parent.layer.getFrameIndex(window.name);
              parent.layer.close(index);
					 
            });
        }
    })
    return false;
  });
  
});
</script>
@endsection