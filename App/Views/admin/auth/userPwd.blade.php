@extends('layouts.admin')

@section('header_style')
<link rel="stylesheet" href="/css/public.css" media="all">
@endsection
@section('body')
 
<div class="layuimini-container">
    <div class="layuimini-main">

        <div class="layui-form layuimini-form">
            <div class="layui-form-item">
                <label class="layui-form-label required">旧的密码</label>
                <div class="layui-input-block">
                    <input type="password" name="old_pwd" lay-verify="required|pwd" lay-reqtext="旧的密码不能为空" placeholder="请输入旧的密码"  value="" class="layui-input">
                    <tip>填写自己账号的旧的密码。</tip>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label required">新的密码</label>
                <div class="layui-input-block">
                    <input type="password" name="pwd" lay-verify="required|pwd" lay-reqtext="新的密码不能为空" placeholder="请输入新的密码"  value="" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label required">确认密码</label>
                <div class="layui-input-block">
                    <input type="password" name="verify_pwd" lay-verify="required|verify_pwd" lay-reqtext="新的密码不能为空" placeholder="请输入新的密码"  value="" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认修改</button>
                </div>
            </div>
        </div>
    </div>
</div>
  
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
    form.on('submit(saveBtn)', function(data){
        form_field = data;
        delete data.field.verify_pwd;
        http_post('/backdata/auth/pwd',data.field, function(result){
            layer.msg(result.msg);
        })
        
        return false;
    });
});
</script>
@endsection