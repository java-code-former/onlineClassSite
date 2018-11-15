<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" style="overflow-x:hidden;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1">
<script type="text/javascript" src="/Public/Admin/js/jquery-1.7.1.min.js"></script>
<script src="/Public/Admin/js/commonjs-f3ed76e5a9.js"></script>
<script src="/Public/Admin/js/headerjs-3dbdd59df1.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/commoncss-a7db0bcb18.css"/>
<link rel="stylesheet" href="/Public/Admin/css/backheadercss-78c9f8ef71.css"/>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/webuploader.css">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/umeditor.min.css">
<title>首页轮播</title>
</head>
<body class="bg-f3">
    <link type="text/css" rel="stylesheet" href="/Public/Admin/css/home_style.css" />
<link rel="stylesheet" href="/Public/Admin/css/common.css">
<link rel="stylesheet" href="/Public/Admin/css/style.css">
<link rel="stylesheet" href="/Public/Admin/css/font-awesome.css">
<link rel="stylesheet" href="/Public/Admin/css/zzsc.css">
<script type="text/javascript" src="/Public/Admin/js/jquery-1.8.3.min.js"></script>
<script src="/Public/Admin/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/menu.js"></script>
<script charset="utf-8" src="/Public/Admin/editor/kindeditor-all.js"></script>
</head>

    
    <div class="con_right">
    <div class="con_box">
        <form method ="POST" action ="<?php echo U('/enad/img/imgedit',array('id'=>$img['id']));?>" enctype="multipart/form-data">
        <div class="show_table">
                  <table class="c-99" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="80" class="title"><span class="c-ec5022">＊</span>首页轮播图一</td>
                         <td colspan="2">
                            <input type ="file"  name="img1"><img src ="<?php echo ($img["img1"]); ?>" width ="150px" height ="70px">
                         </td>
                       
                    </tr>
                     <input type = "hidden" name ="img1" value ="<?php echo ($img["img1"]); ?>">

                     <tr>
                        <td width="80" class="title"><span class="c-ec5022">＊</span>首页轮播图二</td>
                        <td colspan="2"><input type ="file" name="img2"><img src ="<?php echo ($img["img2"]); ?>" width ="150px" height ="70px"></td>
                        
                    </tr>
                     <input type = "hidden" name ="img2" value ="<?php echo ($img["img2"]); ?>">

                     <tr>
                        <td width="80" class="title"><span class="c-ec5022">＊</span>首页轮播图三</td>
                        <td colspan="2"><input type ="file" name="img3"><img src ="<?php echo ($img["img3"]); ?>" width ="150px" height ="70px"></td>
                        
                    </tr>
 					<input type = "hidden" name ="img3" value ="<?php echo ($img["img3"]); ?>">

                </table>
            </div><center><span style ="color:red;font-size:18px;float:left;">注:该图片上传大小为1440*450px</span><br>
          <h4><input type ="submit" value = "修改" class="btn_next"></h4></div>
           </form>

</div>
</div>


</body>
</html>