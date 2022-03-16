<?php require __DIR__."/__connect__db.php";
//分類
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0;

$c_sql = "SELECT * FROM `categories` ORDER BY `sid`";

$c_rs = $mysqli->query($c_sql);




?>
<nav>
    <div class="earbomb-logo"><a href="earbomb_index.php"><img src="img/logo/logo5.png" alt=""></a></div>
<!--    <div class="btn-group" role="group" aria-label="Basic example">-->
<!--        <button type="button" class="cate btn btn-secondary" data-cate="0">全部</button>-->
<!--        --><?php //while($c_row = $c_rs->fetch_assoc()) :
//            if ($c_row['parent_sid']==0):
//            ?>
<!---->
<!--                <button type="button" class="cate btn --><?//= $cate==$c_row['sid'] ? 'btn-secondary disabled' : 'btn-secondary'?><!--" data-cate="--><?//= $c_row['sid'] ?><!--">--><?//= $c_row['name'] ?><!--</button>-->
<!--            --><?php //endif; ?>
<!--        --><?php //endwhile; ?>
<!--    </div>-->
    <div class="earbomb-nav">
        <ul class="nav-options clearfix">
            <li class="option"><a href="">找品牌</a>
                <ul class="sub-menu">
                    <li><a href="earbomb_product_list.php">AKG</a></li>
                    <li><a href="earbomb_product_list2.php">audio-technica</a></li>
                    <li><a href="earbomb_product_list.php">sennheiser</a></li>
                </ul>
            </li>
            <li class="option"><a href="">音樂喜好</a>
                <ul class="sub-menu">
                    <li><a href="earbomb_product_list.php">古典音樂</a></li>
                    <li><a href="earbomb_product_list.php">搖滾樂曲</a></li>
                    <li><a href="earbomb_product_list.php">優美人聲</a></li>
                    <li><a href="earbomb_product_list.php">嘻哈饒舌</a></li>
                </ul>
            </li>
            <li class="option"><a href="">功能至上</a>
                <ul class="sub-menu">
                    <li><a href="earbomb_product_list.php">戶外運動</a></li>
                    <li><a href="earbomb_product_list.php">家用影音</a></li>
                    <li><a href="earbomb_product_list.php">錄音室用</a></li>
                    <li><a href="earbomb_product_list.php">通訊功能</a></li>
                </ul>
            </li>
            <li class="cart-list">
                <a href="earbomb_cartList.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 購物車 <span class="badge badge-pill badge-warning cart-count" style="display: none">0</span></a>
            </li>
            <?php if(isset($_SESSION['user'])) : ?>
                <li class="option"><a href=""><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?= $_SESSION['user']['nickname'] ?></a>
                    <ul class="sub-menu">
                        <li><a href="earbomb_logout.php">會員登出</a></li>
                        <li><a href="">歷史訂單</a></li>
                        <li><a href="earbomb_edit.php">編輯會員資料</a></li>
                    </ul>
                </li>
            <?php else : ?>
            <li class="option"><a href=""><i class="fa fa-user-circle-o" aria-hidden="true"></i> 會員中心</a>
                <ul class="sub-menu">
                    <li><a href="earbomb_register.php">會員註冊</a></li>
                    <li><a href="earbomb_login.php">會員登入</a></li>
                    <li><a href="">歷史訂單</a></li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
        <button class="hamburger-menu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <ul class="hamburger-options clearfix">
            <li class="mobile-option"><a href="earbomb_product_list.php">找品牌</a>
                <ul class="sub-menu">
                    <li><a href="earbomb_product_list.php">AKG</a></li>
                    <li><a href="earbomb_product_list2.php">audio-technica</a></li>
                    <li><a href="earbomb_product_list.php">sennheiser</a></li>
                </ul>
            </li>
            <li class="mobile-option"><a href="earbomb_product_list2.php">音樂喜好</a>
                <ul class="sub-menu">
                    <li><a href="earbomb_product_list.php">古典音樂</a></li>
                    <li><a href="earbomb_product_list.php">搖滾樂曲</a></li>
                    <li><a href="earbomb_product_list.php">優美人聲</a></li>
                    <li><a href="earbomb_product_list.php">嘻哈饒舌</a></li>
                </ul>
            </li>
            <li class="mobile-option"><a href="earbomb_product_list.php">功能至上</a>
                <ul class="sub-menu">
                    <li><a href="earbomb_product_list.php">戶外運動</a></li>
                    <li><a href="earbomb_product_list.php">家用影音</a></li>
                    <li><a href="earbomb_product_list.php">錄音室用</a></li>
                    <li><a href="earbomb_product_list.php">通訊功能</a></li>
                </ul>
            </li>
            <li class="mobile-option"><a href="earbomb_cartList.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 購物車</a></li>
            <li class="mobile-option"><a href=""><i class="fa fa-user-circle-o" aria-hidden="true"></i> 會員中心</a>
                <ul class="sub-menu">
                    <li><a href="earbomb_register.php">會員註冊</a></li>
                    <li><a href="earbomb_login.php">會員登入</a></li>
                    <li><a href="">歷史訂單</a></li>
                    <li><a href="">編輯會員資料</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script>
    var cart_count = $('.cart-count');

    $('.cate.btn').click(function(){
        var cate = $(this).attr('data-cate');
        location.href = '?cate=' + cate;
    });

    $(function () {
        $.get('add_to_cart.php', function(data){
//            console.log(data);
              showCartCount(data);
              cart_count.show();
        }, 'json');
    });

    function showCartCount(obj){
        var s, count=0;
        for(s in obj){
            count += obj[s];
        }
        $('.cart-count').text(count);
    }
</script>
