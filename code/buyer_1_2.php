<?php
header("Content-type:text/html; charset=UTF-8");
include "conn.php";
session_start();
$bno = @$_SESSION['buyer_bno'];
?>


<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>BUYER</title>

    <link rel="stylesheet" type="text/css" href="./buyer_css/nav.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/myself.css">

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
    if ($new_name != "" and $new_password != "") {
        mysqli_query($link, "update  {$db_name}.buyer set bname='{$new_name}' , bpassword='{$new_password}' , bremark='{$new_remark}' where bno='{$bno}'") or die("存入数据库失败" . mysqli_error());
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
            <div id="mini" style="border-bottom:1px solid rgba(255,255,255,.1)"><img src="./buyer/mini.png"></div>
        </div>
        <ul>
            <li class="nav-item">
                <a href="javascript:;"><i class="my-icon nav-icon icon_1"></i><span>采购员信息</span><i class="my-icon nav-more"></i></a>
                <ul style="display: none;">
                    <li><a href="buyer_1_1.php" ><span>自己信息</span></a></li>
                    <li><a href="buyer_1_2.php"><span>信息修改</span></a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;"><i class="my-icon nav-icon icon_2"></i><span>物品信息</span><i class="my-icon nav-more"></i></a>
                <ul style="display: none;">
                    <li><a href="buyer_2_1.php"><span>全体物品信息</span></a></li>
                    <li><a href="buyer_2_2.php"><span>物品不足信息</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
    <form name="form_1_2" method="post" action="#">
    <div class="text_right">
        工号:<?php echo $bno; ?><br>
        姓名:<input type="text" name="name" /><br>
        密码:<input type="text" name="password"/><br>
        备注:<input type="text" name="remark"><br>
        <input type="submit" name="submit" value="提交">
    </div>
</form>


</body></html>