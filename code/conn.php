<?php
//数据库连接代码
$db_host="localhost";
$db_user="root";
$db_pass="zlq19971211";
$db_name="storesystem";
$link=mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("不能连接数据库".mysqli_error());
mysqli_query($link,"SET CHARACTER_SET_RESULTS=UTF8'");
?>