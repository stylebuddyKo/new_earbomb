<?php //require __DIR__."/__connect__db.php";
//$title = '商品細節';
//
//$page = isset($_GET['page']) ? intval($_GET['page']) :1;
//
//$per_page = 1 ;
//
//$t_sql = "SELECT COUNT(1) FROM `product`";
//$total_rs = $mysqli->query($t_sql);
//$total_rows = $total_rs->fetch_row()[0];
//
//
//$sql = sprintf("SELECT * FROM `product` LIMIT %s, %s", ($page-1)*$per_page, $per_page);
//$product_result = $mysqli->query($sql);
//
//$pages = ceil($total_rows/$per_page);
//
//?>
<?php require __DIR__."/__connect__db.php";
    $title = '商品細節';

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $page = $page<= 0 ? 1 : $page;

    $per_page = 1 ;

    $t_sql = "SELECT COUNT(1) FROM `product`";
    $total_rs = $mysqli->query($t_sql);
    $total_rows = $total_rs->fetch_row()[0];


    $sql = sprintf("SELECT * FROM `product` LIMIT %s, %s", ($page-1)*$per_page, $per_page);
    $product_result = $mysqli->query($sql);

    $pages = ceil($total_rows/$per_page);


?>
<?php include __DIR__."/earbomb_html_head.php"; ?>
<?php include __DIR__."/earbomb_navbar.php"; ?>


<div class="detail-container">
    <?php for($i=0; $i<1; $i++ ) :
    $row = $product_result->fetch_assoc()
    ?>
    <div class="guide">
        <?php if(! empty($row)) : ?>
        <ul class="breadcrumb2">
            <li><a href="earbomb_index.php">首頁</a></li>
            <li class="active"><a href="earbomb_product_list.php">AKG</a></li>
            <li><?= $row['headphonename'] ?></li>
        </ul>
    </div>
        <h2 class="brand-name"><?= $row['brand'] ?></h2>
        <div class="product-summary">
            <div class="product-bigImage">
                <img src="img/product-detail/all/<?= $row['headphone_id'] ?>.jpg" alt="">
            </div>
            <div class="product-content">
                <div class="content-title"><?= $row['headphonename'] ?></div>
                <div class="content-word">
                    <?= $row['introduction'] ?>
                </div>
                <div class="content-price">N.T.<?= $row['price'] ?>元</div>
                <div class="detail-buy">
                    <select class="buy-count" id="">
                        <?php for($k=1; $k<=10; $k++): ?>
                        <option value="<?= $k ?>"><?= $k ?></option>
                        <?php endfor; ?>
                    </select>
                    <button class="buy-btn" data-sid="<?= $row['sid'] ?>">加入購物車</button>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endfor; ?>
        <div class="detail-features">
            <div class="feature1">
                <div class="word feature-left">
                    <h3>絕佳的主動式抗噪設計</h3>
                    <p>
                        藉由主動噪音控制機制（ANC）可消除周遭令人不快之聲音（
                        亦即噪音）的耳機。原理為使用一個以上靠近耳朵之麥克
                        風接收外界噪音，並以電子電路產生和噪音波相位相反之訊
                        號。當此反相訊號產生時，破壞性干涉消除了配戴耳機者本
                        來所聽到之外界噪音
                    </p>
                </div>
                <div class="picture feature-right">
                    <img src="img/product-detail/feature-pic2.jpeg" alt="">
                </div>
            </div>
            <div class="feature2">
                <div class="picture feature-left">
                    <img src="img/product-detail/feature-pic1.jpeg" alt="">
                </div>
                <div class="word feature-right">
                    <h3>絕佳的主動式抗噪設計</h3>
                    <p>
                        藉由主動噪音控制機制（ANC）可消除周遭令人不快之聲音（
                        亦即噪音）的耳機。原理為使用一個以上靠近耳朵之麥克
                        風接收外界噪音，並以電子電路產生和噪音波相位相反之訊
                        號。當此反相訊號產生時，破壞性干涉消除了配戴耳機者本
                        來所聽到之外界噪音
                    </p>
                </div>
            </div>
            <div class="feature3">
                <div class="word feature-left">
                    <h3>絕佳的主動式抗噪設計</h3>
                    <p>
                        藉由主動噪音控制機制（ANC）可消除周遭令人不快之聲音（
                        亦即噪音）的耳機。原理為使用一個以上靠近耳朵之麥克
                        風接收外界噪音，並以電子電路產生和噪音波相位相反之訊
                        號。當此反相訊號產生時，破壞性干涉消除了配戴耳機者本
                        來所聽到之外界噪音
                    </p>
                </div>
                <div class="picture feature-right">
                    <img src="img/product-detail/feature-pic2.jpeg" alt="">
                </div>
            </div>
            <div class="feature4">
                <div class="picture feature-left">
                    <img src="img/product-detail/feature-pic1.jpeg" alt="">
                </div>
                <div class="word feature-right">
                    <h3>絕佳的主動式抗噪設計</h3>
                    <p>
                        藉由主動噪音控制機制（ANC）可消除周遭令人不快之聲音（
                        亦即噪音）的耳機。原理為使用一個以上靠近耳朵之麥克
                        風接收外界噪音，並以電子電路產生和噪音波相位相反之訊
                        號。當此反相訊號產生時，破壞性干涉消除了配戴耳機者本
                        來所聽到之外界噪音
                    </p>
                </div>
            </div>
        </div>
    <div class="product-spec">
        <div class="spec-detail">
            <h4 class="spec-title">
                商品規格
            </h4>
            <div class="spec-words word-border">
                <ul>
                    <li>
                        <span>顏色</span>
                        <span>黑</span>
                    </li>
                    <li>
                        <span>響應功率</span>
                        <span>30 - 16000 Hz</span>
                    </li>
                    <li>
                        <span>配戴型式</span>
                        <span>耳道式</span>
                    </li>
                    <li>
                        <span>驅動方式</span>
                        <span>動圈封閉式</span>
                    </li>
                    <li>
                        <span>重量</span>
                        <span>500克</span>
                    </li>
                    <li>
                        <span>阻抗</span>
                        <span>60歐姆</span>
                    </li>
                    <li>
                        <span>最大分貝</span>
                        <span>115db</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-detail">
            <h4>
                商品內容物
            </h4>
            <div class="content-words word-border">
            <ul>
                <li>
                    <span>耳機單體</span>
                    <span>1只</span>
                </li>
                <li>
                    <span>耳機線材</span>
                    <span>一捆</span>
                </li>
                <li>
                    <span>5mm轉接頭</span>
                    <span>一顆</span>
                </li>
                <li>
                    <span>USB轉接頭</span>
                    <span>一顆</span>
                </li>
                <li>
                    <span>收納袋</span>
                    <span>1件</span>
                </li>
                <li>
                    <span>耳機墊圈</span>
                    <span>1副</span>
                </li>
            </ul>
            </div>
        </div>
    </div>
    <div class="guarantee">
        <div class="gua-title">在EAR BOMB購買耳機 你可以享有以下安心保證</div>
        <div class="gua-icons">
            <div class="icons1">
                <img src="img/product-detail/shipped.png" alt="">
                <p>24小時到貨</p>
            </div>
            <div class="icons2">
                <img src="img/product-detail/guarantee.png" alt="">
                <p>兩年原廠保固</p>
            </div>
            <div class="icons3">
                <img src="img/product-detail/sale.png" alt="">
                <p>超優惠價格</p>
            </div>
            <div class="icons4">
                <img src="img/product-detail/gift.png" alt="">
                <p>安心售後服務</p>
            </div>
            <div class="icons5">
                <img src="img/product-detail/return.png" alt="">
                <p>鑑賞期退換貨</p>
            </div>
        </div>
    </div>
</div>

    <script>
        $('button.buy-btn').click(function () {
            var sid = $(this).attr('data-sid');

            var qty = $(this).closest('.product-content').find('select ').val();

            $.get('add_to_cart.php',{sid:sid, qty:qty}, function(data){
                    console.log(data);
                    showCartCount(data);
                    alert('感謝加入購物車');
            }, 'json');
        });
    </script>



<?php include __DIR__."/earbomb_html_foot.php"; ?>