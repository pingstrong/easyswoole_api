<div class="layui-upload">
    <label class="layui-form-label">水印图片</label>
    <input type="hidden" name="logoInfoImage"  value="{$data['logoInfoImage']}">
    <button type="button" class="layui-btn ueditor" >上传图片</button>
    <div class="layui-upload-list">
        <img class="layui-upload-img demo1"  >
        <p calss="demoText"></p>
    </div>
    <div class="item-tools">
        <button type="button" data-src="{{ $data['value']??'' }}"
                kq-event="show_pic"
                class="layui-btn layui-btn-radius layui-btn-sm layui-btn-primary"><i
                    class="ti-eye"></i> 查看
        </button>
        <button type="button" kq-event="del_upload_pic"
                class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger"><i
                    class="mdi mdi-delete"></i> 删除
        </button>
    </div>
  </div>
  
  <div class="layui-upload">
    <label class="layui-form-label">logo图片</label>
    <input type="hidden" name="logoInfoImage"  value="{$data['logoInfoImage']}">
    <button type="button" class="layui-btn ueditor" >上传图片</button>
    <div class="layui-upload-list">
        <img class="layui-upload-img demo1"  >
        <p calss="demoText"></p>
    </div>
  </div>


  <script>
      layui.use([ 'index','table', 'upload'], function(){
        var table = layui.table, upload = layui.upload;
        var uploadInst = upload.render({
            elem: '.ueditor'
            ,url: '/admin/foundation/upload' //改成您自己的上传接口
            ,before: function(obj){
                var item = this.item;
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                item.nextAll('div').find('img').attr('src',result);
                });
            }
            ,done: function(res){
                var item = this.item;
                //如果上传失败
                if(res.code == 0){
                    return layer.msg(res.msg);
                }
                layer.msg(res.msg);
                item.prev().val(res.msg);
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = item.nextAll('p');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
       });
      });
    
  </script>