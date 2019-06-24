<?php

   session_start();
if(!isset($_SESSION['userID'])){   //如果没登陆
    echo "notlogin";
}

else {

    $artworkID = $_GET['artworkID'];

    $userID = $_SESSION['userID'];


    include 'conn.php';


    $sql_select = "SELECT * FROM orders WHERE artworkID = $artworkID";
    $select_result = mysqli_query($conn, $sql_select);

    if ($select_result) {       //如果已经被买了
        echo "bought";
        mysqli_free_result($select_result);
       // echo mysqli_error($conn);
        // mysqli_free_result($select_result);
    }
    else {
        //检查是否重复添加
        $sql_check = "SELECT * FROM carts WHERE userID = $userID AND artworkID = $artworkID ";
        $check_result = mysqli_query($conn,$sql_check);
        if($check_result)   //该用户已添加
        {
            echo "added";
            mysqli_free_result($check_result);
        }
        //没有重复则添加
        else {

            $sql_insert = "INSERT INTO carts (userID,artworkID) VALUES ($userID,$artworkID)";
            $result = mysqli_query($conn, $sql_insert);
           // echo mysqli_error($conn);

                echo "success";

        }
    }

}

	

	