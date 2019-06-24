<?php
   session_start();

   include 'conn.php';
   $recharge_num = $_POST['recharge_num'];
    $username = $_SESSION['username'];

	$sql_select = "SELECT * FROM users WHERE username = '$username'";
   
    $result = mysqli_query($conn,$sql_select);   //查找用户信息
   
    $row = mysqli_fetch_array($result);
	

	if($row) {   //用户已登录

		$new_balance =$row['balance'] + $recharge_num;  //更新数据库余额

		$sql_update = "UPDATE users SET balance = $new_balance WHERE username = '$username'";
		$update = mysqli_query($conn,$sql_update);

		$_SESSION['balance'] = $new_balance ;  //更新session中的余额
		
		echo "<script>alert('充值成功！');history.go(-1);</script>";
	}
	else {   //用户未登录
	
	    echo "<script>alert('请先登陆！');history.go(-1);</script>";
		
	}

		
		
    //关闭数据库
	
	mysqli_close($conn);
	

	    
		
		
	

   