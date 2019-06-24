<?php
    	//单条购物车展示函数
    function cart_display($artworkID,$imageFileName,$title,$artist,$description,$price) {
	
	    $display = '<div class="cartCard" >';
		$display.= '<a href="goods_details.php" class="result_link" data-artworkID="'.$artworkID.'"><img  src="../resources/img/'.$imageFileName.'"></a>';
		$display.= '<div class="dscpt_container" >';
		$display.= '<h3 class="art-name">名称  '.$title.'</h3>';
		$display.= '<a class="author" >艺术家 '.$artist.'</a>';
		$display.= '<p class="description"  style=" display: -webkit-box; -webkit-box-orient:vertical;-webkit-line-clamp: 5;overflow:hidden;">'.$description.'</p>';
		$display.= '<div class="price">价格 '.$price.'</div>';
		$display.= '<form method="GET" action="../php/delete_cart.php" onsubmit="return confirm(\'确认删除？\')"><input name="artworkID" value="'.$artworkID.'" style="display:none"/><button type="submit" class="delete_cart btn btn-warning">删除</button></form></div></div>';
        return $display;
	}



    if(isset($_SESSION['userID']))
	    $userID = $_SESSION['userID'];
    else
        echo "<script>alert('请先登录！')";
	
	
	$sql_select = "SELECT * FROM artworks LEFT JOIN carts ON artworks.artworkID=carts.artworkID WHERE carts.userID=$userID";   //ORDER BY carts.cartID
   
    $result = mysqli_query($conn,$sql_select);   //查找carts中该userID对应artworkID在artworks表中的相关信息
   

	
	if(!$result) {
		
		echo '<div class="empty_cart"><h2>购物车为空</h2></div>';
	}
	else {
		$cartContent = "";
	
	    $totalPrice=0;
	   
        while($row = mysqli_fetch_array($result))   //遍历输出搜索结果
	    {
		   $totalPrice += $row['price'];
		   
		   $cartContent .= cart_display($row['artworkID'],$row['imageFileName'],$row['title'],$row['artist'],$row['description'],$row['price']);
	    }	
		
	}

	
	