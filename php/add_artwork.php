<?php
session_start();
include 'conn.php';






$username = $_SESSION['username'];
$userID = $_SESSION['userID'];
$artworkID = $_POST['artworkID'];
$title = $_POST['title'];
$artist = $_POST['artist'];
$description = $_POST['description'];
$year = $_POST['year'];
$genre = $_POST['genre'];
$width = $_POST['width'];
$height = $_POST['height'];
$price = $_POST['price'];


$sql_select = "SELECT * FROM artworks WHERE artworkID = '$artworkID'";

$result = mysqli_query($conn, $sql_select);

echo $artworkID." ";

if($artworkID) {    //搜到说明  修改

    //echo
$_SESSION["change"]=array();

    //判断是否修改  并记录
    $select_change = "SELECT * FROM artworks WHERE artworkID = $artworkID";
    $result = mysqli_query($conn,$select_change);
    $row = mysqli_fetch_array($result);
    if($row['price']!=$price){
        $_SESSION["change"][$artworkID]=array();
        $_SESSION["change"][$artworkID]['price']=$price;
    }
    if($row['height']!=$height){
        $_SESSION["change"][$artworkID]=array();
        $_SESSION["change"][$artworkID]['height']=$height;
    }
    if($row['width']!=$width){
        $_SESSION["change"][$artworkID]=array();
        $_SESSION["change"][$artworkID]['width']=$width;
    }
    if($row['genre']!=$genre){
        $_SESSION["change"][$artworkID]=array();
        $_SESSION["change"][$artworkID]['genre']=$genre;
    }
    if($row['description']!=$description){
        $_SESSION["change"][$artworkID]=array();
        $_SESSION["change"][$artworkID]['description']=$description;
    }
    if($row['yearOfWork']!=$year){
        $_SESSION["change"][$artworkID]=array();
        $_SESSION["change"][$artworkID]['year']=$year;
    }
    if($row['title']!=$title){
        $_SESSION["change"][$artworkID]=array();
        $_SESSION["change"][$artworkID]['title']=$title;
    }
    if($row['artist']!=$artist){
        $_SESSION["change"][$artworkID]=array();
        $_SESSION["change"][$artworkID]['artist']=$artist;
    }




//图片上传

//var_dump($_FILES["file"]);
//array(5) { ["name"]=> string(17) "56e79ea2e1418.jpg" ["type"]=> string(10) "image/jpeg" ["tmp_name"]=> string(43) "C:\Users\asus\AppData\Local\Temp\phpD07.tmp" ["error"]=> int(0) ["size"]=> int(454445) }
//1.限制文件的类型，防止注入php或其他文件，提升安全
//2.限制文件的大小，减少内存压力
//3.防止文件名重复，提升用户体验
//方法一：  修改文件名    一般为:时间戳+随机数+用户名
// 方法二:建文件夹

//4.保存文件

//判断上传的文件是否出错,是的话，返回错误
    if($_FILES["artimg"]["error"])
    {
        echo $_FILES["artimg"]["error"];
    }
    else
    {
        //没有出错
        //加限制条件
        //判断上传文件类型为png或jpg且大小不超过1024000B
        if(($_FILES["artimg"]["type"]=="image/png"||$_FILES["artimg"]["type"]=="image/jpeg")&&$_FILES["artimg"]["size"]<1024000)
        {
            //防止文件名重复
            $filename =time().$_FILES["artimg"]["name"];
            //转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE。
            $filename =iconv("UTF-8","gb2312",$filename);
            //检查文件或目录是否存在
            if(file_exists($filename))
            {
                echo"该文件已存在";
            }
            else
            {
                $filename =iconv("gb2312","UTF-8",$filename);
                //保存文件,   move_uploaded_file 将上传的文件移动到新位置
                move_uploaded_file($_FILES["artimg"]["tmp_name"],"../resources/img/".$filename);//将临时地址移动到指定地址
            }
        }
        else
        {
            echo"文件类型不对";
        }
    }


    if(!$_FILES["artimg"]["name"])   //如果没有选择图片
        $filename = $row['imageFileName'];


    $row = mysqli_fetch_array($result);
//保存原来的价格
 //   $pre_price = $row['price'];

    $sql_update = "UPDATE artworks SET title='$title',artist='$artist',description='$description',yearOfWork=$year,genre='$genre',width=$width,height=$height,price=$price,imageFileName ='$filename' WHERE artworkID=$artworkID";
    
	echo $sql_update;
    //这里不用村session   把购物车里的price和搜索到的比一下就可以了
    $update_result = mysqli_query($conn,$sql_update);

   

 //var_dump($update_result);
   echo "edit error1".mysqli_error($conn);

    if($update_result)
        echo "<script>alert('修改成功！');history.go(-1);</script>";
    else
        echo "edit error".mysqli_error($conn);

}



else   //创建新商品
{


//图片上传

//var_dump($_FILES["file"]);
//array(5) { ["name"]=> string(17) "56e79ea2e1418.jpg" ["type"]=> string(10) "image/jpeg" ["tmp_name"]=> string(43) "C:\Users\asus\AppData\Local\Temp\phpD07.tmp" ["error"]=> int(0) ["size"]=> int(454445) }
//1.限制文件的类型，防止注入php或其他文件，提升安全
//2.限制文件的大小，减少内存压力
//3.防止文件名重复，提升用户体验
//方法一：  修改文件名    一般为:时间戳+随机数+用户名
// 方法二:建文件夹

//4.保存文件

//判断上传的文件是否出错,是的话，返回错误
    if($_FILES["artimg"]["error"])
    {
        echo $_FILES["artimg"]["error"]."   ";
    }
    else
    {
        //没有出错
        //加限制条件
        //判断上传文件类型为png或jpg且大小不超过1024000B
        if(($_FILES["artimg"]["type"]=="image/png"||$_FILES["artimg"]["type"]=="image/jpeg")&&$_FILES["artimg"]["size"]<1024000)
        {
            //防止文件名重复
            $filename =time().$_FILES["artimg"]["name"];
          //  echo $filename;
            //转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE。
            $filename =iconv("UTF-8","gb2312",$filename);
            //检查文件或目录是否存在
            if(file_exists($filename))
            {
                echo"该文件已存在";
            }
            else
            {
                $filename =iconv("gb2312","UTF-8",$filename);
                //保存文件,   move_uploaded_file 将上传的文件移动到新位置
                move_uploaded_file($_FILES["artimg"]["tmp_name"],"../resources/img/".$filename);//将临时地址移动到指定地址
            }
        }
        else
        {
            echo"文件类型不对";
        }
    }

    echo $filename;

    $sql_insert = "INSERT INTO artworks (artist,imageFileName,title,description,yearOfWork,genre,width,height,price,ownerID) VALUES ('$artist','$filename','$title','$description',$year,'$genre',$width,$height,$price,$userID)";
    $insert_result = mysqli_query($conn,$sql_insert);

    if ($insert_result) {
        echo "<script>alert('商品创建成功！');location.href='../html/personal_info.php';</script>";
    } else
        echo "insert error" . mysqli_error($conn);

}

//关闭数据库






mysqli_close($conn);


