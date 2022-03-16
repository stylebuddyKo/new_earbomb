<?php //require __DIR__."/__connect__db.php";
//        $title = '首頁';
//?>
<?php require __DIR__."/__connect__db.php";
$title = '首頁';
?>
<?php include __DIR__."/earbomb_html_head.php"; ?>


<div class="index-container">
    <?php include __DIR__."/earbomb_navbar.php"; ?>
    <div class="hero_section">
        <img src="img/home-page/hero_section_1920-1.png" alt="">
        <div class="title">
            <h1>EAR BOMB</h1>
            <p>Inspire your passion</p>
        </div>
    </div>
    <div class="product-intro">
        <div class="product-pic1">
            <img src="img/home-page/cq5dam_1000.png" alt="">
        </div>
        <div class="product-text">
            <div>
                <h2>BOSE QuietComfort 35</h2>
                <p>
                    震撼音質<br>全新上市
                </p>
                <div>
                    <a href="">了解更多</a>
                </div>
            </div>
        </div>
    </div>
    <div class="product-choice">
        <img src="img/home-page/cq5dam2_1920.jpeg" alt="">
        <div class="choice-text">
            <h2>
                你可以<br/>
                盡情挑選與購買
            </h2>
            <div>
                <a href="">了解更多</a>
            </div>
        </div>
    </div>
    <div class="web-feature">
        <img src="img/home-page/sennheiser-headphones.jpg" alt="">
        <h2>
            原廠授權代理<br/>
            兩年安心保固
        </h2>
    </div>

</div>


<?php include __DIR__."/earbomb_html_foot.php"; ?>
