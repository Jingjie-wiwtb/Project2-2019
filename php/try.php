


<?php
/*
$image = $_FILES['image'];

$filename = $image['name'];

if(!empty($_POST['filename'])) {
    
    file_put_contents('result',$_POST['filename']);
    return header('Location:2.php');
    
}else{
    
    if(move_uploaded_file($image['tmp_name'],"images/".$image['name'])){
        //echo "<script>parent.preview('$filename')</script>";
        //status 1 表示成功。并传入filename
        echo $filename;
    }
}
*/
	?>

<?php
include '../php/conn.php';
$sql_select = "SELECT * FROM artworks ORDER BY view LIMIT 3";
$result = mysqli_query($conn,$sql_select);


while($row = mysqli_fetch_array($result)){
    $artworkID = $row['artworkID'];
    $imageFileName = $row['imageFileName'];
    $title = $row['title'];
    $artist = $row['artist'];
    $description = $row['description'];
    $display = '<li><a href="goods_details.php" class="result_link" data-artworkID="' . $artworkID . '"><img  src="../resources/img/' . $imageFileName . '"></a>';
    $display .= '<div class="photo-intrd"><h3 class="art-name">' . $title . '</h3>';
    $display .= '<a href="search.php" class="author">' . $artist . '</a>';
    $display .= '<p class="discription">' . $description . '</p></div></li>';
    echo $display;
}
?>