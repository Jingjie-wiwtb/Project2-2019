<?php

    include 'conn.php';
    
    session_start();
	
	$totalPrice = $_SESSION['totalPrice'];   //获得总价

	$userID = $_SESSION['userID'];   //目前用户ID
	
	//echo $totalPrice." ".$userID;


	
	//若余额充足
	if($_SESSION['balance']>=$totalPrice) {

        //orders中生成订单信息
        $sql_insert = "INSERT INTO orders (buyerID,sum) VALUES ($userID,$totalPrice)";
        $insert = mysqli_query($conn, $sql_insert);
    //    echo "insert_error:".mysqli_error($conn);

        $orderID = mysqli_insert_id($conn); //保存orderID
   //     echo "orderID:".$orderID;

//------------------------------------------------------------------------

       // $sql_select = "SELECT * FROM artworks LEFT JOIN carts ON artworks.artworkID=carts.artworkID WHERE carts.userID=$userID";   //ORDER BY carts.cartID
        $sql_select = "SELECT * FROM carts WHERE userID=$userID";
        echo $sql_select;
        // echo $sql_select;
       // $select = "SELECT * FROM carts WHERE userID = $userID";
        $result = mysqli_query($conn,$sql_select);   //按该用户查找cart中对应的artwork

        //对购物车中的所有商品逐个操作：
    //  $cart_array=mysqli_fetch_array($result);
     //  var_dump($cart_array);
 /*  //   echo $cart_array['artworkID'];

       $cartID = array();    //创建数组储存该购物车中的artworkID

     //   $j=0;
       $len = $result->num_rows;
  //    echo "len=".$len." ";

for($j=0;$j<$len;$j++){
  //  echo $cart_array["artworkID"];
    $cartID[$j]=$cart_array['artworkID'];
}
   */
       while($cart_array=mysqli_fetch_array($result)){
    /*       echo $cart_array["artworkID"];
           $cartID[$j]=$cart_array['artworkID'];
           $j++;
       */
/*
     var_dump($cartID);


       foreach ($cartID as $value){    //对每个artworkID进行操作
  */

           $value=$cart_array['artworkID'];
           //carts中删除该商品   （改没改都要删除）

           $sql_delete = "DELETE FROM carts WHERE artworkID=$value";  //$value";
           $delete = mysqli_query($conn, $sql_delete);
           if ($delete)// echo "delete success!  ";




           $each_select = "SELECT * FROM artworks WHERE artworkID=$value";    //在artworks中搜索
           $result_select = mysqli_query($conn,$each_select);

         //  echo "deletecheck:".$result->num_rows;
//var_dump($row=mysqli_fetch_array($result));
          //检查是否被删除

           if (!($row=mysqli_fetch_array($result_select))) {    //如果artworks里面已经没有该ID了，  删除这条购物车

               //echo "deleted id:" . $each_select['title'];

               //删除该条订单并返回

               $order_delete="DELETE FROM orders WHERE orderID =$orderID";
               $odel_result = mysqli_query($conn,$order_delete);

               echo "1";

           }

           //如果没删除
           else {

               //$row = mysqli_fetch_array($result);
               $artworkID = $value;
             //  $ownerID = $userID;// $cart_array['userID'];
               $price = $row['price'];
               $ownerID = $row['ownerID'];
              // echo "price: ".$price;

               //检查是否被购买
              // echo "orderID = ".$row['orderID']." ";
              // echo"deleteorderID: ".$orderID;

               //是否更改过
               if (isset($_SESSION["change"][$artworkID])) {     //如果设置过该ID的session则做过修改

                   echo "2";
                   session_unset($_SESSION["change"][$value]);

               }

               //没改过
               else if (!$row['orderID']) {                     //没orderID   可以买

                   //更改users中用户的余额
                   $new_balance = intval($_SESSION['balance'] - intval($price));      //计算新余额
                   $_SESSION['balance'] = $new_balance;     //更新session中的余额；
                   $sql_updateBalance = "UPDATE users SET balance=$new_balance WHERE userID='$userID'";
                   $updateBalance = mysqli_query($conn, $sql_updateBalance);
                   if ($updateBalance)
                  //     echo "update balance success!  ";

                   //更改artworks中艺术品的orderID
                   $sql_updateWork = "UPDATE artworks SET orderID = $orderID WHERE artworkID=$value";
                   $updateWork = mysqli_query($conn, $sql_updateWork);

                 //  echo "update".mysqli_error($conn);

                //   if ($updateWork) {
                   //    echo "update orderID success!  ";

                       //    $delete_change = "DELETE FROM carts WHERE artworkID = $artworkID";
                       //    $result = mysqli_query($conn, $delete_change);
                //   }

                   $sql_pay="UPDATE users SET balance = balance+$price WHERE userID =$ownerID";
                   $pay_result = mysqli_query($conn,$sql_pay);

               }

               //确认完毕后更改artwork中的信息

               else {  //改过了

                   $order_delete = "DELETE FROM orders WHERE orderID =$orderID";
                   $odel_result = mysqli_query($conn, $order_delete);

                   echo "3";

                   //    $delete_change = "DELETE FROM carts WHERE artworkID = $artworkID";
                   //    $result = mysqli_query($conn, $delete_change);

               }


               }

           }

        }   //循环操作完成


	
	//余额不足
	else {
		echo 0;
	}
	
	
