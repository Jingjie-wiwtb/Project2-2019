<?php
$current_history = "add_work";  //添加商品
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

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="../javascript/jquery.cookie.js"></script>
    <script src="../javascript/jquery-3.4.1.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>   -->
    <script src="../javascript/main.js" type="text/javascript" defer="defer"></script>
    <script src="../javascript/search.js" type="text/javascript" defer="defer"></script>

</head>

<body>

<?php
   include '../php/nav.php';

?>
<?php  //打印足迹
history_display($history);
?>

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



      <div class="container">
            <h1 style="color:cornsilk">添加艺术品</h1>
            <form style="color:cornsilk;fong-size:18px;padding:30px" action="../php/add_artwork.php" method="POST" onsubmit="return login_valid()">
                <input id="artworkID" name="artworkID" value="" style="display:none"/>
                <div>
                    <label for="title">艺术品名称:</label>
                    <input type="text" name="title" id="title"   onblur="checkartwork()">
					<span class="default" id="errartwork"></span>
                </div>				
				<div>
                    <label for="artist">作者</label>
                    <input type="text" name="artist" id="artist"   onblur="checkartist()" >      
                    <span class="default" id="errartist"></span>
				</div>
				
				<div>
                    <label for="description">简介</label>
                    <input type="text" name="description" id="description"   onblur="checkdescription()">      
                    <span class="default" id="errdescription"></span> 
				</div>
				
				<div>
                    <label for="year">年份:</label>
                    <input type="text" name="year" id="year"  onblur="checkyear()" >
                    <span class="default" id="erryear"></span> 
                </div>
				<div>
                    <label for="genre">流派</label>
                    <input type="text" name="genre" id="genre"   onblur="checkgenre()">      
                    <span class="default" id="errgenre"></span> 
				</div>
				<div>
                   <label for="width">尺寸</label>  
                    <input type="text" name="width" id="width"  required >cm ×
  					<input type="text" name="height" id="height"  onblur="checksize()" >	cm
                    <span class="default" id="errsize"></span> 
				</div>
				<div>
                    <label for="price">价格</label>
                    <input type="text" name="price" id="price"   onblur="checkprice()" >
                    <span class="default" id="errprice"></span> 
				</div>
				<div>
                    <label for="artimg">艺术品图片</label>     
                    <span class="default" id="errartimg"></span> 
					
                    <input type="file" name="artimg" id="artimg"  onchange="handleFiles(this.files);">
                    <div id="preview"></div>
					
				</div>


                <input  class="submit" type="submit" value = "提交"></input>
            </form>
        </div>




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






<script>
    //图片上传预览

    var artworkID = window.location.search.substring(1).split("=")[1];

    if(artworkID){
        $("input[name=artworkID]").value=artworkID;
        console.log(artworkID);
        $.ajax({
            type:"GET",
            async:false,   //同步   默认是true（异步）
            url:"../php/fill_editform.php",
            data:{artworkID:artworkID},
            dataType:"json",
            success:function(data) {
                console.log(typeof(data));
                console.log("data: "+data);
                let title=data.title;
                let width = data.width;
                let description =data.description;
                let price = data.price;
                let yearOfWork = data.yearOfWork;
                let genre = data.genre;
                let artist = data.artist;
                let height = data.height;
                let imageFileName = data.imageFileName;

                $("#title").html(title);
                $("#price").html(price);
                $("#width").html(width);
                $("#description").html(description);
                $("#year").html(yearOfWork);
                $("#genre").html(genre);
                $("#artist").html(artist);
                $("#height").html(height);
                $("#preview").html('<img src="../resources/img/'+imageFileName+'">');

            }
        });
    }


</script>
<?php

    include '../php/conn.php';

    $artworkID = $_GET['artworkID'];
    //   echo "artworkID:".$artworkID;

    $sql_select = "SELECT * FROM artworks WHERE artworkID = $artworkID";

    $result = mysqli_query($conn,$sql_select);   //查找用户信息

?>






<script>
    handleFiles = function (files) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /^image\//;

            if (!imageType.test(file.type)) {
                continue;
            }
            var preview = document.getElementById("preview");
            var img = document.createElement("img");
            img.classList.add("obj");
            img.file = file;
            preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.

            var reader = new FileReader();
            reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
            reader.readAsDataURL(file);
        }
    };


    checkartwork = function () {

        var artwork = document.getElementById('artwork');
        var errartwork = document.getElementById('errartwork');


        if(artwork.value.length == 0 ){
            errartwork.innerHTML = "不得为空！";
            errartwork.className="error";
            return false;
        }

        else {
            errartwork.innerHTML = "✔";
            errartwork.className = "success";
            return true;
        }
    };

    checkartist = function () {

        var artist = document.getElementById('artist');
        var errartist = document.getElementById('errartist');

        if(artist.value.length == 0 ){
            errartist.innerHTML = "不得为空！";
            errartist.className="error";
            return false;
        }

        else {
            errartwork.innerHTML = "✔";
            errartwork.className = "success";
            return true;
        }
    };

    checkdescription = function () {

        var description = document.getElementById('description');
        var errdescription = document.getElementById('errdescription');

        if(description.value.length == 0 ){
            errdescription.innerHTML = "不得为空！";
            errdescription.className="error";
            return false;
        }
        else {
            errdescription.innerHTML = "✔";
            errdescription.className = "success";
            return true;
        }
    };

    checkyear = function () {

        var year = document.getElementById('year');
        var erryear = document.getElementById('erryear');

        var pattern = /^[1-9]\d*$/;
        if(year.value.length == 0 ){
            erryear.innerHTML = "不得为空！"
            erryear.className="error";
            return false;
        }
        else if(!pattern.test(year.value)){
            erryear.innerHTML = "年份必须为整数！";
            erryear.className = "error";
            return false;
        }
        else {
            erryear.innerHTML = "✔";
            erryear.className = "success";
            return true;
        }
    };

    checkgenre = function () {

        var genre = document.getElementById('genre');
        var errgenre = document.getElementById('errgenre');

        if(genre.value.length == 0 ){
            errgenre.innerHTML = "不得为空！";
            errgenre.className="error";
            return false;
        }
        else {
            errgenre.innerHTML = "✔";
            errgenre.className = "success";
            return true;
        }
    };

    checksize= function () {

        var width = document.getElementById('width');
        var height = document.getElementById('height');
        var errsize = document.getElementById('errsize');

        var pattern = /^[1-9]\d*$ /;
        if(width.value.length == 0 ||height.value.length == 0){
            errsize.innerHTML = "不得为空！";
            errsize.className="error";
            return false;
        }
        else if(!(pattern.test(width.value)&&pattern.test(height.value))){
            errsize.innerHTML = "请输入正整数！";
            errsize.className = "error";
            return false;
        }
        else {
            errsize.innerHTML = "✔";
            errsize.className = "success";
            return true;
        }
    };

    checkprice = function () {

        var price = document.getElementById('price');
        var errprice = document.getElementById('errprice');

        var pattern = /^[1-9]\d*$/;    //非零正整数
        if(price.value.length == 0 ){
            errprice.innerHTML = "不得为空！";
            errprice.className="error";
            return false;
        }
        else if(!pattern.test(price.value)){
            errprice.innerHTML = "请输入正整数！";
            errprice.className = "error";
            return false;
        }
        else {
            errprice.innerHTML = "✔";
            errprice.className = "success";
            return true;
        }
    }



</script>
</html>



<?php   ob_end_flush();?>