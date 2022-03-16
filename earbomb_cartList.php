<?php require __DIR__."/__connect__db.php";
$title = '購物車';

if(! empty($_SESSION['cart'])){

$keys = array_keys($_SESSION['cart']);

$sql = sprintf("SELECT * FROM `product` WHERE sid IN (%s)", implode(',', $keys));

$rs = $mysqli->query($sql);

$cart_data = array();
//取出資料並且重新排序方法
while($r = $rs->fetch_assoc()) {
    $r['qty'] = $_SESSION['cart'][$r['sid']]; //找到該商品在session中的數量形成關聯式陣列

    $cart_data[$r['sid']] = $r;//拿到KEY拿到整筆資料
    }
$rs->data_seek(0); //內部指標第一筆

}
?>

<?php include __DIR__."/earbomb_html_head.php"; ?>
<?php include __DIR__."/earbomb_navbar.php"; ?>

    <div class="cartList-container">
        <h1>耳娛我炸 購物車</h1>

<?php //print_r($cart_data);

//                print_r(array_keys($_SESSION['cart']));
//
//                echo "\n";
//
//                echo implode(',',array_keys($_SESSION['cart']));

//        ?>

        <div class="shopping-cart">

            <div class="column-labels">
                <label class="product-image">Image</label>
                <label class="product-details">Product</label>
                <label class="product-price">Price</label>
                <label class="product-quantity">Quantity</label>
                <label class="product-removal">Remove</label>
                <label class="product-line-price">Total</label>
            </div>
            <?php if (isset($cart_data)) : ?>
            <?php foreach($keys as $k) :
            $row = $cart_data[$k];
            ?>
            <div class="product" id="item<?= $row['sid'] ?>" data-sid="<?= $row['sid'] ?>">
                <div class="product-image">
                    <img src="./img/product-list/all/<?= $row['headphone_id'] ?>.jpg">
                </div>
                <div class="product-details">
                    <div class="product-title"><?= $row['headphone_id'] ?></div>
                    <p class="product-description"><?= $row['introduction'] ?></p>
                </div>
                <div class="product-price"><?= $row['price'] ?></div>
                <div class="product-quantity">
<!--                    <input type="number" value="--><?//= $_SESSION['cart'][$row['sid']] ?><!--" min="1">-->
                    <select class="buy-count" id="">
                        <?php for($k=1; $k<=10; $k++): ?>
                            <option value="<?= $k ?>" <?= $row['qty']==$k ? 'selected' : '' ?>><?= $k ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="product-removal">
                    <button class="remove-product" onclick="javascript:remove_item(<?= $row['sid'] ?>)">
                        Remove
                    </button>
                </div>
                <div class="product-line-price"><?= $row['price']*$row['qty'] ?></div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
                <div>請先加入購物車</div>
            <?php endif; ?>
            <div class="totals">
                <div class="totals-item">
                    <label>Subtotal</label>
                    <div class="totals-value" id="cart-subtotal"></div>
                </div>
                <div class="totals-item">
                    <label>Shipping</label>
                    <div class="totals-value" id="cart-shipping">15.00</div>
                </div>
                <div class="totals-item totals-item-total">
                    <label>Grand Total</label>
                    <div class="totals-value" id="cart-total"></div>
                </div>
            </div>
            <?php if (isset($_SESSION['user'])) : ?>
                <button onclick="location.href='earbomb_buy.php'" class="checkout">Checkout</button>
            <?php else: ?>
                <button onclick="location.href='earbomb_login.php'" class="checkout">請先登入再結帳</button>
            <?php endif; ?>
        </div>   
    </div>


<script>
    /* Set rates + misc */
    var taxRate = 0;
    var shippingRate = 15.00;
    var fadeTime = 300;

    $('.product select').change( function() {
        var qty = $(this).val();
        var sid = $(this).closest('.product').attr('data-sid');

        $.get('add_to_cart.php', {sid:sid, qty:qty}, function(data){
            showCartCount(data);
        }, 'json');
    });


    /* Assign actions */
    $('.product-quantity select').change( function() {
        updateQuantity(this);
    });

    $('.product-removal button').click( function() {
        removeItem(this);
    });
    recalculateCart();

    /* Recalculate cart */
    function recalculateCart()
    {
        var subtotal = 0;

        /* Sum up row totals */
        $('.product').each(function () {
            subtotal += parseFloat($(this).children('.product-line-price').text());
        });

        /* Calculate totals */
        var tax = subtotal * taxRate;
        var shipping = (subtotal > 0 ? shippingRate : 0);
        var total = subtotal + tax + shipping;

        /* Update totals display */
        $('.totals-value').fadeOut(fadeTime, function() {
            $('#cart-subtotal').html(subtotal.toFixed(2));
            $('#cart-tax').html(tax.toFixed(2));
            $('#cart-shipping').html(shipping.toFixed(2));
            $('#cart-total').html(total.toFixed(2));
            if(total == 0){
                $('.checkout').fadeOut(fadeTime);
            }else{
                $('.checkout').fadeIn(fadeTime);
            }
            $('.totals-value').fadeIn(fadeTime);
        });
    }


    /* Update quantity */
    function updateQuantity(quantityInput)
    {
        /* Calculate line price */
        var productRow = $(quantityInput).parent().parent();
        var price = parseFloat(productRow.children('.product-price').text());
        var quantity = $(quantityInput).val();
        var linePrice = price * quantity;

        /* Update line price display and recalc cart totals */
        productRow.children('.product-line-price').each(function () {
            $(this).fadeOut(fadeTime, function() {
                $(this).text(linePrice.toFixed(2));
                recalculateCart();
                $(this).fadeIn(fadeTime);
            });
        });
    }


    /* Remove item from cart */
    function removeItem(removeButton)
    {
        /* Remove row from DOM and recalc cart total */
        var productRow = $(removeButton).parent().parent();
        productRow.slideUp(fadeTime, function() {
            productRow.remove();
            recalculateCart();
        });
    }
    function remove_item(sid){
        $.get('add_to_cart.php', {sid:sid}, function(data){
            showCartCount(data);
            $('#item'+sid).remove();
        }, 'json');
  
    }
</script>





<?php include __DIR__."/earbomb_html_foot.php"; ?>
