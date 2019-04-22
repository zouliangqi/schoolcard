<?php
    header("Content-type:text/html; charset=UTF-8");
    include "conn.php";
    session_start();
    $ano = @$_SESSION['administrator_ano'];
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>ADMINISTRATOR</title>
    
    <link rel="stylesheet" type="text/css" href="./buyer_css/nav.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/myself.css"><link rel="stylesheet" type="text/css" href="./buyer_css/myself.css">
    <script src="./buyer_css/hm.js"></script><script type="text/javascript" src="./buyer_css/jquery.min.js"></script>
    <script type="text/javascript" src="./buyer_css/nav.js"></script>
    
</head>
<body style="">

    <div class="table_right">
        <?php 
        $select_storehouse = "select * from {$db_name}.storehouse where ano= '{$ano}' ";
        $check_query = mysqli_query($link,$select_storehouse) or die(mysqli_error($link));
        $row = mysqli_fetch_assoc($check_query);//$row['sno'];
        $select_goods = "select * from {$db_name}.goods where sno= '{$row['sno']}' ";
        $check_query_goods = mysqli_query($link,$select_goods);
        echo"<table border= 1>";
        echo"<tr><td>订单编号</td><td>物品名</td><td>类型编号</td><td>物品编号</td><td>采购员号</td><td>日期</td><td>采购数量</td><td>金额</td></tr>";
        while($row_goods=mysqli_fetch_array($check_query_goods)){
            if($row_goods['gremark'] == "已记录"){

                $select_orders = "select * from {$db_name}.orders where gno= '{$row_goods['gno']}' ";
                $check_query_orders = mysqli_query($link,$select_orders);
                $row_orders = mysqli_fetch_assoc($check_query_orders);
                echo"<tr>";
                echo"<td>".$row_orders['ono']."</td>";
                echo"<td>".$row_goods['gname']."</td>";
                echo"<td>".$row_orders['cno']."</td>";
                echo"<td>".$row_orders['gno']."</td>";
                echo"<td>".$row_orders['bno']."</td>";
                echo"<td>".$row_orders['odate']."</td>";
                echo"<td>".$row_orders['onumber']."</td>";
                echo"<td>".$row_orders['omoney']."</td>";
        }
        }
        echo"</table>";
        ?>
    </div>
    <div class="nav">
        <div class="nav-top">
            <div id="mini" style="border-bottom:1px solid rgba(255,255,255,.1)"><img src="./buyer_css/mini.png"></div>
        </div>
        <ul>
            <li class="nav-item">
                <a href="javascript:;"><i class="my-icon nav-icon icon_1"></i><span>信息</span><i class="my-icon nav-more"></i></a>
                <ul style="display: none;">
                    <li><a href="simple_administrator_1_1.php"><span>个人信息</span></a></li>
                    <li><a href="simple_administrator_1_2.php"><span>修改信息</span></a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;"><i class="my-icon nav-icon icon_2"></i><span>消费</span><i class="my-icon nav-more"></i></a>
                <ul style="display: none;">
                    <li><a href="simple_administrator_2_1.php"><span>支付</span></a></li>
                    <li><a href="simple_administrator_2_2.php"><span>充值</span></a></li>
                </ul>
            </li>
            <li class="nav-item nav-show">
                <a href="javascript:;"><i class="my-icon nav-icon icon_3"></i><span>查询</span><i class="my-icon nav-more"></i></a>
                <ul style="display: block;">
                    <li><a href="simple_administrator_3_1.php"><span>查余额</span></a></li>
                    <li><a href="simple_administrator_3_2.php"><span>查账单</span></a></li>  
                </ul>
            </li>
        </ul>
    </div>


<?php
$tijiao = @$_POST['submit'];
if($tijiao=="同意进货"){
    $ono = @$_POST['ono_down'];
    $queryono = "select * from {$db_name}.orders where ono = '{$ono}'";
    $check_query_ono = $link ->query($queryono);
    $row_ono=mysqli_fetch_array($check_query_ono);
    //$row_ono['onumber'];$row_ono['gno'];

    $query_goods_gno = "select * from {$db_name}.goods where gno = '{$row_ono['gno']}'";
    $check_query_gno = $link ->query($query_goods_gno);
    $row_query_gno=mysqli_fetch_array($check_query_gno);
    $zongshu = $row_ono['onumber'] + $row_query_gno['gnowstock'];
    $null = "";
    mysqli_query($link, "update  {$db_name}.goods set gnowstock='{$zongshu}',gremark = '{$null}' where gno='{$row_ono['gno']}'") or die("存入数据库失败" . mysqli_error());
    mysqli_query($link, "delete from orders where ono = '{$ono}'") or die("删除失败" . mysqli_error());
    header('location: '.$_SERVER['HTTP_REFERER']);

    }
?>   


    <form method="post" action="#">
    <div id="simple_3_2">
        订单号:<input type="text" name="ono_down" size="16" /><br>
        <input type="submit" name="submit" value="同意进货" />
    </div>
   </form>


</body>
</html>