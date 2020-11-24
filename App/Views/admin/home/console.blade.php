
@extends('layouts.admin')
@section('title', '控制面板')
@section('header_style')
<link rel="stylesheet" href="/lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
<link rel="stylesheet" href="/css/public.css" media="all">
<style>
  .layui-card {border:1px solid #f2f2f2;border-radius:5px;}
  .icon {margin-right:10px;color:#1aa094;}
  .icon-cray {color:#ffb800!important;}
  .icon-blue {color:#1e9fff!important;}
  .icon-tip {color:#ff5722!important;}
  .layuimini-qiuck-module {text-align:center;margin-top: 10px}
  .layuimini-qiuck-module a i {display:inline-block;width:100%;height:60px;line-height:60px;text-align:center;border-radius:2px;font-size:30px;background-color:#F8F8F8;color:#333;transition:all .3s;-webkit-transition:all .3s;}
  .layuimini-qiuck-module a cite {position:relative;top:2px;display:block;color:#666;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;font-size:14px;}
  .welcome-module {width:100%;height:210px;}
  .panel {background-color:#fff;border:1px solid transparent;border-radius:3px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}
  .panel-body {padding:10px}
  .panel-title {margin-top:0;margin-bottom:0;font-size:12px;color:inherit}
  .label {display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em;margin-top: .3em;}
  .layui-red {color:red}
  .main_btn > p {height:40px;}
  .layui-bg-number {background-color:#F8F8F8;}
  .layuimini-notice:hover {background:#f6f6f6;}
  .layuimini-notice {padding:7px 16px;clear:both;font-size:12px !important;cursor:pointer;position:relative;transition:background 0.2s ease-in-out;}
  .layuimini-notice-title,.layuimini-notice-label {
      padding-right: 70px !important;text-overflow:ellipsis!important;overflow:hidden!important;white-space:nowrap!important;}
  .layuimini-notice-title {line-height:28px;font-size:14px;}
  .layuimini-notice-extra {position:absolute;top:50%;margin-top:-8px;right:16px;display:inline-block;height:16px;color:#999;}
</style>
@endsection
@section('body')
<div class="layuimini-container">
  <div class="layuimini-main">
      <div class="layui-row layui-col-space15">
          <div class="layui-col-md8">
              <div class="layui-row layui-col-space15">
                  <div class="layui-col-md6">
                      <div class="layui-card">
                          <div class="layui-card-header"><i class="fa fa-warning icon"></i>数据统计</div>
                          <div class="layui-card-body">
                              <div class="welcome-module">
                                  <div class="layui-row layui-col-space10">
                                      <div class="layui-col-xs6">
                                          <div class="panel layui-bg-number">
                                              <div class="panel-body">
                                                  <div class="panel-title">
                                                      <span class="label pull-right layui-bg-blue">实时</span>
                                                      <h5>用户统计</h5>
                                                  </div>
                                                  <div class="panel-content">
                                                      <h1 class="no-margins">1234</h1>
                                                      <small>当前分类总记录数</small>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="layui-col-xs6">
                                          <div class="panel layui-bg-number">
                                              <div class="panel-body">
                                                  <div class="panel-title">
                                                      <span class="label pull-right layui-bg-cyan">实时</span>
                                                      <h5>商品统计</h5>
                                                  </div>
                                                  <div class="panel-content">
                                                      <h1 class="no-margins">1234</h1>
                                                      <small>当前分类总记录数</small>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="layui-col-xs6">
                                          <div class="panel layui-bg-number">
                                              <div class="panel-body">
                                                  <div class="panel-title">
                                                      <span class="label pull-right layui-bg-orange">实时</span>
                                                      <h5>浏览统计</h5>
                                                  </div>
                                                  <div class="panel-content">
                                                      <h1 class="no-margins">1234</h1>
                                                      <small>当前分类总记录数</small>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="layui-col-xs6">
                                          <div class="panel layui-bg-number">
                                              <div class="panel-body">
                                                  <div class="panel-title">
                                                      <span class="label pull-right layui-bg-green">实时</span>
                                                      <h5>订单统计</h5>
                                                  </div>
                                                  <div class="panel-content">
                                                      <h1 class="no-margins">1234</h1>
                                                      <small>当前分类总记录数</small>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="layui-col-md6">
                      <div class="layui-card">
                          <div class="layui-card-header"><i class="fa fa-credit-card icon icon-blue"></i>快捷入口</div>
                          <div class="layui-card-body">
                              <div class="welcome-module">
                                  <div class="layui-row layui-col-space10 layuimini-qiuck">
                                      <div class="layui-col-xs3 layuimini-qiuck-module">
                                          <a href="javascript:;" layuimini-content-href="page/menu.html" data-title="菜单管理" data-icon="fa fa-window-maximize">
                                              <i class="fa fa-window-maximize"></i>
                                              <cite>菜单管理</cite>
                                          </a>
                                      </div>
                                      <div class="layui-col-xs3 layuimini-qiuck-module">
                                          <a href="javascript:;" layuimini-content-href="page/setting.html" data-title="系统设置" data-icon="fa fa-gears">
                                              <i class="fa fa-gears"></i>
                                              <cite>系统设置</cite>
                                          </a>
                                      </div>
                                      <div class="layui-col-xs3 layuimini-qiuck-module">
                                          <a href="javascript:;" layuimini-content-href="page/table.html" data-title="表格示例" data-icon="fa fa-file-text">
                                              <i class="fa fa-file-text"></i>
                                              <cite>表格示例</cite>
                                          </a>
                                      </div>
                                      <div class="layui-col-xs3 layuimini-qiuck-module">
                                          <a href="javascript:;" layuimini-content-href="page/icon.html" data-title="图标列表" data-icon="fa fa-dot-circle-o">
                                              <i class="fa fa-dot-circle-o"></i>
                                              <cite>图标列表</cite>
                                          </a>
                                      </div>
                                      <div class="layui-col-xs3 layuimini-qiuck-module">
                                          <a href="javascript:;" layuimini-content-href="page/form.html" data-title="表单示例" data-icon="fa fa-calendar">
                                              <i class="fa fa-calendar"></i>
                                              <cite>表单示例</cite>
                                          </a>
                                      </div>
                                      <div class="layui-col-xs3 layuimini-qiuck-module">
                                          <a href="javascript:;" layuimini-content-href="page/404.html" data-title="404页面" data-icon="fa fa-hourglass-end">
                                              <i class="fa fa-hourglass-end"></i>
                                              <cite>404页面</cite>
                                          </a>
                                      </div>
                                      <div class="layui-col-xs3 layuimini-qiuck-module">
                                          <a href="javascript:;" layuimini-content-href="page/button.html" data-title="按钮示例" data-icon="fa fa-snowflake-o">
                                              <i class="fa fa-snowflake-o"></i>
                                              <cite>按钮示例</cite>
                                          </a>
                                      </div>
                                      <div class="layui-col-xs3 layuimini-qiuck-module">
                                          <a href="javascript:;" layuimini-content-href="https://www.baidu.com" data-title="百度搜索" data-icon="fa fa-search">
                                              <i class="fa fa-search"></i>
                                              <cite>百度搜索</cite>
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
                  <div class="layui-col-md12">
                       <!-- 登录记录 -->
                      @component('admin.index.login_log')
                      @endcomponent
                  </div>
              </div>
          </div>

          <div class="layui-col-md4">

              <div class="layui-card">
                <div class="layui-card-header"><i class="fa fa-paper-plane-o icon"></i>平台总资产</div>
                <div class="layui-card-body layui-text layadmin-text">
                  
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
                  <div class="layui-card-header"><i class="fa fa-fire icon"></i>版本信息</div>
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
                           
                          <tr>
                              <td>主要特色</td>
                              <td>零门槛 / 响应式 / 清爽 / 极简</td>
                          </tr>
                          <tr>
                            <td>CPU负载</td>
                            <td><p>1分钟：{{$sysinfo['sys_loadavg'][0]}} <br/>5分钟：{{$sysinfo['sys_loadavg'][1]}} <br/>15分钟：{{$sysinfo['sys_loadavg'][2]}} </p></td>
                        </tr>
                        <tr>
                          <td>内存占用率</td>
                          <td>
                            <div class="layui-progress">
                              <div class="layui-progress-bar layui-bg-blue" lay-percent="50%"></div>
                            </div>
                            
                          </td>
                      </tr>
                          
                          </tbody>
                      </table>
                  </div>
              </div>

              

          
      </div>
  </div>
</div>

 
  @endsection

  @section('footer_js')
      <script>
        layui.use(['layer', 'miniTab'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            miniTab = layui.miniTab;

        miniTab.listen();
        })
      </script>
  @endsection