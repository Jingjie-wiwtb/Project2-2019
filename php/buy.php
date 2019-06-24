<?php

    include 'conn.php';
    
    session_start();
	
	$totalPrice = 410;//$_GET['totalPrice'];   //获得总价

	$userID = $_SESSION['userID'];   //目前用户ID
	
	
	
	//若余额充足
	if($_SESSION['balance']>=$totalPrice) {

        $sql_select = "SELECT * FROM carts LEFT JOIN artworks ON carts.artworkID=artworks.artworkID WHERE carts.userID=$userID";
        $select = mysqli_query($conn, $sql_select);

        //对购物车中的所有商品逐个操作：

        while ($cart_array=mysqli_fetch_array($select)) {

            $artworkID = $cart_array['artworkID'];
            $ownerID = $cart_array['userID'];
            $sum = $cart_array['price'];
            echo $artworkID." ".$ownerID." ".$sum;

            $sql_selectwork = "SELECT * FROM artworks WHERE artworkID=$artworkID";

            //orders中生成订单信息
            $sql_insert = "INSERT INTO orders (buyerID,owenerID,sum) VALUES ($userID,$ownerID,$sum)";
            $insert = mysqli_query($conn, $sql_insert);
            echo "insert_error:".mysqli_error($conn);

            $orderID = mysqli_insert_id($conn); //保存orderID
            echo $orderID;

            //更改users中用户的余额
            $new_balance = intval($_SESSION['balance'] - intval($sum));      //计算新余额
            $sql_updateBalance = "UPDATE users SET balance=$new_balance WHERE userID='$userID'";
            $updateBalance = mysqli_query($conn, $sql_updateBalance);
            if($updateBalance) echo "update balance success!";

            //更改artworks中艺术品的orderID
            $sql_updateWork = "UPDATE artworks SET orderID=$orderID  WHERE artworkID=$artworkID";
            $updateWork = mysqli_query($conn, $sql_updateBalance);
            if($updateWork) echo"update orderID success!";

            //carts中删除该商品
            $sql_delete = "DELETE FROM carts WHERE artworkID=$artworkID";
            $delete = mysqli_query($conn, $sql_delete);
            if($delete) echo "delete success!";
        }


    }
	
	//余额不足
	else {
		echo FALSE;
	}
	
	
