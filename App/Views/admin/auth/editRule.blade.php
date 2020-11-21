@extends('layouts.admin')

@section('body')
<div id="rule" class="tree-rule-more"></div>

<div class="layui-btn-container p20">
  	<button type="button" class="layui-btn layui-btn-sm" lay-demo="save">保存</button>
</div>
@endsection


@section('javascriptFooter')
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
 
 //模拟数据2
 var data2 = [{
    title: '早餐'
    ,id: 1
    ,children: [{
      title: '油条'
      ,id: 5
    },{
      title: '包子'
      ,id: 6
    },{
      title: '豆浆'
      ,id: 7
    }]
  },{
    title: '午餐'
    ,id: 2
    ,checked: true
    ,children: [{
      title: '藜蒿炒腊肉'
      ,id: 8
    },{
      title: '西湖醋鱼'
      ,id: 9
    },{
      title: '小白菜'
      ,id: 10
    },{
      title: '海带排骨汤'
      ,id: 11
    }]
  },{
    title: '晚餐'
    ,id: 3
    ,children: [{
      title: '红烧肉'
      ,id: 12
      ,fixed: true
    },{
      title: '番茄炒蛋'
      ,id: 13
    }]
  },{
    title: '夜宵'
    ,id: 4
    ,children: [{
      title: '小龙虾'
      ,id: 14
      ,checked: true
    },{
      title: '香辣蟹'
      ,id: 15
      ,disabled: true
    },{
      title: '烤鱿鱼'
      ,id: 16
    }]
  }];
   //仅节点左侧图标控制收缩
   tree.render({
    elem: '#rule'
    ,data: data2
    ,onlyIconControl: true  //是否仅允许节点左侧图标控制展开收缩
    ,click: function(obj){
      layer.msg(JSON.stringify(obj.data));
    }
  });
  //基本演示
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