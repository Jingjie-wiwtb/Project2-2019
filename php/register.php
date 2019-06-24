<?php
   session_start();
   include 'conn.php';
   
   $username = $_POST['username'];
   $password = $_POST['userpassword'];
   $telephone = $_POST['telephone'];
   $address = $_POST['address'];
   $email = $_POST['email'];
   echo var_dump($username).var_dump($password).var_dump($telephone).var_dump($address).var_dump($email);
   
   $sql_select = "SELECT * FROM users WHERE username = '$username'";
   
   $result = mysqli_query($conn, $sql_select);          

   //用户名已存在
   if($result) {

       mysqli_free_result($result);
	   
	   echo "<script>alert('用户名已存在！');history.go(-1);</script>";
	   
	//   echo "<script>history.go(-1);</script>";
	   
   }
   //用户名不存在，插入用户信息
   else {

       $sql_insert = "INSERT INTO users (username,email,password,tel,address) VALUES ('$username','$email','$password','$telephone','$address')";

     //  $sql_insert = "INSERT INTO users (username) VALUES ('username')";

       $result = mysqli_query($conn, $sql_insert);
       $userID = mysqli_insert_id($conn);
    //   echo $result;

	   if($result) {
           //改变登陆状态
           $_SESSION['username'] = $username;
           $_SESSION['tel'] = $telephone;
           $_SESSION['balance'] = 0;
           $_SESSION['address'] = $address;
           $_SESSION['email'] = $email;
           $_SESSION['userID'] = $userID;
           $_SESSION['logincheck'] = 1;

           echo 'hhh'.$_SESSION['logincheck'];

           echo '<script>alert("注册成功！");history.go(-1);</script>';

       }
	   else {
           echo mysqli_error($conn);
           echo '<script>alert("注册失败！请重试！");</script>';
       }
	   
   }

    //关闭数据库

	mysqli_close($conn);
	   

	   