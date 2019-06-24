<?php
$keyword = "Pablo Picasso";   //\$_GET["keyword"];
$order_key = "price";  // $_GET["order_key"];
$search_keys = "artist";  //$_GET["search_keys"];
include 'conn.php';

// $keyword = isset($_GET['keyword']) ? $_GET['keyword']:"";

//如果设置了关键词
if($keyword){


    $sql_select = "SELECT * FROM artworks WHERE CONCAT($search_keys)  LIKE '%$keyword%'";//= '$keyword'";//
    /*
        $key_split = explode(' ',$keyword); //分解用户输入的多个关键词，存入数组
        for($i=0;$i<count($key_split);$i++) {
           if($i==0)
               $sql_select ="SELECT * FROM artworks WHERE CONCAT(artist,title,description,genre,yearOfWork) LIKE '%$key_split[$i]%'";
           else
               $sql_select.="UNION SELECT * FROM artworks WHERE CONCAT(artist,title,description,genre,yearOfWork) LIKE '%$key_split[i]%' ";   //UNION运算符可得出多条查询语句的交集
        }
           */

    if(isset($order_key))
        $sql_select .= " ORDER BY "." ".$order_key;   //",".$artworkID;   //搜索结果排序

}
//如果没设置关键词，列出所有结果

else {
    $sql_select = "SELECT * FROM artworks";
}

echo $sql_select;

$result = mysqli_query($conn,$sql_select);

$j = 0;

//$row = mysqli_fetch_all($result);
//	var_dump($row);

$response_array = array();

while ($row= mysqli_fetch_array($result)) {
    echo $j.":  ";
    echo $row['artworkID'] . " " . $row['price'].",";

    $response_array[$j] = array('artworkID'=>$row['artworkID'],'imageFileName'=>$row['imageFileName'],'title'=>$row['title'],'artist'=>$row['artist'],'description'=>$row['description'],'price'=>$row['price']);

    $j++;
    //search_display($row['artworkID'],$row['imageFileName'],$row['title'],$row['artist'],$row['description'],$row['price']);
}

echo json_encode($response_array);
