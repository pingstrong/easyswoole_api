@extends('layouts.admin_child')
@section('header_style')
 
@endsection
@section('body')
<fieldset class="table-search-fieldset">
    <legend>搜索信息</legend>
    <div style="margin: 10px 10px 10px 10px">
        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">用户姓名</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">选择框</label>
                    <div class="layui-input-inline">
                      <select name="modules" lay-verify="required" lay-search="">
                        <option value="">直接选择或搜索选择</option>
                        <option value="1">layer</option>
                        <option value="2">form</option>
                        <option value="3">layim</option>
                        <option value="4">element</option>
                        <option value="5">laytpl</option>
                      </select>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">用户性别</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sex" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">开始时间</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="date" id="date_range" placeholder=" ~ ">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">用户城市</label>
                    <div class="layui-input-inline">
                        <input type="text" name="city" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">用户职业</label>
                    <div class="layui-input-inline">
                        <input type="text" name="classify" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                </div>
            </div>
        </form>
    </div>
</fieldset>

<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button>
        <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 删除 </button>
    </div>
</script>

<table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

<script type="text/html" id="currentTableBar">
    <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
</script>

<!-- 状态 -->
<script type="text/html" id="switchStatus1">
    <input type="checkbox" name="status1" value="@{{d.id}}" lay-skin="switch" @if(!in_array('product.information.edit', $account_rule_nodes)) disabled="off" @endif lay-text="启动|禁用" lay-filter="status1" @{{ d.status1 == 1 ? 'checked' : '' }}>
</script>
<!-- 状态 -->
<script type="text/html" id="switchStatus2">
    <input type="checkbox" name="status2" value="@{{d.id}}" lay-skin="switch" @if(!in_array('product.information.edit', $account_rule_nodes)) disabled="off" @endif lay-text="启动|禁用" lay-filter="status2" @{{ d.status2 == 1 ? 'checked' : '' }}>
</script>

@endsection
@section('footer_js')
<script>
    layui.use(['form', 'table', 'laydate'], function () {
        var $ = layui.jquery,
            form = layui.form,
            laydate = layui.laydate,
            table = layui.table;

        table.render({
            elem: '#currentTableId',
            url: '/backdata/product/information/query',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[
                {type: "checkbox", width: 50},
                {field: 'id', width: 80, title: 'ID', sort: true},
                {field: 'username', width: 80, title: '用户名'},
                {field: 'sex', width: 80, title: '性别', sort: true},
                {field: 'city', width: 80, title: '城市'},
                {field: 'sign', title: '签名', minWidth: 150},
                {field: 'experience', width: 80, title: '积分', sort: true},
                {field: 'score', width: 80, title: '评分', sort: true},
                {field: 'classify', width: 80, title: '职业' @if(in_array('product.information.edit', $account_rule_nodes)), event:'edit_classify' @endif},
                {field: 'wealth', width: 135, title: '财富', sort: true},
                {field:'status1', title:'状态1', templet: '#switchStatus1', width:100},
                {field:'status2', title:'状态2', templet: '#switchStatus2', width:100},
                {title: '操作', minWidth: 150, toolbar: '#currentTableBar', align: "center"}
            ]],
            limits: [10, 15, 20, 25, 50, 100],
            limit: 15,
            page: true,
            skin: 'line',
            parseData: function(res){ //将原始数据解析成 table 组件所规定的数据
                return {
                    "code": res.code, //解析接口状态
                    "msg":  res.message, //解析提示文本
                    "count": res.data.total, //解析数据长度
                    "data": res.data.list //解析数据列表
                };
            }
        });

        //日期
        laydate.render({
            elem: '#date_range'
            //,type: 'datetime'
            ,range: '~'
            ,format: 'yyyy-MM-dd'
        });
        
        // 监听搜索操作
        form.on('submit(data-search-btn)', function (data) {
            var result = JSON.stringify(data.field);
            /* layer.alert(result, {
                title: '最终的搜索信息'
            }); */

            //执行搜索重载
            table.reload('currentTableId', {
                page: {
                    curr: 1
                }
                , where: {
                    searchParams: result
                }
            });

            return false;
        });
        //表格单选框
        form.on('switch(status1)', function(obj){
            let datajson = {key:'status1', value:obj.elem.checked ? '1':'0'};
            layer.msg(JSON.stringify(datajson))
          /*   $.post('/backdata/rule/set/' + this.value ,datajson,function(data){
                if(data.code != 0) {
                    layer.msg(data.msg);
                    obj.elem.checked = !obj.elem.checked;
                    form.render();
                }
            }); */
        });
        form.on('switch(status2)', function(obj){
            let datajson = {key:'status2', value:obj.elem.checked ? '1':'0'};
            layer.msg(JSON.stringify(datajson))
        });
        /**
         * toolbar监听事件
         */
        table.on('toolbar(currentTableFilter)', function (obj) {
            if (obj.event === 'add') {  // 监听添加操作
                var index = layer.open({
                    title: '添加',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['90%', '90%'],
                    content: '../page/table/add.html',
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
            } else if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('currentTableId')
                    , data = checkStatus.data;
                layer.alert(JSON.stringify(data));
            }
        });

        //监听表格复选框选择
        table.on('checkbox(currentTableFilter)', function (obj) {
            console.log(obj)
        });

        table.on('tool(currentTableFilter)', function (obj) {
            var data = obj.data;
            if (obj.event === 'edit') {

                var index = layer.open({
                    title: '编辑',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['90%', '90%'],
                    content: '../page/table/edit.html',
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'delete') {
                layer.confirm('真的删除么', function (index) {
                    obj.del();
                    layer.close(index);
                });
            }else if (obj.event === 'edit_classify') {
                layer.prompt({
                    formType: 2
                    ,value: data.classify
                }, function(value, index){
                    layer.close(index);
                    let datajson = {key:'node', value:value};
                    $.post('/xxxxxxxxxxxxxxxxxxxx/' + data.id ,datajson,function(data){
                        if(data.code != 0) {
                            layer.msg(data.msg);
                        } else {
                            obj.update({
                              node: value
                            });
                        }
                    });
                });
            }


        });

    });
</script>
@endsection