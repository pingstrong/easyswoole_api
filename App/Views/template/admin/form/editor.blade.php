
<div id="editor_{{$editor_id}}" style="margin: 50px 0 50px 0">
    <p>欢迎使用 <b>富文本编辑器</b></p>
</div>
<script type="text/javascript">
    layui.use(['layer','wangEditor'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            wangEditor = layui.wangEditor;
        var dispatchId = "{{$editor_id}}";
        var editor = new wangEditor('#editor_' + dispatchId);
        editor.config.uploadImgServer = "/backdata/filestem/upload";
        editor.config.uploadFileName = 'image';
        editor.config.pasteFilterStyle = false;
        editor.config.uploadImgMaxLength = 5;
        editor.config.uploadImgHooks = {
            // 上传超时
            timeout: function (xhr, editor) {
                layer.msg('上传超时！')
            },
            // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
            customInsert: function (insertImg, result, editor) {

                console.log(result);
                layer.msg(result.msg);
                if (result.code == 0) {
                    var url = result.data;
                    url.forEach(function (e) {
                        insertImg(e.url);
                    })
                    $('#' + dispatchId).val(editor.txt.html())
                }
            }
        };
        // 配置 onchange 回调函数
        editor.config.onchange = function (newHtml) {
            console.log('change 之后最新的 html', newHtml)
            $('#' + dispatchId).val(newHtml)
        }
        editor.config.customAlert = function (info) {
            layer.msg(info);
        };
        editor.create();
        editor.txt.html($('#' + dispatchId).val())

    });
</script>