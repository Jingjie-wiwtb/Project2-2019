<?php

    $artworkID = $_GET['artworkID'];
	
	include 'conn.php';
	
	$sql_delete ="DELETE FROM carts WHERE artworkID = '$artworkID'";
	
	$result= mysqli_query($conn,$sql_delete);
	
	if($result) {
	    echo "<script>alert('删除成功！');history.go(-1);</script>";
    }
	else echo"<script>alert('删除失败！');history.go(-1);</script>";
	//若添加成功，则返回cartID



		

	