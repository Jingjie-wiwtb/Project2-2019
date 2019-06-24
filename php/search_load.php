<?php

$keyword = $_GET['keyword'];    //神tm只能用单引号。。

$search_key = $_GET['search_key'];
$search_key = rtrim($search_key, ",");    //去掉字符串末端的任意字符

//echo "search_key:".$search_key;
//echo "keyword:".$keyword;

include 'conn.php';

if(!$keyword)
    echo '0';
else {
    $sql_select = "SELECT * FROM artworks WHERE CONCAT($search_key) LIKE '%$keyword%' AND orderID IS NOT NULL";//= '$keyword'";//

    /*

    else {
        $sql_select = "SELECT * FROM artworks";
    }
    */
//echo $sql_select;
    $result = mysqli_query($conn, $sql_select);

    $row = mysqli_fetch_array($result);

    //  var_dump($result);

    // echo mysqli_error($conn);

    if ($result)
        $totalCount = $result->num_rows;
    else
        $totalCount = 0;


    $pageSize = 5;    //每个分页上的条目数

    //   echo "totalCount: " . $totalCount . " ";

    $totalPage = ($totalCount / $pageSize >= 0) ? (int)($totalCount / $pageSize) : 1;   //总页数

    $_SESSION['lastPage'] = $totalPage;
    echo $totalPage;
}


