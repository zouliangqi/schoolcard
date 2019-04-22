<?php
    header("Content-type:text/html; charset=UTF-8");
    include "conn.php";
    session_start();
    $ano = @$_SESSION['administrator_ano'];
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>SUPER ADMINISTRATOR</title>
    
    <link rel="stylesheet" type="text/css" href="./buyer_css/nav.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/myself.css"><link rel="stylesheet" type="text/css" href="./buyer_css/myself.css">
    <script src="./buyer_css/hm.js"></script><script type="text/javascript" src="./buyer_css/jquery.min.js"></script>
    <script type="text/javascript" src="./buyer_css/nav.js"></script>
    
</head>
<body style="">

   <?php
$tijiao = @$_POST['submit'];
if ($tijiao == "提交") {
    $new_name     = @$_POST['name'];
    $new_password = @$_POST['password'];
    $new_remark   = @$_POST['remark'];
    $new_status = @$_POST['status'];
    if ($new_name != "" and $new_password != "" and $new_status!="") {
        mysqli_query($link, "update  {$db_name}.administrator set aname='{$new_name}' , apassword='{$new_password}' , aremark='{$new_remark}',astatus='{$new_status}' where ano='{$ano}'") or die("存入数据库失败" . mysqli_error());
    } else {
        echo "<script>
            alert('不能为空');
            </script>";
    }
}
mysqli_close($link);
?>


    <div class="nav">
        <div class="nav-top">
            <div id="mini" style="border-bottom:1px solid rgba(255,255,255,.1)"><img src="./buyer_css/mini.png"></div>
        </div>
        <ul>
            <li class="nav-item">
                <a href="javascript:;"><i class="my-icon nav-icon icon_1"></i><span>信息</span><i class="my-icon nav-more"></i></a>
                <ul style="display: none;">
                    <li><a href="super_administrator_1_1.php"><span>个人信息</span></a></li>
                    <li><a href="super_administrator_1_2.php"><span>修改信息</span></a></li>
                </ul>
            </li>
            <li class="nav-item" nav-show>
                <a href="javascript:;"><i class="my-icon nav-icon icon_2"></i><span>消费</span><i class="my-icon nav-more"></i></a>
                <ul style="display: none;">
                    <li><a href="super_administrator_2_1.php"><span>支付</span></a></li>
                    <li><a href="super_administrator_2_2.php"><span>充值</span></a></li>
              
                </ul>
            </li>
            <li class="nav-item nav-show">
                <a href="javascript:;"><i class="my-icon nav-icon icon_3"></i><span>查询</span><i class="my-icon nav-more"></i></a>
                <ul style="display: block;">
                    <li><a href="super_administrator_3_1.php"><span>查余额</span></a></li>
                    <li><a href="super_administrator_3_2.php"><span>查账单</span></a></li>  
                </ul>
            </li>
        </ul>
    </div>
    <form name="form_1_2" method="post" action="#">
    <div class="text_right">
        学号:<?php echo $ano; ?><br>
        姓名:<input type="text" name="name" /><br>
        密码:<input type="text" name="password"/><br>
        性别:<input type="text" name="status" /><br>
        专业:<input type="text" name="remark"><br>
        <input type="submit" name="submit" value="提交">
    </div>
</form>


</body>
</html>