<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/webdata/lyzg/public/../application/index/view/index/ceshi.html";i:1517197519;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ajax 无刷新上传</title>

</head>
<body>


<button id="upload_button">上传背景</button>
<img src="HOME_IMG/loading.gif" style="display:none;" id="loadimg" />
<p id="img_div"><img id="img_path" /></p>

</body>
<script type="text/javascript" src="HOME_JS/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="HOME_JS/jquery-1.6.2.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        ajaxUpload(
            'upload_button', //上传的按钮id名称
            1024,  //允许上传的文件大小（单位：kb）
            'ceshi.html?form_name=userfile&file_size=1024', //提交服务器端地址
            'userfile', //提交服务器文件表单名称
            "$(\".img_div\").show();$(\"#img_path\").attr('src', obj.filename);$(\"#is_upload\").val('1');", //上传成功后执行的 js callback
            'loadimg'  //loading 图片id
        );
    });
    /**
     * Ajax 无刷新上传图片（jpg|gif|png）
     * @param string id_name id名称
     * @param int filesize 文件大小 k 为单位
     * @param string url   提交服务器端地址
     * @param string filename 提交服务器文件表单名称
     * @param string callback 上传成功运行代码
     * @param string loadingid loading 图片id名称
     * @return json
     */
    function ajaxUpload(id_name, filesize, url, filename, callback, loadingid) {
        var button = $('#'+id_name), interval;
        var fileType = "pic", fileNum = "one";
        new AjaxUpload(button,{
            action: url,
            name: filename,
            onSubmit : function(file, ext){
                if(fileType == "pic") {
                    if (ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
                        this.setData({
                            'info': '文件类型为图片'
                        });
                    } else {
                        alert('提示：您上传的是非图片类型！');
                        return false;
                    }
                }
                $("#"+loadingid).show();
                if(fileNum == 'one') this.disable();
            },
            onComplete: function(file, response){

                eval("var obj="+response);
                if (obj.ok) {
                    eval(callback);
                } else {
                    switch (response) {
                        case '1':
                            alert('提示：上传失败，图片不能大于'+filesize+'k！');
                            break;
                        case '3':
                            alert('提示：图片只有部分文件被上传，请重新上传！');
                            break;
                        case '4':
                            alert('提示：没有任何文件被上传！');
                            break;
                        case '5':
                            alert('提示：非图片类型，请上传jpg|png|gif图片！');
                            break;
                        default:
                            alert('提示：上传失败，错误未知，请您及时联系网站客服人员！');
                            break;
                    }
                }
                $("#"+loadingid).hide();
                window.clearInterval(interval);
                this.enable();
            }
        });
    }
</script>
</html>
