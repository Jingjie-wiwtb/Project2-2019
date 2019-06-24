//artwork_detail.php

<?php


function detail_display($title,$artworkID,$description,$price,$yearOfWork,$genre,$artist,$view){

    $display ='<div class="goods-name"><h2>'.$title.'商品名称</h2></div>';
    $display.='<div class="details-img"><img src="../resources/img/'.$artworkID.'.jpg"></div>';
    $display.='<div class="goods-dscp"><h4>商品简介:</h4><p>'.$description.'</p></div>';
    $display.='<div class="price"><h4>商品价格：'.$price.'</h4> </div>';
    $display.='<button type="button" class="addcart" data-artworkID="'.$artworkID.'>加入购物车</button>';
    $display.='<table><tr><th colspan="2">商品详情</th></tr>';
    $display.='<tr><td width="40%">Date</td><td>'.$yearOfWork.'</td></tr>';
    $display.='<tr><td>流派</td><td>'.$genre.'</td></tr>';
    $display.='<tr><td>艺术家</td><td>'.$artist.'</td></tr>';
    $display.='<tr><td>访问量</td><td>'.$view.'</td></tr></table>';

    echo $display;
   }


   include 'conn.php';
   
    $artworkID = $_GET('artworkID');
   
   
    $sql_select = "SELECT * FROM artworks WHERE artworkID = '$artworkID'";
   
    $result = mysqli_query($conn,$sql_select);   //查找用户信息
   
    $row = mysqli_fetch_array($result);
	
	
	detail_display($row['title'],$row['artworkID'],$row['description'],$row['price'],$row['yearOfWork'],$row['genre'],$row['artist'],$row['view']);
	
?>	
   
