<?php
//连接数据库验证登录名与密码
header("Content-type:text/html; charset=utf-8");

$login        = @$_POST['submit']; //post的是name
$which_people = @$_POST['selection'];

$username = @$_POST['username'];
$password = @$_POST['password'];

//mysqli_query("set names utf-8");

if ($login == "GO") {
    if ($username != "" and $password != "") {
        include "conn.php"; //包含数据库连接文件
        if ($which_people == "administrator") {

            $select_administrator = "select * from {$db_name}.administrator where ano= '{$username}' ";
            $check_query  = mysqli_query($link, $select_administrator); //mysqli_query（数据库服务器连接对象，SQL语句）

            $result = mysqli_fetch_array($check_query);
            // $row = mysqli_fetch_array($result);

            if ($result['apassword'] == $password ) {
                
                if($result['alevel']==100){
                session_start();
                $_SESSION['administrator_ano'] = $username;
                echo "<meta http-equiv=refresh content='0; url=super_administrator.php'>";
                mysqli_free_result($check_query);
                mysqli_close($link);
            }else{
            	session_start();
                $_SESSION['administrator_ano'] = $username;
                echo "<meta http-equiv=refresh content='0; url=simple_administrator.php'>";
                mysqli_free_result($check_query);
                mysqli_close($link);
            }
			}
            else {
                echo "<script>
					alert('Incorrect password');
					window.location.href='index.html';
					</script>";
                mysqli_free_result($check_query);
                mysqli_close($link);

            }










        } //if($which_people == "administrator")
        else {

            $select_buyer = "select * from {$db_name}.buyer where bno= '{$username}' ";
            $check_query  = mysqli_query($link, $select_buyer); //mysqli_query（数据库服务器连接对象，SQL语句）

            $result = mysqli_fetch_array($check_query);
            //echo $result['bpassword'];
           //echo $password;

            if ($result['bpassword'] == $password) {
                //登录成功
                session_start();
                $_SESSION['buyer_bno'] = $username;
                echo "<meta http-equiv=refresh content='0; url=buyer.php'>";
                mysqli_free_result($check_query);
                mysqli_close($link);

            } else {
                echo "<script>
					alert('Incorrect password');
					window.location.href='index.html';
					</script>";
                mysqli_free_result($check_query);
                mysqli_close($link);

            }
        } //else_if($which_people == "administrator")
    } //if ($username!="" and $password!="")
    else {
        echo "<script>
			alert('工号/密码不能为空');
			window.location.href='index.html';
			</script>";
    } //else_if ($username!="" and $password!="")
} //if($login == "GO")
?>

