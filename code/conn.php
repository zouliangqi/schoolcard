<?php
//���ݿ����Ӵ���
$db_host="localhost";
$db_user="root";
$db_pass="zlq19971211";
$db_name="storesystem";
$link=mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("�����������ݿ�".mysqli_error());
mysqli_query($link,"SET CHARACTER_SET_RESULTS=UTF8'");
?>