<?php
   $server="127.0.0.1";
   $sqlname="root";
   $sqlpassword="969723hjj";
   $dbname="web_pj2";
   
   $conn = mysqli_connect($server,$sqlname,$sqlpassword,$dbname);
   
   if($conn->connect_error) {
	   die("Connection failed:".$conn->connect_error);
	   echo "<script>console.log('database connected failed!s')</script>";
   }
 /*  else{
	   echo "<script>console.log('database connected successfully!')</script>";
   }*/
    mysqli_query($conn,'set names utf8');

?>