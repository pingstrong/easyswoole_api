$(function(){
    //菜单点击
   
    $(".J_menuItem").on('click',function(){
        var url = $(this).attr('href');
        $("#J_iframe").attr('src',url);
        //$("#J_frameTitle").text($(this).text())
        return false;
    });
});

layui.use(['element'], function(){
    var tabsPage = {}
    var $ = layui.jquery
    ,setter = layui.setter
    ,element = layui.element //Tab的切换功能，切换事件监听等，需要依赖element模块
    //打开标签页
    , APP_BODY = '#LAY_app_body'
    , FILTER_TAB_TBAS = 'layadmin-layout-tabs'
    
    , openTabsPage = function (url, text) {
        //遍历页签选项卡
        var matchTo
            , tabs = $('#LAY_app_tabsheader>li')
            , path = url.replace(/(^http(s*):)|(\?[\s\S]*$)/g, '');

        tabs.each(function (index) {
            var li = $(this)
                , layid = li.attr('lay-id');
            //console.log('index:',index);
            if (layid === url) {
                matchTo = true;
                tabsPage.index = index;
            }
        });

        text = text || '新标签页';

        if (true) {
            //如果未在选项卡中匹配到，则追加选项卡
            if (!matchTo) {
                $(APP_BODY).append([
                    '<div class="layadmin-tabsbody-item layui-show">'
                    , '<iframe src="' + url + '" frameborder="0" class="layadmin-iframe"></iframe>'
                    , '</div>'
                ].join(''));
                tabsPage.index = tabs.length;
               element.tabAdd(FILTER_TAB_TBAS, {
                    title: '<span>' + text + '</span>'
                    , id: url
                    , attr: path
                }); 
                
            }
        } else {
            var iframe = admin.tabsBody(admin.tabsPage.index).find('.layadmin-iframe');
            iframe[0].contentWindow.location.href = url;
        }

        //定位当前tabs
        element.tabChange(FILTER_TAB_TBAS, url);
        /* admin.tabsBodyChange(tabsPage.index, {
            url: url
            , text: text
        }); */
    }
    //触发事件
    var active = {
      tabAdd: function(){
        //新增一个Tab项
       // openTabsPage('/ss/bb/cc' + Math.random()*1000, Math.random()*1000)
      /*   element.tabAdd('layadmin-layout-tabs', {
          title: '新选项'+ (Math.random()*1000|0) //用于演示
          ,content: '内容'+ (Math.random()*1000|0)
          ,id: new Date().getTime() //实际使用一般是规定好的id，这里以时间戳模拟下
        }) */
      }
      ,tabDelete: function(othis){
        //删除指定Tab项
        element.tabDelete('demo', '44'); //删除：“商品管理”
        
        
        othis.addClass('layui-btn-disabled');
      }
      ,tabChange: function(){
        //切换到指定Tab项
        element.tabChange('demo', '22'); //切换到：用户管理
      }
    };
    
    $('.site-demo-active').on('click', function(){
      var othis = $(this), type = othis.data('type');
      active[type] ? active[type].call(this, othis) : '';
    });
    
    //Hash地址的定位
    var layid = location.hash.replace(/^#test=/, '');
    element.tabChange('test', layid);
    
    element.on('tab(test)', function(elem){
      location.hash = 'test='+ $(this).attr('lay-id');
    });
    
  });