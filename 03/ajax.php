<?php
/*
Структура таблицы
CREATE TABLE `visit` (
`id` int(64) NOT NULL AUTO_INCREMENT,
`ip` text,
`all_data` text,
`y_city` text,
`y_region` text,
`y_country` text,
`Date` date,
`Time` time,
PRIMARY KEY (id));
*/
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

function CheckStr($str){
    return str_replace("'",'&prime;',$str);
}    
    
    $mysqli = new mysqli('localhost', 'demo', 'demo', 'demo');
    $date = date("Y-m-d", time());
    $time = date("H:i:s", time());

    $query = "INSERT INTO `visit`(`id`, `ip`, `all_data`, `y_city`, `y_region`, `y_country`, `Date`, `Time`) ".
    "VALUES (NULL, '".CheckStr($_POST['ip'])."', '".CheckStr($_POST['all_data'])."', '".
    CheckStr($_POST['y_city'])."', '".CheckStr($_POST['y_region'])."', '".CheckStr($_POST['y_country'])."', '".
    $date."', '".$time."');";
    $result = $mysqli->query($query);
    
    $query = "SELECT COUNT(*) as `count` FROM `visit`";
    $result = $mysqli->query($query);
    $row = $result->fetch_array();
    echo $row['count'];
    
    //echo print_r($_POST, true);
?>