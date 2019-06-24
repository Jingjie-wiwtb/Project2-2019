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

<?php include '../php/nav.php';  ?>
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
		<h3 style="color:cornsilk">合计：<?php echo $totalPrice; ?>
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



<!-------------注册窗口------------>

<div class="pop_back" id="register_pop_back" >
    <div id="register_pop_content" class="pop_content">
        <span id="register_close-btn">×</span>
        <div class="pop_head">
            <h2>Welcome to Art Market!</h2>
        </div>
        <div class="pop_body">
            <h2>注册</h2>
            <form action="#" method="POST">
                <div>
                    <label for="username">请设置用户名:</label>
                    <input type="text" name="username" id="username" placeholder="（不能为纯数字或纯字母" onblur="checkUsername()">
                    <span class="default" id="errname"></span>
                </div>
                <div>
                    <label for="userpassword">请设置密码:</label>
                    <input type="password" name="userpassword" id="userpassword" placeholder="（至少6位，注意大小写）" onblur="checkPassword()">
                    <span class="default" id="errpsw"></span>
                </div>
                <div>
                    <label for="confirm_password">确认密码:</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="请再次输入密码" onblur="confirmPassword()">
                    <span class="default" id="errpsw2"></span>
                </div>
                <div>
                    <label for="telephone">请输入手机号码:</label>
                    <input type="tel" name="telephone" id="telephone" placeholder="手机号码" onblur="checktel()">
                    <span class="default" id="errtel"></span>
                </div>
                <input class="pop_submit" type="submit" value="注册" name="register">
            </form>
        </div>
    </div>
</div>

</body>

<?php
include '../php/loginout_function.php';
?>



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

                console.log(data);
                if(data){
                    console.log(data);

                    alert('购买成功！');

                    window.location.href="cart.php";    //刷新购物车
                }
                else
                    alert('余额不足！请先充值');
            }
        });
    });




</script>

</html>
<?php   ob_end_flush();?>