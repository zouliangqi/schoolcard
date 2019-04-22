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
    <link rel="stylesheet" type="text/css" href="./buyer_css/myself.css"><link rel="stylesheet" type="text/css" href="./buyer_css/myself.css">

    <script src="./buyer_css/hm.js"></script><script type="text/javascript" src="./buyer_css/jquery.min.js"></script>
    <script type="text/javascript" src="./buyer_css/nav.js"></script>

</head>
<body style="">

    <div class="table_right">
        <?php
$select_bno  = "select * from {$db_name}.goods";
$check_query = mysqli_query($link, $select_bno) or die(mysqli_error($link));
// $row = mysqli_fetch_assoc($check_query);
echo "<p>";
echo "<table border=1>";
echo "<tr><td>商品编号</td><td>名称</td><td>库存上限</td><td>当前库存</td></tr>";
while ($row = mysqli_fetch_array($check_query)) {
    if ($row['gnowstock'] < $row['gstocklimit'] * 0.1 and $row['gremark'] !='已记录') {
        echo "<tr>";
        echo "<td>" . $row['gno'] . "</td>";
        echo "<td>" . $row['gname'] . "</td>";
        echo "<td>" . $row['gstocklimit'] . "</td>";
        echo "<td>" . $row['gnowstock'] . "</td>";
        echo "</tr>";
    }
}
echo "</table>";
?>
    </div>


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

<?php
$tijiao = @$_POST['submit'];
if($tijiao=="提交"){
    $gno = @$_POST['gno_down'];
    $querygno = "select * from {$db_name}.goods where gno = '{$gno}'";
    $check_query = $link ->query($querygno);


    $query_gno = "select * from {$db_name}.orders where gno = '{$gno}'";
    $check_query_gno = $link ->query($query_gno);


    if(mysqli_num_rows($check_query_gno)!=0){
   
    echo"<script> alert('订单已经创建');</script>";
    }
    else{ 

    $ono = @$_POST['ono_down'];
    $onumber = @$_POST['onumber_down'];
    $odate = date("Y-m-d");
    $row=mysqli_fetch_array($check_query);
    mysqli_query($link,"UPDATE goods SET gremark = '已记录' WHERE gno = $gno");

    $cno = $row['cno'];
    $omoney = $onumber*$row['gprice'];
    $insert = "insert into {$db_name}.orders(ono,cno,gno,bno,odate,onumber,omoney) values('$ono','$cno','$gno','$bno','$odate','$onumber','$omoney')";
    mysqli_query($link,$insert);
    }
    header('location: '.$_SERVER['HTTP_REFERER']);

}
?>

    <form method="post" action="#">
    <div id="buyer_2_2_button">
        创建订单编号:<input type="text" name="ono_down" size="16" /><br>
        输入要进货的货物编号：<input type="text" name="gno_down" size="16" /><br>
        数量:<br>
        <input type="text" name="onumber_down" size="16" /><br>
        <input type="submit" name="submit" value="提交" >

    </div>
</form>


</body></html>