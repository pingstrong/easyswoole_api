@extends('layouts.admin')
@section('header_style')
<link rel="stylesheet" href="/css/public.css" media="all">
@endsection
@section('body')
<div class="layuimini-container">
  <div class="layuimini-main">
    <div id="rule" class="tree-rule-more"></div>
    
      <div class="" style="margin:20px 10px">
          <button class="layui-btn layui-btn-normal" lay-demo="save">保存</button>
      </div>
 
     
  </div>
</div>
@endsection


@section('footer_js')
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
var rules = [], rules_checked =[];
function getCheck(data)
{
    for(var x in data) {
        rules.push(data[x].id);
        if(data[x].children){
            getCheck(data[x].children)
        } else {
            rules_checked.push(data[x].id);
        }
    }
}
 

layui.use(['tree', 'util'], function(){
  var tree = layui.tree
  ,layer = layui.layer
  ,util = layui.util
  ,data = @json($data);
    
  //基本
  tree.render({
    elem: '#rule'
    ,data: data
    ,showCheckbox: true  //是否显示复选框
    ,id: 'rules'
    ,isJump: true //是否允许点击节点时弹出新窗口跳转
    ,treeConfig:{ //表格树所需配置
        showField:'name' //表格树显示的字段
        ,treeid:'id' //treeid所对应字段的值在表格数据中必须是唯一的，且不能为空。
        ,treepid:'pid'//父级id字段名称
        ,iconClass:'layui-icon-triangle-r' //小图标class样式 窗口图标 layui-icon-layer
    } 
     
  });

  //按钮事件
  util.event('lay-demo', {
    save: function(othis){
		var checkedData = tree.getChecked('rules'); //获取选中节点的数据
        getCheck(checkedData);

        let datajson = {'rules_checked':rules_checked, 'rules' : rules };
        http_post('/backdata/role/edit_rule/{{$id}}', datajson, function(result){
            if(result.code !== 0) {
                layer.msg(result.msg);
            } else {
                layer.msg('变更成功',{time:1000}, function(){
                    parent.layer.close(parent.layer.getFrameIndex(window.name)); //再执行关闭
                });

            }
        })
        
        rules_checked = [];
        rules = [];
    }
  });
  var checked = @json($checked);
  tree.setChecked('rules', checked.map(Number));

});
</script>
@endsection