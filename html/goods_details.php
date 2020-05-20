<?php
$current_history = "goods_details";  //商品详情
include '../php/browse_history.php';
?>

    <script>
        console.log(document.cookie);
    </script>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品详情</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css" />
    <link href="../css/Home.css" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="../javascript/jquery-3.4.1.js"></script>
    <script src="../javascript/jquery.cookie.js"></script>
    <script src="../javascript/main.js" type="text/javascript" defer="defer"></script>
</head>

<body>

<?php include '../php/nav.php';  ?>

<?php  //打印足迹
history_display($_COOKIE['history']);
?>

<div class="search-bar">
    <form>
        <input type="text" placeholder="   请输入关键词" name="keyword"  id="keyword">
        <a   class="search_btn"><i class="fa fa-search"></i>搜索</a>
    </form>
</div>


<!--  -------------------------Goods-container----------->
<div class="goods-container">



    <!--
        <div class="goods-name"><h2>商品名称</h2></div>

        <div class="details-img">
            <img src="../images/商品详情/001100.jpg">
            <div class="box"></div>
        </div>


        <div class="goods-details">

            <div class="goods-dscp">
               <h4>商品简介:</h4>
               <p>Their romantic representations contributed to public sentiment that America’s natural resources should remain pristine for future generations, prompting the federal government to set aside land for preservation for the first time.</p>
            </div>
            <div class="price">
              <h4>商品价格：100,000,000</h4> </div>
            <button type="button" class="addcart" >加入购物车</button>
            <button type="button" onclick=addcart_alert() >加入心愿单</button>
            <table>
              <tr><th colspan="2">商品详情</th></tr>
                <tr>
                    <td width="40%">Date</td><td>xxxx.xx.xx</td>
              </tr>
              <tr>
                  <td>Material</td>
                  <td> Oil on canvas </td>
              </tr>
                 <tr>
                  <td>Size</td>
                     <td>Medium</td>
              </tr>
              <tr>
                  <td>Artist</td>
                  <td><a class="author" href="search.html"> Unknown</a> </td>
              </tr>
              <tr>
                  <td> Category</td>
                  <td>Oil Painting</td>
              </tr>
              <tr>
                  <td>Subject</td>
                  <td>Abstract</td>
              </tr>
            </table>
        </div>
    -->
	
</div>


<script>
//加入购物车事件


</script>




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


<?php
include '../php/loginout_function.php';
?>

<script>

    var artworkID = window.location.search.substring(1).split("=")[1];
    console.log(artworkID);
    $.ajax({
        type:"GET",
        async:false,   //同步   默认是true（异步）
        url:"../php/detail_display.php",
        data:{artworkID:artworkID},
        dataType:"json",
        success:function(data) {
            console.log(typeof(data));
            console.log("data: "+data);
            let title=data.title;
            let artworkID = data.artworkID;
            let description =data.description;
            let price = data.price;
            let yearOfWork = data.yearOfWork;
            let genre = data.genre;
            let artist = data.artist;
            let view = data.view;
            let orderID = data.orderID;
            let imageFileName = data.imageFileName;

            console.log(imageFileName);


            $('.goods-container').html(detail_display(title,artworkID,description,price,yearOfWork,genre,artist,view,orderID,imageFileName));

        }
    });


    function detail_display(title,artworkID,description,price,yearOfWork,genre,artist,view,orderID,imageFileName){
        var display = "";
        display ='<div class="goods-name"><h2>'+title+'</h2></div>';
        display+='<div class="details-img"><img src="../resources/img/'+imageFileName+'"></div>';
        display+='<div><div class="goods-dscp"><h4>商品简介:</h4><p>'+description+'</p></div>';
        display+='<div class="price"><h4>商品价格：'+price+'</h4> </div>';

        display+='<table style="color:cornsilk;font-size:18px;padding:20px;"><tr><th colspan="2">商品详情</th></tr>';
        display+='<tr><td width="40%">Date</td><td>'+yearOfWork+'</td></tr>';
        display+='<tr><td>流派</td><td>'+genre+'</td></tr>';
        display+='<tr><td>艺术家</td><td>'+artist+'</td></tr>';
        display+='<tr><td>访问量</td><td>'+view+'</td></tr></table>';
        if(!orderID)  {
            display+='<button type="button" class="addcart" data-artworkID="'+artworkID+'">加入购物车</button>';

        }
        else{
            display+='<p>已售出!</p></div>';
            console.log(orderID);
        }

        return display;
    }




</script>
</html>

<?php   ob_end_flush();?>