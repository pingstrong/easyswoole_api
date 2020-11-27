@extends('layouts.admin_child')

@section('header_style')
 
@endsection

@section('body')
  
<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
  <ul class="layui-tab-title">
    <li class="layui-this">网站设置</li>
    <li>短信配置</li>
    <li>支付配置</li>
    <li>公众号设置</li>
    <li>小程序设置</li>
    <li>App设置</li>
    <li>协议隐私</li>
    <li>联系方式</li>
    <li>文件存储</li>
  </ul>
  <div class="layui-tab-content" style="height: auto;">
    <!-- 网站设置 -->
    <div class="layui-tab-item layui-show">
      <form class="layui-form" action="" lay-filter="FormWeb">
            <!-- 配置项标识ID -->
            <input type="hidden" name="key" value="web">
            <div class="layui-form-item">
                <label class="layui-form-label">网站名称</label>
                <div class="layui-input-block">
                  
                    <input type="text" name="name"   autocomplete="off" placeholder="请输入标题" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">网站域名URL</label>
              <div class="layui-input-block">
                    <input type="text" name="base_url"   autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
              <div class="layui-form-item">
                <label class="layui-form-label">行业所在</label>
                <div class="layui-input-block">
                    <select name="business" >
                        <option value=""></option>
                        <option value="0">电子商务</option>
                        <option value="1" selected="">游戏</option>
                        <option value="2">媒体</option>
                        <option value="3">广告营销</option>
                        <option value="4">数据服务</option>
                        <option value="5">医疗健康</option>
                        <option value="6">生活服务</option>
                        <option value="7">020</option>
                        <option value="8">金融</option>
                        <option value="9">制造业</option>
                        <option value="10">其他</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">营业时间</label>
              <div class="layui-input-block">
                  <input type="checkbox" name="worktime[day]"  title="白天">
                  <input type="checkbox" name="worktime[night]"  title="晚上">
                  <input type="checkbox" name="worktime[all]" title="24小时">
              </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">LOGO</label>
            <div class="layui-input-block">
                @component('template.admin.form.image', ['name' => 'logo', 'value' => $setting['web']['logo']?? ""])@endcomponent
            </div>
         </div>
          <div class="layui-form-item">
              <label class="layui-form-label">状态</label>
              <div class="layui-input-block">
                  <input type="checkbox" name="close" lay-skin="switch" lay-text="开|关">
              </div>
          </div>

          <div class="layui-form-item">
              <label class="layui-form-label">图片存储</label>
              <div class="layui-input-block">
                  <input type="radio" name="storage" value="0" title="本地" checked="">
                  <input type="radio" name="storage" value="1" title="七牛">
                  <input type="radio" name="storage" value="2" title="阿里">
                  <input type="radio" name="storage" value="3" title="腾讯">
              </div>
          </div>
          <div class="layui-form-item layui-form-text">
              <label class="layui-form-label">介绍</label>
              <div class="layui-input-block">
                  <textarea placeholder="请输入内容" name="description" class="layui-textarea"></textarea>
              </div>
          </div>
        
          <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
      </form>
    </div>
    <!-- 短信设置 -->
    <div class="layui-tab-item">
      <blockquote class="layui-elem-quote layui-text">
         目前集成常规云短信服务商，其他渠道另设置！
      </blockquote>
      <form class="layui-form" action="" lay-filter="FormSms">
        <!-- 配置项标识ID -->
        <input type="hidden" name="key" value="sms">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
          <legend>阿里云</legend>
        </fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label">AppId</label>
            <div class="layui-input-block">
                <input type="text" name="aliyun[appid]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
          <div class="layui-form-item">
              <label class="layui-form-label">AppKey</label>
              <div class="layui-input-block">
                  <input type="text" name="aliyun[appkey]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">短信签名</label>
            <div class="layui-input-block">
                <input type="text" name="aliyun[sign]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">验证类模板</label>
          <div class="layui-input-block">
              <input type="text" name="aliyun[code_tpl]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">通知类模板</label>
          <div class="layui-input-block">
              <input type="text" name="aliyun[notice_tpl]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
          <legend>腾讯云</legend>
        </fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label">AppId</label>
            <div class="layui-input-block">
                <input type="text" name="tencent[appid]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
          <div class="layui-form-item">
              <label class="layui-form-label">AppKey</label>
              <div class="layui-input-block">
                  <input type="text" name="tencent[appkey]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">短信签名</label>
            <div class="layui-input-block">
                <input type="text" name="tencent[sign]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">验证类模板</label>
          <div class="layui-input-block">
              <input type="text" name="tencent[code_tpl]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">通知类模板</label>
          <div class="layui-input-block">
              <input type="text" name="tencent[notice_tpl]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
          <legend>网易云</legend>
        </fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label">AppId</label>
            <div class="layui-input-block">
                <input type="text" name="wangyi[appid]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
          <div class="layui-form-item">
              <label class="layui-form-label">AppKey</label>
              <div class="layui-input-block">
                  <input type="text" name="wangyi[appkey]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">短信签名</label>
            <div class="layui-input-block">
                <input type="text" name="wangyi[sign]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">验证类模板</label>
          <div class="layui-input-block">
              <input type="text" name="wangyi[code_tpl]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">通知类模板</label>
          <div class="layui-input-block">
              <input type="text" name="wangyi[notice_tpl]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        
        <div class="layui-form-item">
          <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </form>
    </div>
    <!-- 支付设置 -->
    <div class="layui-tab-item">
      <form class="layui-form" action="" lay-filter="FormPayment">
          <!-- 配置项标识ID -->
          <input type="hidden" name="key" value="payment">
          <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>支付宝</legend>
          </fieldset>
          <div class="layui-form-item">
            <label class="layui-form-label">支付宝appId</label>
            <div class="layui-input-block">
                <input type="text" name="alipay[appid]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">支付宝公钥</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="alipay[public_key]" class="layui-textarea"></textarea>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">签名私钥</label>
            <div class="layui-input-block">
              <textarea placeholder="请输入内容" name="alipay[private_key]" class="layui-textarea"></textarea>
            </div>
          </div>
          <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>微信</legend>
          </fieldset>
          <div class="layui-form-item">
            <label class="layui-form-label">商户号</label>
            <div class="layui-input-block">
                <input type="text" name="wechat[merchant_id]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">AppId</label>
            <div class="layui-input-block">
                <input type="text" name="wechat[appid]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">签名Key</label>
            <div class="layui-input-block">
                <input type="text" name="wechat[key]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
          </div>

      </form>
    </div>
    <!-- 公众号设置 -->
    <div class="layui-tab-item">
      <form class="layui-form" action="" lay-filter="FormVipcn">
        <!-- 配置项标识ID -->
        <input type="hidden" name="key" value="vipcn">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
          <legend>微信公众号</legend>
        </fieldset>
        <div class="layui-form-item">
          <label class="layui-form-label">AppID</label>
          <div class="layui-input-block">
              <input type="text" name="wechat[appid]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">AppSecret</label>
          <div class="layui-input-block">
              <input type="text" name="wechat[secret]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">MsgEncryptKey</label>
          <div class="layui-input-block">
              <input type="text" name="wechat[encrypt_key]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
       </form>
    </div>
    <!-- 小程序设置 -->
    <div class="layui-tab-item">
      <form class="layui-form" action="" lay-filter="FormApplet">
          <!-- 配置项标识ID -->
          <input type="hidden" name="key" value="applet">
          <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>微信小程序</legend>
          </fieldset>
          <div class="layui-form-item">
            <label class="layui-form-label">AppID</label>
            <div class="layui-input-block">
                <input type="text" name="wechat[appid]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">AppSecret</label>
            <div class="layui-input-block">
                <input type="text" name="wechat[secret]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
          </div>
      </form>
    </div>
    <!-- App设置 -->
    <div class="layui-tab-item">
      <form class="layui-form" action="" lay-filter="FormApp">
        <!-- 配置项标识ID -->
          <input type="hidden" name="key" value="app">
          <blockquote class="layui-elem-quote layui-text">
             只针对Uniapp开发的应用
          </blockquote>
          <div class="layui-form-item">
            <label class="layui-form-label">版本号</label>
            <div class="layui-input-block">
                <input type="text" name="version"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">安卓下载地址</label>
            <div class="layui-input-block">
                <input type="text" name="android_downurl"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">IOS下载地址</label>
            <div class="layui-input-block">
                <input type="text" name="ios_downurl"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">升级说明</label>
            <div class="layui-input-block">
              <textarea placeholder="请输入内容" name="upgrade_des" class="layui-textarea"></textarea>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">升级包</label>
            <div class="layui-input-block">
                <input type="text" name="ios_downurl"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
          </div>
      </form>
    </div>
    <!-- 协议设置 -->
    <div class="layui-tab-item">
      <form class="layui-form" action="" lay-filter="FormProtocol">
          <!-- 配置项标识ID -->
          <input type="hidden" name="key" value="protocol">
          <div class="layui-form-item">
            <label class="layui-form-label">用户协议</label>
            <div class="layui-input-block">
                 @component('template.admin.form.editor', ['name' => 'agreement', 'value' => $setting['protocol']['agreement']?? ""]) @endcomponent
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">隐私政策</label>
            <div class="layui-input-block">
                 @component('template.admin.form.editor', ['name' => 'privacy', 'value' => $setting['protocol']['privacy']?? ""]) @endcomponent
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
          </div>
      </form>
    </div>
    <!-- 联系方式设置 -->
    <div class="layui-tab-item">
      <form class="layui-form" action="" lay-filter="FormContact">
          <!-- 配置项标识ID -->
          <input type="hidden" name="key" value="contact">
          <div class="layui-form-item">
            <label class="layui-form-label">手机号码</label>
            <div class="layui-input-block">
                <input type="text" name="mobile"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">QQ</label>
            <div class="layui-input-block">
                <input type="text" name="qq"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">微信</label>
            <div class="layui-input-block">
                <input type="text" name="wechat"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">LINE</label>
            <div class="layui-input-block">
                <input type="text" name="line"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">Facebook</label>
            <div class="layui-input-block">
                <input type="text" name="facebook"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">联系负责人</label>
            <div class="layui-input-block">
                <input type="text" name="linkman"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">联系地址</label>
            <div class="layui-input-block">
                <input type="text" name="address"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
          </div>
      </form>
    </div>
    <!-- 文件存储 -->
    <div class="layui-tab-item">
      <form class="layui-form" action="" lay-filter="FormStorage">
          <!-- 配置项标识ID -->
          <input type="hidden" name="key" value="storage">
          <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>七牛云</legend>
          </fieldset>
          <div class="layui-form-item">
            <label class="layui-form-label">AccessKey</label>
            <div class="layui-input-block">
                <input type="text" name="qiniu[access_key]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">SecretKey</label>
            <div class="layui-input-block">
                <input type="text" name="qiniu[secret_key]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">存储空间bucket</label>
            <div class="layui-input-block">
                <input type="text" name="qiniu[bucket]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">访问域名</label>
            <div class="layui-input-block">
                <input type="text" name="qiniu[domain_url]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>阿里云</legend>
          </fieldset>
          <div class="layui-form-item">
            <label class="layui-form-label">AccessKey</label>
            <div class="layui-input-block">
                <input type="text" name="aliyun[access_key]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">SecretKey</label>
            <div class="layui-input-block">
                <input type="text" name="aliyun[secret_key]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">存储空间bucket</label>
            <div class="layui-input-block">
                <input type="text" name="aliyun[bucket]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">访问域名</label>
            <div class="layui-input-block">
                <input type="text" name="aliyun[domain_url]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>腾讯云</legend>
          </fieldset>
          <div class="layui-form-item">
            <label class="layui-form-label">AppId</label>
            <div class="layui-input-block">
                <input type="text" name="tencent[appid]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">secretId</label>
            <div class="layui-input-block">
                <input type="text" name="tencent[secret_id]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">secretKey</label>
            <div class="layui-input-block">
                <input type="text" name="tencent[secret_key]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">访问域名</label>
            <div class="layui-input-block">
                <input type="text" name="tencent[domain_url]"  lay-reqtext="必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="FormSbtn">立即提交</button>
              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
          </div>
      </form>
    </div>


  </div>
 
</div> 

@endsection

 
@section('footer_js')

<script>
layui.use(['form', 'upload', 'element', 'layer'], function(){
  var form = layui.form, upload = layui.upload, layer = layui.layer, element = layui.element, $ = layui.jquery;
   //监听提交
   form.on('submit(FormSbtn)', function (data) {
        
        switch (data.field.key) {
          case 'web':
            data.field.close = data.field.close ? 1 : 0;
            break;
          case 'sms':
          
            break;
          case 'payment':
          
            break;
          case 'vipcn':
          
            break;
          case 'applet':
          
            break;
          case 'app':
          
            break;
          
          case 'protocol':
            break;
          case 'contact':
            break;
          case 'storage':
            break;
          default:
            break;
        }
        console.log(data.field)
        
        http_post("/backdata/setting/edit", data.field, function(result){
          layer.msg(result.msg)
        })
        return false;
    });
    //自定义验证规则
    form.verify({
         /*  title: function (value) {
              if (value.length < 5) {
                  return '标题至少得5个字符啊';
              }
          }
          , pass: [
              /^[\S]{6,12}$/
              , '密码必须6到12位，且不能出现空格'
          ]
          , content: function (value) {
              layedit.sync(editIndex);
          } */
      });
     //表单初始赋值
     form.val('FormWeb', {
            "name": "{!! $setting['web']['name']?? '' !!}" // 
            , "base_url": "{!! $setting['web']['base_url']?? '' !!}"
            , "interest": 2
            @isset($setting['web']['worktime[day]']),"worktime[day]": true @endisset //复选框选中状态
            @isset($setting['web']['worktime[night]']),"worktime[night]": true @endisset
            @isset($setting['web']['worktime[all]']),"worktime[all]": true @endisset
            , "close": @if(isset($setting['web']['close']) and $setting['web']['close'] == 1 ) true @else false    @endif //开关状态
            , "storage": "{{$setting['web']['storage']?? 0 }}"
            , "business": "{{$setting['web']['business']?? 0 }}"
            , "description": "{!! $setting['web']['description']?? '' !!}"
        })
    form.val('FormSms', {
        
    })
    form.val('FormPayment', {
        
    })
    form.val('FormVipcn', {
        
    })
    form.val('FormApplet', {
       
    })
    form.val('FormApp', {
         
    })
    form.val('FormProtocol', {
       
       
    })

});
</script>
@endsection