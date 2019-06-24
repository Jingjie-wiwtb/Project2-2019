<?php

   include 'conn.php';

   session_start();

   $username =  $_POST['username'];
   $password = $_POST['userpassword'];
   //查找用户名
   $sql_select = "SELECT * FROM users WHERE username ='$username'";
   
   $result = mysqli_query($conn,$sql_select);
   
   $row = mysqli_fetch_array($result);

   mysqli_free_result($result);

   //验证密码
   
   //用户不存在
    if(!$row) {
		echo '0';
	}
	else if($row['password']==$password) {
	   
	   $_SESSION['username']=$username;
	   $_SESSION['tel']=$row['tel'];
	   $_SESSION['balance']=$row['balance'];
	   $_SESSION['address']=$row['address'];
	   $_SESSION['email']=$row['email'];
	   $_SESSION['userID']=$row['userID']; //改变登陆状态
        $_SESSION['logincheck'] = 1;
        echo '2';
        echo "<script>history.go(-1);</script>";
   }	   
    else {

        echo '1';    //密码错误
		
	//	echo "<script>history.go(-1);</script>";
	}
   
   //关闭数据库
	mysqli_close($conn);
	   
   
   /*
    if(isset($_SESSION['userurl'])){
	   //会话中有要跳转的页面
 	   $url = $_SESSION['userurl'];
    }
    else {
	   //没有要跳转的页面则转到首页
	   $url="./html/Home.html";
	   */
	   
	   
