<?php
$current_history = "add_work";  //添加商品
include '../php/browse_history.php';





$info_change = array()





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
    <script src="../javascript/jquery-3.4.1.js"></script>
    <style>
        #add_work label {
            color: cornsilk;
        }
    </style>
</head>

<body>

<?php
   include '../php/nav.php';

?>
<?php  //打印足迹
history_display($history);
?>


      <div class="container">
            <h1 style="color:cornsilk">添加艺术品</h1>
            <form id="add_work" style="fong-size:18px;padding:30px" action="../php/add_artwork.php" method="POST"  enctype="multipart/form-data" onsubmit="return login_valid()">
                <input id="artworkID" name="artworkID" value="" style="display:none"/>
                <div>
                    <label for="title">艺术品名称:</label>
                    <input type="text" name="title" id="artwork"   onblur="checkartwork()">
					<span class="default" id="errartwork"></span>
                </div>				
				<div>
                    <label for="artist">作者</label>
                    <input type="text" name="artist" id="artist"   onblur="checkartist()" >      
                    <span class="default" id="errartist"></span>
				</div>
				
				<div>
                    <label for="description">简介</label>
                    <textarea  rows="10" cols="50" type="text" name="description" id="description"   onblur="checkdescription()"></textarea>
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


                    <input type="file" name="artimg" onchange="PreviewImage(this,'imgHeadPhoto','divPreview');" size="20" />

                    <div id="divPreview">
                        <img id="imgHeadPhoto" src="" style="width: 500px; height: 500px; border: solid 1px #d2e2e2;"
                             alt="" />
                    </div>
					
				</div>
                <input  class="submit btn" type="submit" value = "提交"></input>

                <button type="button" class="btn btn-info cancel">取消</button></div>

</form>
        </div>






<script type="text/javascript">



    $(".cancel").click(function(){

        if(confirm('确认放弃吗？'))
             history.go(-1);

    });




    //图片预览


    //js本地图片预览，兼容ie[6-9]、火狐、Chrome17+、Opera11+、Maxthon3
    function PreviewImage(fileObj, imgPreviewId, divPreviewId) {
        var allowExtention = ".jpg,.bmp,.gif,.png"; //允许上传文件的后缀名document.getElementById("hfAllowPicSuffix").value;
        var extention = fileObj.value.substring(fileObj.value.lastIndexOf(".") + 1).toLowerCase();
        var browserVersion = window.navigator.userAgent.toUpperCase();
        if (allowExtention.indexOf(extention) > -1) {
            if (fileObj.files) {//HTML5实现预览，兼容chrome、火狐7+等
                if (window.FileReader) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById(imgPreviewId).setAttribute("src", e.target.result);
                    }
                    reader.readAsDataURL(fileObj.files[0]);
                } else if (browserVersion.indexOf("SAFARI") > -1) {
                    alert("不支持Safari6.0以下浏览器的图片预览!");
                }
            } else if (browserVersion.indexOf("MSIE") > -1) {
                if (browserVersion.indexOf("MSIE 6") > -1) {//ie6
                    document.getElementById(imgPreviewId).setAttribute("src", fileObj.value);
                } else {//ie[7-9]
                    fileObj.select();
                    if (browserVersion.indexOf("MSIE 9") > -1)
                        fileObj.blur(); //不加上document.selection.createRange().text在ie9会拒绝访问
                    var newPreview = document.getElementById(divPreviewId + "New");
                    if (newPreview == null) {
                        newPreview = document.createElement("div");
                        newPreview.setAttribute("id", divPreviewId + "New");
                        newPreview.style.width = document.getElementById(imgPreviewId).width + "px";
                        newPreview.style.height = document.getElementById(imgPreviewId).height + "px";
                        newPreview.style.border = "solid 1px #d2e2e2";
                    }
                    newPreview.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";
                    var tempDivPreview = document.getElementById(divPreviewId);
                    tempDivPreview.parentNode.insertBefore(newPreview, tempDivPreview);
                    tempDivPreview.style.display = "none";
                }
            } else if (browserVersion.indexOf("FIREFOX") > -1) {//firefox
                var firefoxVersion = parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
                if (firefoxVersion < 7) {//firefox7以下版本
                    document.getElementById(imgPreviewId).setAttribute("src", fileObj.files[0].getAsDataURL());
                } else {//firefox7.0+
                    document.getElementById(imgPreviewId).setAttribute("src", window.URL.createObjectURL(fileObj.files[0]));
                }
            } else {
                document.getElementById(imgPreviewId).setAttribute("src", fileObj.value);
            }
        } else {
            alert("仅支持" + allowExtention + "为后缀名的文件!");
            fileObj.value = ""; //清空选中文件
            if (browserVersion.indexOf("MSIE") > -1) {
                fileObj.select();
                document.selection.clear();
            }
            fileObj.outerHTML = fileObj.outerHTML;
        }
        return fileObj.value;    //返回路径
    }
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




<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>   -->
<script src="../javascript/main.js" type="text/javascript" defer="defer"></script>
<script src="../javascript/search.js" type="text/javascript" defer="defer"></script>



//图片上传控制
<script type="text/javascript">
    //js本地图片预览，兼容ie[6-9]、火狐、Chrome17+、Opera11+、Maxthon3
    function PreviewImage(fileObj, imgPreviewId, divPreviewId) {
        var allowExtention = ".jpg,.bmp,.gif,.png"; //允许上传文件的后缀名document.getElementById("hfAllowPicSuffix").value;
        var extention = fileObj.value.substring(fileObj.value.lastIndexOf(".") + 1).toLowerCase();
        var browserVersion = window.navigator.userAgent.toUpperCase();
        if (allowExtention.indexOf(extention) > -1) {
            if (fileObj.files) {//HTML5实现预览，兼容chrome、火狐7+等
                if (window.FileReader) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById(imgPreviewId).setAttribute("src", e.target.result);
                    }
                    reader.readAsDataURL(fileObj.files[0]);
                } else if (browserVersion.indexOf("SAFARI") > -1) {
                    alert("不支持Safari6.0以下浏览器的图片预览!");
                }
            } else if (browserVersion.indexOf("MSIE") > -1) {
                if (browserVersion.indexOf("MSIE 6") > -1) {//ie6
                    document.getElementById(imgPreviewId).setAttribute("src", fileObj.value);
                } else {//ie[7-9]
                    fileObj.select();
                    if (browserVersion.indexOf("MSIE 9") > -1)
                        fileObj.blur(); //不加上document.selection.createRange().text在ie9会拒绝访问
                    var newPreview = document.getElementById(divPreviewId + "New");
                    if (newPreview == null) {
                        newPreview = document.createElement("div");
                        newPreview.setAttribute("id", divPreviewId + "New");
                        newPreview.style.width = document.getElementById(imgPreviewId).width + "px";
                        newPreview.style.height = document.getElementById(imgPreviewId).height + "px";
                        newPreview.style.border = "solid 1px #d2e2e2";
                    }
                    newPreview.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";
                    var tempDivPreview = document.getElementById(divPreviewId);
                    tempDivPreview.parentNode.insertBefore(newPreview, tempDivPreview);
                    tempDivPreview.style.display = "none";
                }
            } else if (browserVersion.indexOf("FIREFOX") > -1) {//firefox
                var firefoxVersion = parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
                if (firefoxVersion < 7) {//firefox7以下版本
                    document.getElementById(imgPreviewId).setAttribute("src", fileObj.files[0].getAsDataURL());
                } else {//firefox7.0+
                    document.getElementById(imgPreviewId).setAttribute("src", window.URL.createObjectURL(fileObj.files[0]));
                }
            } else {
                document.getElementById(imgPreviewId).setAttribute("src", fileObj.value);
            }
        } else {
            alert("仅支持" + allowExtention + "为后缀名的文件!");
            fileObj.value = ""; //清空选中文件
            if (browserVersion.indexOf("MSIE") > -1) {
                fileObj.select();
                document.selection.clear();
            }
            fileObj.outerHTML = fileObj.outerHTML;
        }
        return fileObj.value;    //返回路径
    }
</script>


<script>
    //图片上传预览

    var artworkID = window.location.search.substring(1).split("=")[1];

    console.log(artworkID);

    if(artworkID){

        $("#artworkID").val(artworkID);
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

                $("#artwork").val(title);
                $("#price").val(price);
                $("#width").val(width);
                $("#description").val(description);
                $("#year").val(yearOfWork);
                $("#genre").val(genre);
                $("#artist").val(artist);
                $("#height").val(height);
                $("#imgHeadPhoto").attr("src","../resources/img/"+imageFileName);

            }
        });
    }


</script>
<?php

    include '../php/conn.php';
if(!isset($_SESSION['username']))
    echo "<script>alert('请先登陆！');history.go(-1);</script>";



// $artworkID = $_GET['artworkID'];
    //   echo "artworkID:".$artworkID;

   // $sql_select = "SELECT * FROM artworks WHERE artworkID = $artworkID";

    //$result = mysqli_query($conn,$sql_select);   //查找用户信息

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
            errartist.innerHTML = "✔";
            errartist.className = "success";
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

        var pattern = /^[1-9]\d*$/;
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


<?php
include '../php/loginout_function.php';
ob_end_flush();
?>
</html>

