<?php
session_start();
include 'conn.php';

$username = $_SESSION['username'];
$artworkID = $_POST['artworkID'];
$title = $_POST['title'];
$artist = $_POST['artist'];
$description = $_POST['description'];
$year = $_POST['year'];
$genre = $_POST['genre'];
$width = $_POST['width'];
$height = $_POST['height'];
$price = $_POST['price'];
$imageFileName = $_POST['imageFileName'];
echo var_dump($username).var_dump($password).var_dump($telephone).var_dump($address).var_dump($email);

$sql_select = "SELECT * FROM artworks WHERE artworkID = '$artworkID'";

$result = mysqli_query($conn, $sql_select);



if($result) {    //搜到说明  修改

    $row = mysqli_fetch_array($result);
//保存原来的价格
    $pre_price = $row['price'];

    $sql_update = "UPDATE artwork SET title='$title',artist='$artist',description='$description',yearOfWork=$year,genre='$genre',width=$width,height=$height,price=$price,imageFileName='$imageFileName' WHERE artworkID =$artworkID";

    //这里不用村session   把购物车里的price和搜索到的比一下就可以了
    $update_result = mysqli_query($conn,$sql_select);

    if($update_result)
        echo "<script>alert('修改成功！');</script>";
    else
        echo "edit error".mysqli_error($conn);

}
else   //创建新商品
{


    $sql_insert = "INSERT INTO artworks (artist,imageFileName,title,description,yearOfWork,genre,width,height,price,ownerID,orderID) VALUES ('$artist','$imageFileName','$title','$description',$year,'$genre',$width,$height,$price,$userID)";
    $insert_result = mysqli_query($sql_insert);

    if ($insert_result) {
        echo "<script>alert('商品创建成功！');</script>";
    } else
        echo "insert error" . mysqli_error($conn);

}

//关闭数据库

mysqli_close($conn);


