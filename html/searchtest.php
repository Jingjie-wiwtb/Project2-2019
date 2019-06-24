
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css"/>
    <link href="../css/Home.css" rel="stylesheet" type="text/css" />
    <link href="../css/search.css" rel="stylesheet" type="text/css" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="../javascript/jquery-3.4.1.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>   -->
    <script src="../javascript/main.js" type="text/javascript" defer="defer"></script>
    <script src="../javascript/search.js" type="text/javascript" defer="defer"></script>





</head>

<body>

<div class="nav">      <!--导航栏-->
    <img class="nav_background" src="../images/nav.jpg">
    <img class="logo" src="../images/logo.png">
    <ul>

        <li><a href="cart.html">购物车</a></li>
        <div id="login_change">
            <li><a id="register_btn">注册</a></li>
            <li><a id="login_btn" class="btn">登陆</a></li>
        </div>
        <div id="logout_change">
            <li id="logout_btn"><a  onclick="logout()">登出</a></li>
            <li><a href="personal_info.html">Jingjie</a></li>
        </div>

        <li> <a class="drop-btn" href="#分类">分类</a></li>
        <li><a class="new.html" href="Home.html">主页</a></li>
    </ul>
</div>



<img class="black_pointer" src="../images/black_pointer_cut.png">



<!--   搜索框  -->

<div class="search-bar">
    <form >
        <input type="text" placeholder="   请输入关键词" name="keyword"  id="keyword">
        <button type="button" class="" value="搜索"><i class="fa fa-search"></i>搜索</button>
    </form>
</div>

<div class="searching_way">
    <form  id="search_key" method="get" action="search.php" >
        搜索字段：
        <label><input type="checkbox"  value="title" name = "search_key">名称</label>
        <label><input type="checkbox" value="artist " name = "search_key">作者</label>
        <label><input type="checkbox" value="description" name = "search_key">简介</label>
    </form>
</div>

<div class="searching_way">
    <form  id="order_key" method="get" action="search.php" >
        排序方式：
        <label><input type="radio"  name="order_key"  value="price" checked="checked">价格</label>
       <label><input type="radio" name="order_key" value="view">点击量</label>
    </form>
</div>
<!--排序方式选择-->


<script>



</script>



<!--搜索结果-->


<div class="result_container" >
    <ul class="searchResult_list">
	<!--
    <li>
        <div class="resultCard">
            <a href="goods_details.html" class="result_link"><img src="../images/steve-johnson-643287-unsplash.jpg"></a>
            <div class="result_dscpt">
                <a><h3 class="art-name">River of Mendicanti</h3></a>
                作者：<a href class="author">加纳莱托 Antonio Canal</a>
                <p class="discription"> This is the case with the River of Mendicanti, where the artist depicts a working-class area, portrayed in all its coarse beauty.</p>
                <div class="price">商品价格：100,000,000 </div>
                <button type="button" onclick=addcart_alert() >加入购物车</button>
                <button type="button" onclick=addcart_alert() >加入心愿单</button>
            </div>
        </div>
    </li>
   -->
    </ul>

</div>





<!-------------已加入购物车！弹窗--------

<div class="pop_back" id="addcart_pop_back" >
    <div id="addcart_pop_content" class="pop_content">
        <span id="addcart_close-btn" onclick="close_addcart()">×</span>
        <div class="pop_head">
            <h2>Welcome to Art Market!</h2>
        </div>
        <div class="pop_body">
            <p> </p>
            <h2>添加成功！</h2>

            <form action="#" method="POST">
                <a  class="pop_submit" onclick="close_addcart()">确认</a>
            </form>
        </div>
    </div>
</div>


-----弹窗内容结束 -->




<!-------------登陆窗口------------->

<div class="pop_back" id="login_pop_back" >
    <div id="login_pop_content" class="pop_content">
        <span id="login_close-btn">×</span>
        <div class="pop_head">
            <h2>Welcome to Art Market!</h2>
        </div>
        <div class="pop_body">
            <h2>登陆</h2>
            <form action="#" method="POST">
                <div>
                    <label for="login_name">用户名:</label>
                    <input type="text" name="name" id="login_name" placeholder="用户名" onblur="checklogin_name()" required >
                    <span class="default" id="errLname"></span>
                </div>
                <div>
                    <label for="login_password">密码:</label>
                    <input type="password" name="password" id="login_password" onblur="checklogin_psw()" placeholder="密码（注意大小写）" required >
                    <span class="default" id="errLpsw"></span>
                </div>
                <div>
                    <label for="input_vcode">验证码</label>
                    <input type="text" name="input_vcode" id="input_vcode"  onblur="validate()" placeholder="请输入图中的验证码">
                    <span class="default" id="errVerifycode"></span>
                    <a class="change_vcode" onclick="createCode()"> 换一张</a>
                    <label for="print_vcode"></label>
                    <input  id="print_vcode" class="code" disabled="disabled">

                </div>
                <a  class="pop_submit" onclick="logincheck()">登陆</a>
            </form>
        </div>
    </div>
</div>
<!-- 弹窗内容结束 -->



<ul class="page-flickr">

</ul>


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

<button id="test">test</button>
</body>



<script>

 $("#test").click(function search_request() {
     $.ajax({
         type: "POST",
         async: false,
         url: "../php/search_request.php",
         data{},
         dataType: "JSON",
         success(data) {
             alert(data);
         }
     });
 });
 //


</script>

</html>
