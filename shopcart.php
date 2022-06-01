<?php include("parts/header.php"); ?>
<?php
if (isset($_SESSION['login']) && $_SESSION['login']) {
    print("<h2 class='shopcart-title'>حساب کاربری | سبد خرید</h2>");
    // -------- add to cart --------
    if (isset($_POST['add_to_cart'])) {
        $code = (int)$_POST['code'];
        $num = (int)$_POST['num'];

        $_SESSION['shopcart'][$code] = $num;
        header("Location: shopcart.php");
    }

    // -------- remove from cart --------
    if (isset($_POST['remove'])) {
        $code = (int)$_POST['code'];

        unset($_SESSION['shopcart'][$code]);
        header("Location: shopcart.php");
    }

    if (count($_SESSION['shopcart']) > 0) {
        $prod_codes = implode(',', array_keys($_SESSION['shopcart']));
        $query = mysqli_query($link, "SELECT `code`, `name`, `price` FROM `products` WHERE `code` IN ($prod_codes)");
        $total_price = 0;
        while ($record = mysqli_fetch_array($query)) {
            print "
                <div class='shopcart'>
                    <div class='shopcart-name'>{$record['name']}</div>
                    <div class='shopcart-price'>" . number_format($record['price']) . "</div>
                    <div class='shopcart-count'>{$_SESSION['shopcart'][$record['code']]}</div>
                    <div class='shopcart-remove'>
                        <form method='post'>
                            <input type='hidden' name='code' value='{$record['code']}'>
                            <input type='submit' name='remove' value='حذف'>
                        </form>
                    </div>
                </div>
            ";
            $total_price += $record['price'] * $_SESSION['shopcart'][$record['code']];
        }

        print("<p class='shopcart-pricesum'>جمع مبالغ: " . number_format($total_price) . "</p>");
        // ---------- add to orders ----------
        print "
            <form action='order.php' method='post'>
                <input id='finalize_order' type='submit' name='finalize_order' value='نهایی کردن سفارش'>
            </form>
        ";
    } else {
        print("سبد خرید خالی است!");
    }
} else {
    print("برای دسترسی به این صفحه ابتدا وارد حساب کاربری خود شوید");
}
?>
<?php include("parts/footer.php"); ?>
