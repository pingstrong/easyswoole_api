
@extends('layouts.admin')
@section('title', '控制面板')
 
@section('body')
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md8">
        <div class="layui-row layui-col-space15">
          <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">快捷方式</div>
              <div class="layui-card-body">
                
                <div class="layui-carousel layadmin-carousel layadmin-shortcut">
                  <div carousel-item>
                    <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs3">
                        <a lay-href="/backdata/dashboard">
                          <i class="layui-icon layui-icon-console"></i>
                          <cite>统计仪表</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="/backdata/role">
                          <i class="layui-icon layui-icon-auz"></i>
                          <cite>角色管理</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="/backdata/rule">
                          <i class="layui-icon layui-icon-template-1"></i>
                          <cite>权限管理</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="/backdata/auth/">
                          <i class="layui-icon layui-icon-user"></i>
                          <cite>管理员</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/system/website.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>常规设置</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a layadmin-event="im">
                          <i class="layui-icon layui-icon-file"></i>
                          <cite>文件管理</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="component/progress/index.html">
                          <i class="layui-icon layui-icon-log"></i>
                          <cite>操作日记</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="app/workorder/list.html">
                          <i class="layui-icon layui-icon-survey"></i>
                          <cite>工单</cite>
                        </a>
                      </li>
                      
                    </ul>
                   {{--  <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                    </ul> --}}
                    
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">待办事项</div>
              <div class="layui-card-body">

                <div class="layui-carousel layadmin-carousel layadmin-backlog">
                  <div carousel-item>
                    <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs6">
                        <a lay-href="app/content/comment.html" class="layadmin-backlog-body">
                          <h3>待审评论</h3>
                          <p><cite>66</cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a lay-href="app/forum/list.html" class="layadmin-backlog-body">
                          <h3>待审帖子</h3>
                          <p><cite>12</cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a lay-href="template/goodslist.html" class="layadmin-backlog-body">
                          <h3>待审商品</h3>
                          <p><cite>99</cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a href="javascript:;" onclick="layer.tips('不跳转', this, {tips: 3});" class="layadmin-backlog-body">
                          <h3>待发货</h3>
                          <p><cite>20</cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a href="javascript:;" onclick="layer.tips('不跳转', this, {tips: 3});" class="layadmin-backlog-body">
                          <h3>待发货</h3>
                          <p><cite>20</cite></p>
                        </a>
                      </li>
                    </ul>
                  {{--   <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs6">
                        <a href="javascript:;" class="layadmin-backlog-body">
                          <h3>待审友情链接</h3>
                          <p><cite style="color: #FF5722;">5</cite></p>
                        </a>
                      </li>
                    </ul> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
           
        </div>

          <div class="layui-row">
          @if($role_group->hasRule('index.login.log'))
            <!-- 登录记录 -->
            @component('admin.index.login_log')
            @endcomponent
          @endif
          </div>

      </div>
      
      <div class="layui-col-md4">
        <div class="layui-card">
          <div class="layui-card-header">平台总资产</div>
          <div class="layui-card-body layui-text">
             <div class="layui-row">
                <div class="layui-col-md4 layui-col-space5">
                   <p>余额</p>
                   <h3>6000</h3>
                </div>
                <div class="layui-col-md4 layui-col-space5">
                  <p>金币</p>
                   <h3>6000</h3>
                </div>
                <div class="layui-col-md4 layui-col-space5">
                  <p>积分</p>
                   <h3>6000</h3>
                </div>
             </div>
             <hr>
             <div class="layui-row ">
              <div class="layui-col-md4 layui-col-space5">
                 <p>USDT</p>
                 <h3>6000</h3>
              </div>
              <div class="layui-col-md4 layui-col-space5">
                <p>BTC</p>
                 <h3>6000</h3>
              </div>
              <div class="layui-col-md4 layui-col-space5">
                <p>LTB</p>
                 <h3>6000</h3>
              </div>
           </div>
          </div>
        </div>

        <div class="layui-card">
          <div class="layui-card-header">实时监控</div>
          <div class="layui-card-body layadmin-takerates">
            <div class="" >
              <h3>CPU负载</h3>
              <p>1分钟：{{$sysinfo['sys_loadavg'][0]}} 5分钟：{{$sysinfo['sys_loadavg'][1]}} 15分钟：{{$sysinfo['sys_loadavg'][2]}} </p>
            </div>
            <div class="layui-progress" lay-showPercent="yes">
              <h3>内存占用率</h3>
              <div class="layui-progress-bar" lay-percent="{{$sysinfo['memory_useavg']}}%"></div>
            </div>
          </div>
        </div>

        <div class="layui-card">
          <div class="layui-card-header">版本信息</div>
          <div class="layui-card-body layui-text">
            <table class="layui-table">
              <colgroup>
                <col width="100">
                <col>
              </colgroup>
              <tbody>
                <tr>
                  <td>当前版本</td>
                  <td>
                     6.0.2
                  </td>
                </tr>
                <tr>
                  <td>基于框架</td>
                  <td>
                    <script type="text/html" template>
                      swoole{{$sysinfo['swoole_version']}}
                    </script>
                 </td>
                </tr>
                <tr>
                  <td>php版本</td>
                  <td>{{$sysinfo['php_version']}}</td>
                </tr>
                <tr>
                  <td>开发版权</td>
                  <td>pingo</td>
                </tr>
                 
              </tbody>
            </table>
          </div>
        </div>
        
        
        
        
         
      </div>
      
    </div>
  </div>

  @endsection

  @section('javascriptFooter')
      <script>
    layui.use(['carousel'], function(carousel){

          //设置轮播参数
      jQuery(".layadmin-carousel").each(function() {
        var t = jQuery(this);
        carousel.render({
          elem: this,
          width: "100%",
          arrow: "none",
          //interval: t.data("interval"),
          //autoplay: t.data("autoplay") === !0,
          //trigger: i.ios || i.android ? "click" : "hover",
          //anim: t.data("anim")
        })
      })
    })
      </script>
  @endsection