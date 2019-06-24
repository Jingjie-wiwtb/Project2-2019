<?php
$current_history = "personal_info";  //个人主页
include '../php/browse_history.php';


?>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人信息</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link href="../css/Home.css" rel="stylesheet" type="text/css" />
    <link href="../css/personal_info.css" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


</head>

<?php include '../php/nav.php';  ?>
<?php  //打印足迹
history_display($history);
?>

<!--   搜索框  -->

<div class="search-bar">
    <form>
        <input type="text" placeholder="请输入您要搜索的内容...">
        <a href="search.html"><i class="fa fa-search"></i>搜索</a>
    </form>
</div>


<div class="cart_body">
    <div class="userInf">
    <table>
        <tr>
            <th><img src="../images/交易记录/001020.jpg"></th>
            <th><?php echo $_SESSION['username']; ?></th>
        </tr>
        <tr class="alt">
            <td>电话</td><td><?php echo $_SESSION['tel']; ?></td>
        </tr>
        <tr class="alt">
            <td>邮箱</td><td><?php echo $_SESSION['email']; ?></td>
        </tr>
        <tr>
            <td>地址</td><td><?php echo $_SESSION['address']; ?></td>
        </tr>
        <tr class="alt">
            <td >余额</td><td id="balance"><?php echo $_SESSION['balance']; ?></td>
        </tr>
    </table>
        <button class="recharge_btn" onclick=recharge_show()>充值</button>
</div>



    <!-------------充值窗口------------->

    <div class="pop_back" id="recharge_pop_back" >
        <div id="recharge_pop_content" class="pop_content">
            <span id="recharge_close-btn" onclick="close_recharge()">×</span>
            <div class="pop_head">
                <h2>Welcome to Art Market!</h2>
            </div>
            <div class="pop_body">
                <h2>充值</h2>
                <form action="../php/recharge.php" method="POST" onsubmit="return recharge_check()">
                    <div>
                        <label for="recharge_num">请输入充值金额：</label>
                        <input type="text" name="recharge_num" id="recharge_num" onblur="recharge_check()">
                        <span class="default" id="errRecharge"></span>
                    </div>
                    <input type="submit" class="pop_submit" value="充值"></input>
                </form>
            </div>
        </div>
    </div>
    <!-- 弹窗内容结束 -->

<?php
    
	//上传的艺术品  uploadlist.php
    
   include '../php/conn.php';

	
	//单条上传订单展示
  function upload_display($artworkID,$imgFileName,$title,$artist,$timeReleased,$price) {
	
	    $upload = '<div class="cartCard container " style="height:150px"><div class="row">';
		$upload.= '<div class="col-md-3"><a href="goods_details.html" class="result_link" data-artworkID="'.$artworkID.'"><img style="height:100px; border-radius:5%" src=" ../resources/img/'.$imgFileName.'"></a></div>';
		$upload.= '<div class="col-md-5" >';
		$upload.= '<p class="art-name"><em>名称  '.$title.'</em>  艺术家  '.$artist.'</p>';
		$upload.= '<p class="price">价格  '.$price.'  修改时间： '.$timeReleased.'</p></div>';
		$upload.= '<div class="col-md-3"><button type="button" class="btn btn-warning delete_btn">删除</button>';
        $upload.= '<button type="button" class="btn btn-info editwork_btn">修改</button></div></div></div>';
		return $upload;
	}



	//单条已购买订单展示
function bought_display($artworkID,$imgFileName,$title,$timeCreated,$price){
	    $bought = '<div class="cartCard" >';
		$bought.= '<a href="goods_details.html" class="result_link" data-artworkID="'.$artworkID.'"><img  src=" ../resources/img/'.$imgFileName.'"></a>';
		$bought.= '<div class="dscpt_container" >';
		$bought.= '<h3 class="art-name">名称'.$title.'</h3>';
		$bought.= '<p>价格：'.$price.'</div>';
		$bought.= '<p >修改时间： '.$timeCreated.'</p>';		
		return $bought;
	
	}
	
	//单条卖出订单展示
function sold_display($artworkID,$imgFileName,$title,$timeCreated,$price,$buyerID,$email,$telephone,$address){
	    $sold = '<div class="cartCard" >';
		$sold.= '<a href="goods_details.html" class="result_link" data-artworkID="'.$artworkID.'"><img  src=" ../resources/img/'.$imgFileName.'"></a>';
		$sold.= '<div class="dscpt_container" >';
		$sold.= '<h3 class="art-name">名称'.$title.'</h3>';
		$sold.= '<p >卖出时间：'.$timeCreated.'</p>';
		$sold.= '<p>卖出价格：'.$price.'</p>';
		$sold.= '<div><h3>购买人信息<?h3><p>用户名'.$buyerID.'</div>';	
        $sold.= '<p>邮箱：'.$email.'</p>';
    	$sold.= '<p>电话：'.$telephone.'</p>';
        $sold.= '<p>地址：'.$address.'</p>';		
		return $sold;

	}



?>



<div class="bought">
    <h3>已购买的艺术品</h3>

<?php
    //function boughtList(){

    $buyerID = $_SESSION['userID'];

    $sql_select = "SELECT * FROM orders WHERE buyerID=$buyerID";  //查找artworks中该user拥有的artwork
    $result = mysqli_query($conn,$sql_select);   //

    if(!$result) {		 //若有结果
    echo '<div>您的订单为空</div>';
    }
    else {
    while($bought_array = mysqli_fetch_array($result))   //遍历输出搜索结果
    {
    $orderID = $bought_array['orderID'];

    $sql = "SELECT * FROM artworks WHERE orderID=$orderID";
    $select = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($select);

    echo upload_display($row['artworkID'],$row['imageFileName'],$row['title'],$row['timeCreated'],$row['price']);
    }
    }
   mysqli_free_result($result);
?>
    <!--
    <table>
        <tr>
            <th>商品</th>
            <th width="30%">订单编号</th>
            <th width="20%">订单时间</th>
            <th>订单金额</th>
        </tr>
        <tr>
            <td>
                <a href="goods_details.html"><img src="../images/交易记录/001280.jpg">商品名称</a>
            </td>
            <td>1233211234567</td>
            <td>xxxx.xx.xx</td>
            <td>$ 180,000,000</td>
        </tr>
        <tr>
            <td>
                <a href="goods_details.html"><img src="../images/交易记录/001270.jpg">商品名称</a>
            </td>
            <td>1233211234567</td>
            <td>xxxx.xx.xx</td>
            <td>$ 780,000,000</td>
        </tr>
        <tr>
            <td>
                <a href="goods_details.html"><img src="../images/交易记录/001260.jpg">商品名称</a>
            </td>
            <td>1233211234567</td>
            <td>xxxx.xx.xx</td>
            <td>$ 280,000,000</td>
        </tr>
    </table>
    -->
</div>

<div class="sold">
    <h3>已卖出的艺术品</h3>
    <?php

//function soldList(){
    $ownerID = $_SESSION['userID'];

$sql_select = "SELECT * FROM artworks WHERE ownerID=$ownerID AND orderID IS NOT NULL";  //查找artworks中该user有orderID的work
$result = mysqli_query($conn,$sql_select);


if(!$result) {		 //若有结果
    echo '<div>你还没有上传艺术品</div>';
}
else {

    while ($sold_array = mysqli_fetch_array($result)) {
        $orderID = $sold_array['orderID'];

        $sql = "SELECT * FROM orders LEFT JOIN users ON users.userID=orders.buyerID WHERE orderID=$orderID";
        $select = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($select);

        echo sold_display($row['artworkID'], $row['imgFileName'], $row['title'], $row['timeCreated'], $row['price'], $row['buyerID'], $row['email'], $row['tel'], $row['address']);
    }
}
    ?>
<!--
    <table>
        <tr>
            <th>商品</th>
            <th width="30%">订单编号</th>
            <th width="20%">订单时间</th>
            <th>订单金额</th>
        </tr>
        <tr>
            <td><a href="goods_details.html"><img src="../images/交易记录/001280.jpg">商品名称</a></td>
            <td>1233211234567</td>
            <td>xxxx.xx.xx</td>
            <td>$ 280,000,000</td>
        </tr>
        <tr>
            <td><a href="goods_details.html"><img src="../images/交易记录/001020.jpg">商品名称</a></td>
            <td>1233211234567</td>
            <td>xxxx.xx.xx</td>
            <td>$ 280,000,000</td>
        </tr>
        <tr>
            <td><a href="goods_details.html"><img src="../images/交易记录/001270.jpg">商品名称</a></td>
            <td>1233211234567</td>
            <td>xxxx.xx.xx</td>
            <td>$ 280,000,000</td>
        </tr>
    </table>

    -->
  </div>


<div class="uploaded">
        <h3>上传的艺术品</h3>
        <?php

        //function uploadList(){

        $ownerID = $_SESSION['userID'];

        $sql_select = "SELECT * FROM artworks WHERE ownerID= $ownerID ";  //查找artworks中该user拥有的artwork
        $result = mysqli_query($conn,$sql_select);

        if(!$result) {		 //若有结果
            echo '<div>你还没有上传艺术品</div>';
        }
        else {
            while($upload_array = mysqli_fetch_array($result))   //遍历输出搜索结果
            {
                echo upload_display($upload_array['artworkID'],$upload_array['imageFileName'],$upload_array['title'],$upload_array['artist'],$upload_array['timeReleased'],$upload_array['price']);
            }
        }

        ?>

        <!--
        <table>
            <tr>
                <th>商品图片</th>
                <th>商品名称</th>
                <th>上传时间</th>
            </tr>
            <tr>
                <td>
                    <a href="goods_details.html"><img src="../images/交易记录/001020.jpg">商品名称</a>
                </td>
                <td>商品名称</td>
                <td>上传时间</td>
            </tr>
            <tr>
                <td>
                    <a href="goods_details.html"><img src="../images/交易记录/001280.jpg">商品名称</a>
                </td>
                <td>商品名称</td>
                <td>上传时间</td>
            </tr>
            <tr>
                <td>
                    <a href="goods_details.html"><img src="../images/交易记录/001270.jpg">商品名称</a>
                </td>
                <td>商品名称</td>
                <td>上传时间</td>
            </tr>
        </table>
        -->
    </div>

</div>


<!--------页脚------>
<div class="footer">
    <ul class="nav_footer">
        <li>
            <h4>订单服务</h4>
            <ul>
                <li>购买指南</li>
                <li>支付方式</li>
                <li>送货政策</li>
            </ul>
        </li>
        <li>
            <h4>关于我们</h4>
            <ul>
                <li>公司简介</li>
                <li>官方微信</li>
                <li>联系我们</li>
            </ul>
        </li>
        <li>
            <h4>帮助</h4>
            <ul>
                <li>提出建议</li>
                <li>在线客服</li>
                <li>技术支持</li>
            </ul>
        </li>
    </ul>
    <div class="copyright">
        <p>Created by Jingjie He.   18307130370</p>
        <p>地址：复旦大学邯郸校区</p>
    </div>
</div>


</body>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="../javascript/main.js" type="text/javascript" defer="defer"></script>

<script src="../javascript/jquery.cookie.js"></script>
<script src="../javascript/personal_info.js" type="text/javascript" defer="defer"></script>


<?php
include '../php/loginout_function.php';
    ob_end_flush();
?>

<script>

    $(".editwork_btn").click(function(){
        let artworkID = $(this).data('artworkid');
        location.href="addwork.php?artworkID="+artworkID;

    });



</script>
</html>
