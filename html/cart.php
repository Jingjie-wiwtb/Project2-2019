<?php
$current_history = "cart";  //购物车
include '../php/browse_history.php';
?>


<?php
    include '../php/conn.php';
    include '../php/cart_display.php';
	
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的购物车</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css" />
    <link href="../css/Home.css" rel="stylesheet" type="text/css" />
    <link href="../css/cart.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="../javascript/main.js" type="text/javascript" defer="defer"></script>
    <script src="../javascript/cart.js" type="text/javascript" defer="defer"></script>
    <script src="../javascript/jquery.cookie.js"></script>

    <!-- <link href="netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
 -->

</head>
<body>

<?php include '../php/nav.php';

if(!isset($_SESSION['username']))
    echo "<script>alert('请先登陆！');history.go(-1);</script>";


?>
<?php  //打印足迹
history_display($history);


?>
<script>


    console.log(document.cookie);
</script>
<!--   搜索框  -->

<div class="search-bar">
    <form>
        <input type="text" placeholder="请输入关键词">
        <a href="search.php"><i class="fa fa-search"></i>搜索</a>
    </form>
</div>

<aside class="left_aside">
    <img alt="aside" src="../images/samuel-zeller-34751-unsplash.jpg">
</aside>

<aside class="right_aside">
    <img alt="aside" src="../images/right.jpg">
</aside>




<div class="cartContainer">
     
	 
	<?php echo $cartContent;  ?>
	    
		
		
<!--
    <div class="empty_cart">
        <h2>购物车为空</h2>
    </div>
    <div class="cartCard" id="cart_1">
        <a href="goods_details.html"><img  src="../images/henrik-donnestad-506152-unsplash.jpg"></a>
        <div class="dscpt_container" >
            <h3 class="art-name">River of Mendicanti</h3>
            <a class="author" href="search.html">加纳莱托 Antonio Canal</a>
            <p class="discription"> This is the case with the River of Mendicanti, where the artist depicts a working-class area, portrayed in all its coarse beauty.</p>
            <div class="price">商品价格：100,000,000 </div>
            <button type="button" onclick=" delete_confirm_1()">删除</button>
            <button type="button">购买</button>
        </div>
    </div>
	
    <div class="cartCard" id="cart_2">
        <a href="goods_details.html"><img src="../images/steve-johnson-643287-unsplash.jpg"></a>
        <div class="dscpt_container">
            <h3 class="art-name">River of Mendicanti</h3>
            <a class="author" href="search.html">加纳莱托 Antonio Canal</a>
            <p class="discription"> This is the case with the River of Mendicanti, where the artist depicts a working-class area, portrayed in all its coarse beauty.</p>
            <div class="price">商品价格：100,000,000 </div>
            <button type="button" onclick="delete_confirm_2()">删除</button>
            <button type="button">购买</button>
        </div>
    </div>
    <div class="cartCard" id="cart_3">
        <a href="goods_details.html"><img  src="../images/henrik-donnestad-506152-unsplash.jpg"></a>
        <div class="dscpt_container" >
            <h3 class="art-name">River of Mendicanti</h3>
            <a class="author" href="search.html">加纳莱托 Antonio Canal</a>
            <p class="discription"> This is the case with the River of Mendicanti, where the artist depicts a working-class area, portrayed in all its coarse beauty.</p>
            <div class="price">商品价格：100,000,000 </div>
            <button type="button" onclick=" delete_confirm_3()">删除</button>
            <button type="button">购买</button>
        </div>
-->		<!--pj1样例-->
		
	<div class="totalPrice">	    
		<h3 style="color:cornsilk">合计：<?php $_SESSION['totalPrice']=$totalPrice; echo $totalPrice; ?>
		<button class="btn btn-info buy_btn" data-totalPrice=<?php echo '"'.$totalPrice.'"'; ?>>结算</button>
    </div>



<!--pj1恢复最近删除功能

    <div class="recent_del">
        <h3>最近删除：</h3>
        <p>（点击图片恢复）</p>
        <div >
            <a href="#" onclick="document.getElementById('cart_1').style.display='block';document.getElementById('recart_1').style.display='none'" id="recart_1">
                <img  src="../images/henrik-donnestad-506152-unsplash.jpg">
            </a>
        </div>
        <div class="recent_del">
            <a href="#" onclick="document.getElementById('cart_2').style.display='block';document.getElementById('recart_2').style.display='none'" id="recart_2">
                <img src="../images/steve-johnson-643287-unsplash.jpg">
            </a>
        </div>
        <div class="recent_del">
            <a href="#" onclick="document.getElementById('cart_3').style.display='block';document.getElementById('recart_3').style.display='none'" id="recart_3">
                <img  src="../images/henrik-donnestad-506152-unsplash.jpg">
            </a>
        </div>
    </div>
-->

</div>


<!--
-----------------------------------------分页--------------------------
-->

<!--

<ul class="page-flickr">
    <li class="pre-page"><a href=""><<</a></li>
    <li class="current"><a href="">1</a></li>
    <li><a href="">2</a></li>
    <li><a href="">3</a></li>
    <li><a href=""><span>...</span></a></li>
    <li><a href="">8</a></li>
    <li><a href="">9</a></li>
    <li><a href="">10</a></li>
    <li class="next-page"><a href="">>></a></li>
</ul>
-->



</body>

<?php
include '../php/loginout_function.php';
?>





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





<script>

    // language=JQuery-CSS
    $('.buy_btn').click(function(){
        var totalPrice = $(this).data('totalprice');
        console.log(totalPrice);

        //把购物车总价传到 buy.php
        $.ajax({
            type:"GET",
            async:false,   //同步   默认是true（异步）
            url:"../php/buy.php",
            data:{
                totalPrice:totalPrice
            },
            dataType:"TEXT",
            success:function(data){

                if(data==1)
                    alert('订单中有商品已被删除！');
                console.log(data);
                if(data==2)
                    alert('有商品信息被修改！请查看！');
                if(data==3)
                    alert('订单中有商品已被购买！');
                if(data==0)
                    alert('余额不足！请先充值');
                else{
                    console.log(data);

                    alert('购买成功！');

                   window.location.href="cart.php";    //刷新购物车
                }

            }
        });
    });




    $(document).on('click','.result_link',function() {
        let artworkID = $(this).data('artworkid');
        //location.href="goods_details.php?artworkID="+artworkID;

    });



</script>

</html>
<?php   ob_end_flush();?>