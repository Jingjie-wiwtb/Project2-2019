<?php

$artworkID = $_GET['artworkID'];

include 'conn.php';

$sql_select = "SELECT * FROM artworks WHERE artworkID = $artworkID";
$select_result = mysqli_query($conn,$sql_select);
$row=mysqli_fetch_array($select_result);
$filename = "../resources/img/".$row['imageFileName'];

if (!unlink($filename))
{
    echo "delete img failed!";
}
else
{
    echo "Deleted img success!";
}

$sql_delete ="DELETE FROM artworks WHERE artworkID = $artworkID";
$result= mysqli_query($conn,$sql_delete);






if($result) {
    echo "<script>alert('删除成功！');</script>";
}
else echo"<script>alert('删除失败！');history.go(-1);</script>";
//若添加成功，则返回cartID





