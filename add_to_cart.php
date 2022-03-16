<?php
//加入商品 移除商品 查詢內容
//sid, qty

session_start();

if(! isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
if(isset($_GET['sid'])){
    //檢查商品資料表有無該商品

    $sid = intval($_GET['sid']); //商品編號

    $qty =isset($_GET['qty']) ? intval($_GET['qty']) : 0 ;//商品數量

    if(empty($qty)){
            //移除商品
            unset($_SESSION['cart'][$sid]);


    } else {
           //加入商品
        $_SESSION['cart'][$sid] = $qty;
    }

}



echo json_encode($_SESSION['cart']);