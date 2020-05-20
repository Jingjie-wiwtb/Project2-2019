

<?php

$keyword = $_GET['keyword'];    //神tm只能用单引号。。
$order_key = $_GET['order_key'];

if(!isset($_GET['search_key'])){  //如果没设置搜索字段

    $search_key = "artist,description,title";
}
else{

    $search_key = $_GET['search_key'];
    $search_key = rtrim($search_key, ",");    //去掉字符串末端的任意字符
 //   echo "search_key:".$search_key;
}
//echo $keyword." ".$order_key." ".$search_key;
    include 'conn.php';
	
   // $keyword = isset($_GET['keyword']) ? $_GET['keyword']:"";

    //如果设置了关键词

if(!$keyword){//如果没设关键词
    echo '1';
}
else {

    $sql_select = "SELECT * FROM artworks WHERE CONCAT($search_key)  LIKE '%$keyword%' AND orderID IS NULL";//= '$keyword'";//
  // echo "search_select".$sql_select;

    /*
        $key_split = explode(' ',$keyword); //分解用户输入的多个关键词，存入数组
        for($i=0;$i<count($key_split);$i++) {
           if($i==0)
               $sql_select ="SELECT * FROM artworks WHERE CONCAT(artist,title,description,genre,yearOfWork) LIKE '%$key_split[$i]%'";
           else
               $sql_select.="UNION SELECT * FROM artworks WHERE CONCAT(artist,title,description,genre,yearOfWork) LIKE '%$key_split[i]%' ";   //UNION运算符可得出多条查询语句的交集
        }
           */

    if (isset($order_key))
        $sql_select .= " ORDER BY " . " " . $order_key;   //",".$artworkID;   //搜索结果排序


//如果没设置关键词，列出所有结果
    /*
    else {
        $sql_select = "SELECT * FROM artworks";
        }
    */
//echo $sql_select;

    $result = mysqli_query($conn, $sql_select);
    //  echo "error:".mysqli_error($conn);

//统计总条数

    if (!$totalCount = $result->num_rows)
   // if(!$result)
        echo '0';           //无搜索结果
    //       echo "totalcount: ".$totalCount."  ";

    else //有搜索结果
    {
        $totalCount = $result->num_rows;

    //    echo "totalCount:".$totalCount;

        $pageSize = 5;    //每个分页上的条目数
        $totalPage = ((int)($totalCount % $pageSize == 0)) ? ($totalCount / $pageSize) : 1;   //总页数

        if (!isset($_GET['page']))       //通过输入页数跳转
            $currentPage = 1;
        else $currentPage = $_GET['page'];

        $mark = ($currentPage - 1) * $pageSize;     //标记当前页起始位置
        //	echo "mark:".$mark;
        $firstPage = 1;
        $prePage = ($currentPage - 1) ? $currentPage - 1 : 1;
        $nextPage = ($totalPage - $currentPage > 0) ? ($totalPage - $currentPage > 0) : $totalPage;

        $sql_select .= " LIMIT " . $mark . "," . $pageSize;   //第一个参数：开始位置；第二个：长度
        //	echo "sql_select2".$sql_select;
        //   echo $result->num_rows;
        $result = mysqli_query($conn, $sql_select);

        $j = 0;

        //$row = mysqli_fetch_all($result);
        //	var_dump($row);

        $response_array = array();

        while ($row = mysqli_fetch_array($result)) {

            $response_array[$j] = (object)array('artworkID' => $row['artworkID'], 'imageFileName' => $row['imageFileName'], 'title' => $row['title'], 'artist' => $row['artist'], 'description' => $row['description'], 'price' => $row['price'],'view'=>$row['view']);

            $j++;
            //search_display($row['artworkID'],$row['imageFileName'],$row['title'],$row['artist'],$row['description'],$row['price']);
        }

        echo json_encode((object)$response_array);
    }
}



   
