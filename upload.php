<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/28
 * Time: 16:12
 */

//$_FILES:文件上传变量
print_r($_FILES);
$maxsize =ini_get('upload_max_filesize');
$filename=$_FILES['file']['name'];
$type=$_FILES['file']['type'];
$tmp_name=$_FILES['file']['tmp_name'];
$size=$_FILES['file']['size'];
$error=$_FILES['file']['error'];

//将服务器上的临时文件移动到指定位置
//方法一move_upload_file($tmp_name,$destination)
move_uploaded_file($tmp_name, "upload/".$filename);//文件夹应提前建立好，不然报错

if($error==0)
{
    echo '<script>alert("上传成功");</script>';
    header('Location:http://www.upload.com/list.html');
}else{
    echo '<script>alert("上传失败");</script>';
}


