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
        $row = mysqli_fetch_assoc($check_query);
        echo"<table border=1>";
        echo "我管理的仓库信息";
        echo"<tr><td>仓库编号</td><td>管理员号</td><td>仓库名</td><td>备注</td></tr>";
        echo"<tr>";
        echo"<td>".$row['sno']."</td>";
        echo"<td>".$row['ano']."</td>";
        echo"<td>".$row['sname']."</td>";
        echo"<td>".$row['sremark']."</td>";
        echo"</tr>";
        echo"</table>";
        echo "<p>";
        echo"仓库中的物品";
        $select_goods = "select * from {$db_name}.goods where sno= '{$row['sno']}' ";
        $check_query_goods = mysqli_query($link,$select_goods) or die(mysqli_error($link));
        echo"<table border=1>";
        echo"<tr><td>物品编号</td><td>仓库编号</td><td>类型编号</td><td>物品名称</td><td>库存上限</td><td>当前库存</td><td>价格</td></tr>";
        while($row_goods=mysqli_fetch_array($check_query_goods)){
            echo"<tr>";
            echo"<td>".$row_goods['gno']."</td>";
            echo"<td>".$row_goods['sno']."</td>";
            echo"<td>".$row_goods['cno']."</td>";
            echo"<td>".$row_goods['gname']."</td>";
            echo"<td>".$row_goods['gstocklimit']."</td>";
            echo"<td>".$row_goods['gnowstock']."</td>";
            echo"<td>".$row_goods['gprice']."</td>";
            echo"</tr>";

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
                <a href="javascript:;"><i class="my-icon nav-icon icon_1"></i><span>管理员信息</span><i class="my-icon nav-more"></i></a>
                <ul style="display: none;">
                    <li><a href="simple_administrator_1_1.php"><span>自己的信息</span></a></li>
                    <li><a href="simple_administrator_1_2.php"><span>信息修改</span></a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;"><i class="my-icon nav-icon icon_2"></i><span>管理员管理</span><i class="my-icon nav-more"></i></a>
                <ul style="display: none;">
                    <li><a href="simple_administrator_2_1.php"><span>低等级管理员信息</span></a></li>
                    <li><a href="simple_administrator_2_2.php"><span>管理员修改</span></a></li>
                </ul>
            </li>
            <li class="nav-item nav-show">
                <a href="javascript:;"><i class="my-icon nav-icon icon_3"></i><span>仓库管理</span><i class="my-icon nav-more"></i></a>
                <ul style="display: block;">
                    <li><a href="simple_administrator_3_1.php"><span>我的仓库</span></a></li>
                    <li><a href="simple_administrator_3_2.php"><span>订单与出入库管理</span></a></li>
                </ul>
            </li>
        </ul>
    </div>


    <?php
    $tijiao = @$_POST['submit'];
    if($tijiao=="出货"){
    $gno = @$_POST['gno_down'];
    $gnumber = @$_POST['gnumber_down'];
    $querygno = "select * from {$db_name}.goods where gno = '{$gno}'";
    $check_query_gno = $link ->query($querygno);
    $row_gno=mysqli_fetch_array($check_query_gno);
    $quantity =  $row_gno['gnowstock']-$gnumber;
    if($quantity >= 0){
    mysqli_query($link, "update  {$db_name}.goods set gnowstock='{$quantity}' where gno='{$gno}'") or die("存入数据库失败" . mysqli_error());
    }
    else{
     echo "<script> alert('出货量大于库存'); </script>";
    }
    header('location: '.$_SERVER['HTTP_REFERER']);
    }
    ?>   

    <form method="post" action="#">
    <div id="simple_3_2">
        出货号:<input type="text" name="gno_down" size="16" /><br>
        出货数:<input type="text" name="gnumber_down" size="16" /><br>
        <input type="submit" name="submit" value="出货" />
    </div>
   </form>

</body>
</html>