
<?php

    include '../php/conn.php';

    $artworkID = $_GET['artworkID'];
 //   echo "artworkID:".$artworkID;

    $sql_select = "SELECT * FROM artworks WHERE artworkID = $artworkID";

    $result = mysqli_query($conn,$sql_select);   //查找用户信息

    if($row = mysqli_fetch_array($result)) {    //


        //更新访问量
        $nview = $row['view']+1;
        $sql_update = "UPDATE artworks SET view = $nview WHERE artworkID = $artworkID";
        $update = mysqli_query($conn,$sql_update);

        //var_dump($row['imageFileName']);

        $details = array('artworkID' => $row['artworkID'], 'imageFileName' => $row['imageFileName'], 'title' => $row['title'], 'artist' => $row['artist'], 'description' => $row['description'], 'price' => $row['price'], 'view' => $row['view'], 'genre' => $row['genre'], 'yearOfWork' => $row['yearOfWork'],'orderID'=>$row['orderID']);
//echo $row['orderID'];
      //  var_dump($details);
        echo json_encode($details,JSON_UNESCAPED_UNICODE);

    }
	
	
    else echo "error!";
	
	   //detail_display($row['title'],$row['artworkID'],$row['description'],$row['price'],$row['yearOfWork'],$row['genre'],$row['artist'],$row['view']);
