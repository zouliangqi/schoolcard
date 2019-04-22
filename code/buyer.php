<?php 
header("Content-type:text/html; charset=UTF-8");
session_start();   
?>


<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>BUYER</title>
    
    <link rel="stylesheet" type="text/css" href="./buyer_css/nav.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/iconfont.css">
    
    <script src="./buyer_css/hm.js"></script><script type="text/javascript" src="./buyer_css/jquery.min.js"></script>
    <script type="text/javascript" src="./buyer_css/nav.js"></script>

</head>
<body style="">
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


</body></html>