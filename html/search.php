<?php
$current_history = "search";  //搜索
include '../php/browse_history.php';
?>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-theme.css" />
    <link rel="stylesheet" href="../css/captions.css" />

    <link href="../css/Home.css" rel="stylesheet" type="text/css" />
    <link href="../css/search.css" rel="stylesheet" type="text/css" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <script src="../javascript/jquery-3.4.1.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>   -->
    <script src="../javascript/main.js" type="text/javascript" defer="defer"></script>
    <script src="../javascript/search.js" type="text/javascript" defer="defer"></script>





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
    <form >
        <input type="text" placeholder="   请输入关键词" name="keyword"  id="keyword">
        <a   id="search_btn"><i class="fa fa-search"></i>搜索</a>
    </form>
</div>

<div class="searching_way">
    <form  id="search_key" >   <!--method="get" action="search.php" -->
        搜索字段：
        <label><input type="checkbox"  value="title" name = "search_key">名称</label>
        <label><input type="checkbox" value="artist" name = "search_key"  checked="checked">作者</label>
        <label><input type="checkbox" value="description" name = "search_key">简介</label>
    </form>
</div>

<div class="searching_way">
    <form  id="order_key"  >
        排序方式：
        <label><input type="radio"  name="order_key"  value="price" checked="checked">价格</label>
       <label><input type="radio" name="order_key" value="view">点击量</label>
    </form>
</div>
<!--排序方式选择-->





<!--搜索结果-->


<div class="result_container" >
    <div class="null_result" style="color:cornsilk;text-align:center;height:50px;margin:30px auto;display:none" ><span>搜索结果为空</span></div>
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


</body>


<?php    //检查登陆情况

//  $keyword = $_GET['keyword'];
if(isset($_SESSION['username']))
    ?>
    <script>var logincheck = 1;</script>"

    <?php  ;  //end if ?>



<?php
include '../php/loginout_function.php';
?>




<script>
    /*      window.onload = function(){
              var keyword = window.location.search.split("=")[1];

          };
*/
    //获取搜索结果排序方式
 /*   $("#order_key").change(function(){
        var	order_key = $('input[name=order_key]:checked').val();
        console.log("order_key"+order_key);

    });*/

    //获取搜索结果排序方式
    /*
function setOrder_key(){
        var	order_key = $('input[name=order_key]:checked').val();
        console.log("order_key"+order_key);
        return true;
    }
*/
    //获取关键词查询字段
/*
    var keyword = window.location.search.split("=")[1];
    //    var keyword =document.getElementById("keyword").value; //$('input[name = keyword]').val();

*/

//先定义一个全局变量totalpage

    var totalPage = 1;


    //分页加载函数
    function search_loadflickr(keyword,order_key,search_key) {


        console.log("keyword:"+keyword);
        $.ajax({
            type:"GET",
            async:false,   //同步// 默认是true（异步）
            url:"../php/search_load.php",
            data:{
                //page:page,
                keyword:keyword,
                search_key:search_key


            },
            dataType:"text",
            success:function(lastPage){
                if(lastPage==0)
                    totalPage=1;
                else
                   totalPage = lastPage;    //对全局变量进行赋值

                console.log("data:"+lastPage);

                let flickr = '';
                //“上一页”按钮
                flickr += "<li class='pre-page'><a><<</a></li>";

                //加载分页列表>
                var firstflickr = (page-4>=1)?(page-4):1;

                //test
                console.log("page:"+page);
                console.log("firstflickr:"+firstflickr);


                for(let i=firstflickr; i<firstflickr+5;i++)    //i为页数
                {
                    if(i<=totalPage) {
                        if(i == page)
                            flickr += '<li><a class="flickr_list active">'+i+'</a></li>';  //打印当前页数时+‘active'类
                        else
                            flickr += '<li><a class="flickr_list">'+i+'</a></li>';
                    }
                }

                //“下一页”按钮
                flickr += "<li class='next-page'><a>>></a></li>";
                $('.page-flickr').html(flickr);

            }

        });
    }


    //逐条打印搜索结果函数

    function result_display(artworkID,imageFileName,title,artist,description,price,view) {
        var display = '';
        display = '<li><div class="resultCard" style="min-height:300px">';
        display+= '<a class="result_link" data-artworkID="'+artworkID+'"><img style="max-height:300px" class="img-responsive good_img" data-artworkID="'+artworkID+'" src="../resources/img/'+imageFileName+'"></a>';
        display+= '<div class="result_dscpt">';
        display+= '<h3 class="art-name">'+title+'</h3>';
        display+= '作者：'+artist;   // '作者：<a href class="author">'+artist+'</a>';
        display+= '<p class="description" style=" display: -webkit-box; -webkit-box-orient:vertical;-webkit-line-clamp: 5;overflow:hidden;"'+description+'</p>';
        display+= '<div class="price">商品价格：'+price+'    '+'浏览量:'+view+'</div>';
        display+= '<button type="button" class="addcart btn btn-info" data-artworkID="'+artworkID+'">加入购物车</button></div></div></li>';
        return display;
    }





    //分页搜索结果显示函数
    function search_display(keyword,order_key,search_key)
    {

        console.log("search_display!");

        console.log("order_key:"+order_key);
        $.ajax({
            type:"GET",
            async:false,   //同步   默认是true（异步）
            url:"../php/search_display.php",
            data: {
                page:page,
                search_key:search_key,
                keyword:keyword,
                order_key:order_key,
            },
            dataType:"text",
            success:function(data) {
                if(data==1){
                    alert("请输入关键词！");
                }
                else if (data==0){
                    document.getElementsByClassName('null_result').style.display="block";
                }
                else {
                    console.log(typeof (data));
                    console.log(data);
                    var obj = JSON.parse(data);
                    console.log(typeof (obj));
                    console.log(obj);
                    // let Obj = eval("("+data+")");     //传输过来的data是字符串  要先转换为json对象才能用
                    var searchResult = "";
                    for (let p in obj) {
                        let artworkID = obj[p].artworkID;
                        let imageFileName = obj[p].imageFileName;
                        let title = obj[p].title;
                        let artist = obj[p].artist;
                        let description = obj[p].description;
                        let price = obj[p].price;
                        let view = obj[p].view;
                        searchResult += result_display(artworkID, imageFileName, title, artist, description, price,view);
                    }
                    $('.searchResult_list').html(searchResult);
                }

            }
        });

    }


//document.onload=function() {

//排序方式、关键词、搜索字段的赋值

    var	keyword = $('input[name=keyword]').val();

    console.log("keyword"+keyword);
    var	order_key = $('input[name=order_key]:checked').val();
    console.log("order_key"+order_key);
    var search_key="";
    test= document.getElementsByName("search_key");
    console.log(typeof(test));
    for(let k in test){
        console.log(k);
        if (test[k].checked)
            search_key+=test[k].value+",";
    }



    console.log("search_key"+search_key);
    var page = 1;
    search_loadflickr(keyword,order_key,search_key);
    search_display(keyword,order_key,search_key);

//};



    //上一页点击事件
    $(".pre-page").click(function()
    {

        console.log("pre-page:sucess");
        if(page>1)
            page = parseInt(page)-1;
        else
            page=1;

        search_loadflickr(keyword,order_key,search_key);
        search_display(keyword,order_key,search_key);

    });

    //下一页点击事件
    $(".next-page").click(function()
    {

        if(page<totalPage)
            page = parseInt(page)+1;   //如果是最后一页则不变

        search_loadflickr(keyword,order_key,search_key);
        search_display(keyword,order_key,search_key);
    });


//商品链接点击事件
    $('.result_link').click(function() {
        console.log("click success!");
		var artworkID = $(this).data('artworkid');     //id被自动转化为小写了。。。
		console.log(artworkID);
		window.location.href = "goods_details.php?artworkID="+artworkID;

		});		






//页数列表的点击事件
$(".flickr_list").click(function(){

    console.log("flickr_list:success");
	var page = $(this).text();   //把列表内容（即页数）传给page
	console.log("getpage:"+page);
	search_loadflickr(keyword,order_key,search_key);
	
	search_display(keyword,order_key,search_key);
    });

//搜索方式点击事件
    $("#search_key").change(function(){
        var search_key="";
        test= document.getElementsByName("search_key");
        console.log(typeof(test));
        for(let k in test){
            console.log(k);
            if (test[k].checked)
                search_key+=test[k].value+",";
        }


        $.ajax({
            type:"GET",
            async:false,   //同步   默认是true（异步）
            url:"../php/search_display.php",
            data:{search_key:search_key},
            dataType:"TEXT",
            success:function(data){
                search_key:search_key
            }
        });

        search_loadflickr(keyword,order_key,search_key);
        search_display(keyword,order_key,search_key);
    });



//排序方式点击事件
$("#order_key").change(function(){
    var	keyword = $('input[name=keyword]').val();
    console.log("order_key:success");
    var order_key = $('input[name=order_key]:checked').val();
   // var order_key = document.getElementById("order_key").value;
    console.log("order_key:"+order_key);


	$.ajax({
			type:"GET",
			async:false,   //同步   默认是true（异步）
			url:"../php/search_display.php",			
			data:{order_key:order_key},
			dataType:"TEXT",
			success:function(data){
			    order_key:order_key
			}
		});
	
	search_loadflickr(keyword,order_key,search_key);
	search_display(keyword,order_key,search_key);
});


//搜索按钮点击事件
    $("#search_btn").click(function(){
		//重新加载

        console.log("search.click: success!");
        var	keyword = $('input[name=keyword]').val();

        console.log("keyword"+keyword);
        var	order_key = $('input[name=order_key]:checked').val();
        console.log("order_key"+order_key);

        var search_key='';
        $("input[name=search_key]:checked").each(function(){
            search_key+=$(this).val()+",";
        });
        console.log("search_key"+search_key);

		search_loadflickr(keyword,order_key,search_key);
		search_display(keyword,order_key,search_key);
	});

</script>

</html>


<?php   ob_end_flush();?>