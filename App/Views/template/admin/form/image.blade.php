  
  <div class="layui-upload">
    <input type="hidden" name="{{$name}}" id="FormUploadFile_{{$name}}"   value="{{$value}}">
    <button type="button" class="layui-btn" id="upload_{{$name}}">上传图片</button>
    <div class="layui-upload-list">
      <img class="layui-upload-img" id="upload_img_{{$name}}" src="{{$value}}">
      <p id="demoText"></p>
    </div>
  </div>   

  <script>
      layui.use(['upload'], function(){
        var upload = layui.upload, $ = layui.jquery;
        var uploadInst = upload.render({
            elem: '#upload_{{$name}}'
            ,url: '/backdata/filestem/upload' //改成您自己的上传接口
            ,before: function(obj){
                var item = this.item;
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                item.nextAll('div').find('img').attr('src',result);
                });
            }
            ,done: function(res){
                var item = this.item;
                layer.msg(res.msg);
                //如果上传失败
                if(res.code !== 0){
                    return ;
                }
                item.prev().val(res.msg);
                $("#FormUploadFile_{{$name}}").val(res.data[0].url)
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