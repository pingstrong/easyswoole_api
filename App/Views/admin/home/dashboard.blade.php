@extends('layouts.admin')

@section('body')
    

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            访问量
            <span class="layui-badge layui-bg-blue layuiadmin-badge">周</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p class="layuiadmin-big-font">9,999,666</p>
            <p>
              总计访问量 
              <span class="layuiadmin-span-color">88万 <i class="layui-inline layui-icon layui-icon-flag"></i></span>
            </p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            下载
            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p class="layuiadmin-big-font">33,555</p>
            <p>
              新下载 
              <span class="layuiadmin-span-color">10% <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
            </p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            收入
            <span class="layui-badge layui-bg-green layuiadmin-badge">年</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">

            <p class="layuiadmin-big-font">999,666</p>
            <p>
              总收入 
              <span class="layuiadmin-span-color">*** <i class="layui-inline layui-icon layui-icon-dollar"></i></span>
            </p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            活跃用户
            <span class="layui-badge layui-bg-orange layuiadmin-badge">月</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">

            <p class="layuiadmin-big-font">66,666</p>
            <p>
              最近一个月 
              <span class="layuiadmin-span-color">15% <i class="layui-inline layui-icon layui-icon-user"></i></span>
            </p>
          </div>
        </div>
      </div> 
      
    
      
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            活跃用户
            <span class="layui-badge layui-bg-orange layuiadmin-badge">月</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">

            <p class="layuiadmin-big-font">66,666</p>
            <p>
              最近一个月 
              <span class="layuiadmin-span-color">15% <i class="layui-inline layui-icon layui-icon-user"></i></span>
            </p>
          </div>
        </div>
      </div>
 
    </div>
    <!-- 百度Echart插件展示数据，饼状图、 折线图、柱状图、自定义混合-->
    <div class="layui-row layui-col-space15">

        <div class="layui-col-md6">
          <div class="layui-card">
            <div class="layui-card-header layui-bg-blue">用户增长</div>
            <div class="layui-card-body">

              <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-user-inc">
                <div carousel-item id="chart_user_inc">
                  <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="layui-col-md6">
          <div class="layui-card">
            <div class="layui-card-header layui-bg-blue">订单销量</div>
            <div class="layui-card-body">
              
              <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-order">
                <div carousel-item id="chart_order_sales">
                  <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="layui-col-md6">
          <div class="layui-card">
            <div class="layui-card-header layui-bg-blue">资产变化</div>
            <div class="layui-card-body">
              
              <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-finance">
                <div carousel-item id="chart_finance_change">
                  <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                </div>
              </div>

            </div>
          </div>
        </div>
        
        <div class="layui-col-md6">
          <div class="layui-card">
            <div class="layui-card-header layui-bg-blue">用户活跃度</div>
            <div class="layui-card-body">
             
              <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-user-active">
                <div carousel-item id="chart_user_active">
                  <div  ><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
        
      </div>
    </div>
  </div>
  
@endsection

@section('javascriptFooter')
    
<script type="text/javascript">

  
   layui.use(['index', 'table', 'echarts', 'carousel'], function(){
    var table = layui.table,
        echarts = layui.echarts,
       carousel = layui.carousel,
       jQuery = layui.$;
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
    //用户增长
    var chartUserInc = echarts.init(jQuery('#chart_user_inc').children("div")[0], layui.echartsTheme)
    var optionchart = {
				tooltip: {
					trigger: "axis"
				},
				legend: {
          data: ["男性", "女性"],
				},
				calculable: !0,
				xAxis: [{
					type: "category",
					data: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
				}],
				yAxis: [{
					type: "value"
				}],
				series: [{
					name: "男性",
					type: "bar",
					data: [2, 4.9, 7, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20, 6.4, 3.3],
				}, {
					name: "女性",
					type: "bar",
					data: [2.6, 5.9, 9, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6, 2.3],
				}]
      }
    
    chartUserInc.setOption(optionchart, true);
    window.onresize = chartUserInc.resize
    //订单销量
    
    var chartOrderSales = echarts.init(jQuery('#chart_order_sales').children("div")[0], layui.echartsTheme)
    //指定图表配置项和数据
    var optionchart =  
       {
			 
				tooltip: {
					trigger: "axis"
				},
				legend: {
					data: ["男装", "女装"]
				},
				calculable: !0,
				xAxis: [{
					type: "category",
					boundaryGap: !1,
					data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]
				}],
				yAxis: [{
					type: "value",
				 
				}],
				series: [{
					name: "男装",
					type: "line",
					data: [100, 3900, 159, 2000, 30000, 1000, 9000],
				 
				}, {
					name: "女装",
					type: "line",
					data: [900, 2182, 909, 599, 366, 2000, 1290],
					 
				}]
			}
    
      chartOrderSales.setOption(optionchart, true);
      window.onresize = chartOrderSales.resize
      //资产变化
      var chartFinanceChange = echarts.init(jQuery('#chart_finance_change').children("div")[0], layui.echartsTheme)
      var optionchart = {
					tooltip: {
						trigger: "axis"
					},
					legend: {
						data: ["余额", "金币", "积分", "USDT", "BTC"]
					},
					calculable: !0,
					xAxis: [{
						type: "category",
						boundaryGap: !1,
						data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]
					}],
					yAxis: [{
						type: "value"
					}],
					series: [{
						name: "余额",
						type: "line",
						stack: "总量",
						data: [120, 132, 101, 134, 90, 230, 210]
					}, {
						name: "金币",
						type: "line",
						stack: "总量",
						data: [220, 182, 191, 234, 290, 330, 310]
					}, {
						name: "积分",
						type: "line",
						stack: "总量",
						data: [150, 232, 201, 154, 190, 330, 410]
					}, {
						name: "USDT",
						type: "line",
						stack: "总量",
						data: [320, 332, 301, 334, 390, 330, 320]
					}, {
						name: "BTC",
						type: "line",
						stack: "总量",
						data: [820, 932, 901, 934, 1290, 1330, 1320]
					}]
				}

      chartFinanceChange.setOption(optionchart, true);
      window.onresize = chartFinanceChange.resize
      //用户活跃度
    var chartUserActive = echarts.init(jQuery('#chart_user_active').children("div")[0], layui.echartsTheme)
    var  optionchart = {
           
          tooltip: {
              trigger: 'item',
              formatter: '{a} <br/>{b} : {c} ({d}%)'
          },
          legend: {
              orient: 'vertical',
              left: 'left',
              data: ['直接访问', '邮件营销', '联盟广告', '视频广告', '搜索引擎']
          },
          series: [
              {
                  name: '访问来源',
                  type: 'pie',
                  radius: '55%',
                  center: ['50%', '60%'],
                  data: [
                      {value: 335, name: '直接访问'},
                      {value: 310, name: '邮件营销'},
                      {value: 234, name: '联盟广告'},
                      {value: 135, name: '视频广告'},
                      {value: 1548, name: '搜索引擎'}
                  ],
                  emphasis: {
                      itemStyle: {
                          shadowBlur: 10,
                          shadowOffsetX: 0,
                          shadowColor: 'rgba(0, 0, 0, 0.5)'
                      }
                  }
              }
          ]
      };
      
      chartUserActive.setOption(optionchart, true);
      window.onresize = chartUserActive.resize


  }); 
  </script>

@endsection