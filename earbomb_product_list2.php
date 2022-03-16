<?php //require __DIR__."/__connect__db.php";
//$title = 'AKG' ;
//$sql_query ="SELECT * FROM `product`";
//$result = $mysqli->query($sql_query);
//$total_records = $result->num_rows;
//?>
<?php require __DIR__."/__connect__db.php";
    $title = 'audio-technica' ;
//    用戶目前要看的頁數以GET參數傳值
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//替$page做過濾其中的"?" ":"代表一個三元運算子 該句語意為若$page小於等於0則就等於1若不小於等於0則等於自身$page

    $page = $page<=0 ? 1 : $page;

    $per_page = 8 ;
//    利用SQL語法算出資料總筆數
    $t_sql = "SELECT COUNT(1) FROM `product` WHERE `category_sid`=2";
    $total_result = $mysqli->query($t_sql);
    $total_rows = $total_result->fetch_row()[0];
    $pages = ceil($total_rows/$per_page);

//    使用sprintf因為頁首開始有其規律為8的倍數 每頁起始值應為(n-1)*8用%s放入字串
//    SQL中LIMIT第一個值為起始值以","作分隔 第二個值為從起始值開始抓出多少數量的值
    $sql_query =sprintf("SELECT * FROM `product` WHERE `category_sid`=2 LIMIT %s, %s", ($page-1)*$per_page, $per_page);
    $result = $mysqli->query($sql_query);
    $total_records = $result->num_rows;
?>
<?php include __DIR__."/earbomb_html_head.php"; ?>

<div class="product_list-container">
    <?php include __DIR__."/earbomb_navbar.php";?>
    <div class="guide">
        <ul class="breadcrumb">
            <li><a href="earbomb_index.php">首頁</a></li>
            <li class="active">Audio-Technica</li>
        </ul>
    </div>
    <div class="main-image">
        <img src="img/product-list/akg-logo.jpg" alt="">
    </div>
    <div class="product-list">
        <div class="brand-title">
            <h2>鐵三角品牌耳機</h2>
            <canvas id="myCanvas"></canvas>
        </div>
        <div class="list-row">
            <?php for($i=0; $i<8; $i++) :
                $row = $result->fetch_assoc()
             ?>
            <div class="list-col">
                <?php if(! empty($row)): ?>
                <div class="list-card">
                    <div class="list-img">
                        <img src="img/product-list/all/<?= $row["headphone_id"] ?>.jpg" alt="">
                    </div>
                    <div class="card-body">
                        <h6><?= $row["headphonename"] ?></h6>
                        <p><?= $row["introduction"] ?></p>
                        <div class="list-buy">
                            <p>N.T.:<?= $row["price"] ?></p>
                            <button onclick="location.href='earbomb_product_detail.php?page=<?= $row['sid'] ?>'">更多細節</button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endfor; ?>
            <nav aria-label="Page navigation example" class="pagination">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for($i=1; $i<=$pages; $i++) : ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
    </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.9.24/paper-core.min.js"></script>  
    <script>
        $(document).ready(function(){
        var canvas = document.getElementById('myCanvas');
        var context = canvas.getContext('2d');
//        用canvas畫直線
        context.beginPath();
        context.moveTo(30, 20);
        context.lineTo(900, 20);
        context.lineWidth = 3;
        context.stroke();
//            var c=document.getElementById("myCanvas");
// 建立繪製物件
//            var ctx=c.getContext("2d");
// 建立線型漸層物件 參數依序為 x0(x起始點)、y0(y起始點)、x1(x結束點)、y1(y結束點)
//            var grd=ctx.createLinearGradient(0,0,175,50);
// 設定顏色位置 參數依序為 position(0.0 到 1.0，0 即為起始點，1 即為結束點)、顏色代碼
//            grd.addColorStop(0,"#FF0000");
// 設定顏色位置 參數依序為 position(0.0 到 1.0，0 即為起始點，1 即為結束點)、顏色代碼
//            grd.addColorStop(1,"#00FF00");
// 設定填滿樣式
//            ctx.fillStyle=grd;
// 執行填滿繪製 參數依序為 x、y、width(寬)、height(高)
//            ctx.fillRect(0,0,300,50);

        });
    </script>


<?php include __DIR__."/earbomb_html_foot.php"; ?>



