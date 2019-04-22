<?php
    header("Content-type:text/html; charset=UTF-8");
    include "conn.php";
    // session_start();
    // $ano = @$_SESSION['administrator_ano'];
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
    $ano     = @$_POST['ano'];
    $new_level =@$_POST['level'];

    if ($ano != "" and $new_level != "") {
        $select_ano="select * from administrator where ano='{$ano}'";
        $result=mysqli_query($link,$select_ano) or die (mysqli_error());
        if(mysqli_num_rows($result)!=0){
        mysqli_query($link, "update  {$db_name}.administrator set alevel='{$new_level}' where ano='{$ano}'") or die("存入数据库失败" . mysqli_error());
    }
    else{
        echo "<script>
            alert('不存在');
            </script>";
    }
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
        学号:<br>
        <input type="text" name="ano" /><br>
        金额:<br>
        <input type="text" name="level"><br>
        <input type="submit" name="submit" value="提交">
    </div>
</form>


</body>
</html>