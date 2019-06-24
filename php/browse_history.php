<?php
/**
 * Created by IntelliJ IDEA.
 * User: HULEI
 * Date: 2019/6/23
 * Time: 14:05
 */
ob_start();
session_start();

if (!isset($_COOKIE['history']))
{   //如果没有设置cookie.history
    setcookie("history[0]", $current_history);
}
else{

    $len = count($_COOKIE['history']);
    $i = 0;
    for($i=0;$i<$len;$i++){
        if($_COOKIE['history'][$i]==$current_history) {  //如果有重复  则清除后面的足迹
            array_splice($_COOKIE['history'],$i+1);
            break;
        }
    }
    if($i==$len)  setcookie("history[$i]",$current_history);

    $history = $_COOKIE['history'];
    echo "history array: ";
 //   var_dump($history);

}

function history_display($array){       //足迹打印函数
    $display = '<div class = "browse_history" style="color:white" ><h4>Browsing History:</h4><ul >';
    foreach($array as $value){
        $display .= '<li style="display:inline-block"><a style="color:white" href ="'.$value.'.php">'.$value.' >>   </a></li>';
    }
    $display.='</ul></div>';

    echo $display;
}
