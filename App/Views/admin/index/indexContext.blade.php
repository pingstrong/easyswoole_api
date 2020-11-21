@extends('layouts.admin')

@section('stylesheet')
<style type="text/css">
	li .layui-icon {
		display: inline-block;
	    width: 100%;
	    height: 60px;
	    line-height: 60px;
	    text-align: center;
	    border-radius: 2px;
	    font-size: 30px;
	    background-color: #F8F8F8;
	}
	li.layui-col-xs3{
		text-align: center;
	}
</style>
@endsection

@section('body')
<div>
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md8">
			@component('admin.index.quick',['role_group'=>$role_group])
			@endcomponent
			
			@if($role_group->hasRule('index.login.log'))
				<!-- 登录记录 -->
				@component('admin.index.login_log')
				@endcomponent
			@endif
		</div>
		<div class="layui-col-md4">
			
			<div class="layui-card">
				<div class="layui-card-header">版本信息</div>
				<div class="layui-card-body">
					<table class="layui-table">
					    <colgroup>
							<col width="150">
							<col>
					    </colgroup>
						<tr>
							<td>cpu核数</td>
							<td>{{$sysinfo['cpu_num']}}</td>
						</tr>
						<tr>
							<td>swoole版本</td>
							<td>{{$sysinfo['swoole_version']}}</td>
						</tr>
						<tr>
							<td>本地ip地址</td>
							<td>{{$sysinfo['local_ips']}}</td>
						</tr>
						<tr>
							<td>php版本</td>
							<td>{{$sysinfo['php_version']}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascriptFooter')
<script>
$('.Jump').click(function(){
	parent.Jump($(this).attr('src'));
});
</script>
@endsection