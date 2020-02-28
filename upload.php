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
//方法二copy($src,$des)
//以上两个函数都是成功返回真，否则返回false
//copy($tmp_name, "copies/".$filename);
//注意，不能两个方法都对临时文件进行操作，临时文件似乎操作完就没了，我们试试反过来
//copy($tmp_name, "copies/".$filename);
//move_uploaded_file($tmp_name, "uploads/".$filename);
//能够实现，说明move那个函数基本上相当于剪切；copy就是copy，临时文件还在

//另外，错误信息也是不一样的，遇到错误可以查看或者直接报告给用户
if ($error==0) {
    //$str = "{success: true, message: 上传成功！}";
    $str = array('success' => 'true', 'message' => '上传成功！');
}else{
    switch ($error){
        case 1:
            //echo "{success: false , message:超过了上传文件的最大值，请上传{$maxsize}以下文件}";
            $str = array('success' => 'false', 'message' => '超过了上传文件的最大值，请上传{$maxsize}以下文件');
            break;
        case 2:
            //echo "{success: false , message:上传文件过多，请一次上传20个及以下文件！}";
            $str = array('success' => 'false', 'message' => '上传文件过多，请一次上传20个及以下文件！');
            break;
        case 3:
            //echo "{success: false , message:文件并未完全上传，请再次尝试！}";
            $str = array('success' => 'false', 'message' => '文件并未完全上传，请再次尝试！');
            break;
        case 4:
            //$str = "{ success: false , message:未选择上传文件!}";
            $str = array('success' => 'false', 'message' => '未选择上传文件');
            break;
        case 5:
            //echo "{ success: false , message:上传文件为0}";
            $str = array('success' => 'false', 'message' => '上传文件为0');
            break;
    }

}
echo json_encode($str,JSON_UNESCAPED_UNICODE);

