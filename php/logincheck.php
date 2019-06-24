<?php
   
   session_start();
   
   $lifeTime = 24 * 3600;  //Session的生存期（设为一天）
   
   if(!isset ($_SESSION['login_yes'])) {
	   echo "alert('请先登陆！')";
	   $_SESSION['lasturl'] = $SERVER['REQUEST_URL'];
	   echo'<script language=javascript>window.location.href="login.php"</script>';
   }
   
   