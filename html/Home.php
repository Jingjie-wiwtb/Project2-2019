<?php
$current_history = "Home";  //主页
include '../php/browse_history.php';
?>

<script>
    console.log(document.cookie);
</script>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>主页</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link href="../css/Home.css" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>



<body>

<?php include '../php/nav.php';  ?>

<?php  //打印足迹
   history_display($_COOKIE['history']);
?>

<div class="search-bar">
    <form>
        <input type="text" placeholder="请输入您要搜索的内容...">
        <a href="search.php"><i class="fa fa-search"></i>搜索</a>
    </form>
</div>


<div id="frame">
    <div id="photo-container">
        <ul id="photo">    <!--  图片介绍  -->

            <?php
            include '../php/conn.php';
            $sql_select = "SELECT * FROM artworks ORDER BY view LIMIT 4";
            $result = mysqli_query($conn,$sql_select);

            while($row = mysqli_fetch_array($result)){
                $artworkID = $row['artworkID'];
                $imageFileName = $row['imageFileName'];
                $title = $row['title'];
                $artist = $row['artist'];
                $description = $row['description'];
                $display = '<li><a class="result_link" data-artworkID="' . $artworkID . '"><img src="../resources/img/' . $imageFileName . '"></a>';
                $display .= '<div class="photo-intrd"><h3 class="art-name">' . $title . '</h3>';
                $display .= '<a >' . $artist . '</a>';
                $display .= '<p class="description" class="description" style="display:-webkit-box; -webkit-box-orient:vertical;-webkit-line-clamp: 5;overflow:hidden;">' . $description . '</p></div></li>';
                echo $display;
            }
            mysqli_free_result($result);
            ?>

        </ul>
    </div>
</div>
<div>
    <h3 style="color:cornsilk">最新发布</h3>
    <div class="container" style="color:white">
<?php
      $sql_select = "SELECT * FROM artworks ORDER BY timeReleased LIMIT 3";
      $result = mysqli_query($conn,$sql_select);

      while($row = mysqli_fetch_array($result)) {

          $artworkID = $row['artworkID'];
          $imageFileName = $row['imageFileName'];
          $title = $row['title'];
          $artist = $row['artist'];
          $description = $row['description'];

          $display = ' <div class="newCard">';
          $display .= '<a class="result_link" data-artworkID="'.$artworkID.'"><img style="height: 200px;border-radius: 100%; border: cornsilk solid" class=" img-responsive good_img" data-artworkID="'.$artworkID.'" src="../resources/img/' . $imageFileName . '"></a>';
          $display .= '<div class="result_dscpt">';
          $display .= '<h3 class="art-name">' . $title . '</h3>';
          $display .= '作者：' . $artist;
          $display .= '<p class="description" style=" display: -webkit-box; -webkit-box-orient:vertical;-webkit-line-clamp: 5;overflow:hidden;">'.$description.'</p></div></div>';
          echo $display;
      }
 ?>
    </div>
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

<script src="../javascript/jquery-3.4.1.js"></script>
<script src="../javascript/main.js" type="text/javascript" defer="defer"></script>

<script>

</script>

<?php
     include '../php/loginout_function.php';
?>

<script>console.log(document.cookie);</script>
<script>
    //商品链接点击事件
    $('.result_link').click(function() {
        var artworkID = $(this).data('artworkid');
        location.href="goods_details.php?artworkID="+artworkID;

    });
</script>

</html>


<?php   ob_end_flush();?>
