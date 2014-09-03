<?php
//$path= 'upload/'.$_GET['qqfile'];  
//
//$input = fopen("php://input", "r");
//$temp = tmpfile();
//$realSize = stream_copy_to_stream($input, $temp);
//fclose($input);
//
////if ($realSize != $this->getSize()){            
////    return false;
////}
//
//$target = fopen($path, "w");        
//fseek($temp, 0, SEEK_SET);
//stream_copy_to_stream($temp, $target);
//fclose($target);
//$result= array('success'=> true);
//echo json_encode($result);

//var_dump($_FILES['userfile']);
//var_dump($_POST);
if(!isset($_POST['action'],$_POST['key'])){
$upload_dir = 'images/';
$file_path = $upload_dir . $_FILES['userfile']['name'];
$MAX_SIZE = 20000000;

//echo $_POST['buttoninfo'];
if(!is_dir($upload_dir))
{
    if(!mkdir($upload_dir))
//        echo "文件上传目录不存在并且无法创建文件上传目录";
        echo '0';
    if(!chmod($upload_dir,0755))
        //echo "文件上传目录的权限无法设定为可读可写";
            echo '1';
}

else if($_FILES['userfile']['size']>$MAX_SIZE)
    //echo "上传的文件大小超过了规定大小";
    echo '2';

else if($_FILES['userfile']['size'] == 0)
    //echo "请选择上传的文件";
echo '3';

else if(!move_uploaded_file( $_FILES['userfile']['tmp_name'], $file_path))
    //echo "复制文件失败，请重新上传"; 
        echo '4';
else{
switch($_FILES['userfile']['error'])
{
    case 0:
        echo $file_path ;
        break;
    case 1:
        //echo "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";
        echo '5';
        break;
    case 2:
        //echo "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
        echo '6';
        break;
    case 3:
        //echo "文件只有部分被上传";
        echo '7';
        break;
    case 4:
        //echo "没有文件被上传";
        echo '8';
        break;
}
}
}
//var_dump($_FILES['userfile']);
else if(isset($_POST['action'],$_POST['key'])){
    if(unlink($_POST['key']))echo'success';
    else echo'0';
}