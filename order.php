<?php include("parts/header.php"); ?>
<?php
$statuses = [
    'منتظر پرداخت ',
    'پرداخت شده ',
    'آماده ارسال ',
    'ارسال شده '
];
if (isset($_SESSION['login']) && $_SESSION['login']) {
    print("<h2 class='shopcart-title'>حساب کاربری | سفارشات</h2>");
    // --------- Orders registration operation ---------
    if (isset($_POST['finalize_order']) && $_SESSION['shopcart']) {
        // --- User Code ---
        $uid = $_SESSION['user_id'];
        // --- Order registration ---
        $order_query = mysqli_query($link, "INSERT INTO orders (uid,date) VALUES ($uid, unix_timestamp())");
        // --- Order code ---
        if ($order_query == true) {
            $oid = mysqli_insert_id($link);

            foreach ($_SESSION['shopcart'] as $pid => $qty) {
                mysqli_query($link, "INSERT INTO order_details (oid,pid,qty,price)
                VALUES ($oid, $pid, $qty, (SELECT price FROM products WHERE code=$pid) ) ");
            }

            // --- Empty Shopcart ---
            $_SESSION['shopcart'] = array();

            print "سفارش شما با موفقیت ثبت شد!";
        } else {
            print "خطا در ثبت سفارش!";
        }
    }
    // --------- Show Orders ---------
    $uid = $_SESSION['user_id'];
    // user orders query
    $orders_query = mysqli_query($link, "SELECT * FROM orders WHERE uid='$uid' ");
    if (mysqli_num_rows($orders_query) > 0) {
        while ($order = mysqli_fetch_array($orders_query)) {
            // order code
            $oid = $order['id'];
            // order date
            $date = jdate('Y/n/j H:i', $order['date']);
            // order status
            $status = $statuses[$order['status']];
            //order details
            $details_query = mysqli_query($link, "SELECT od.*, p.name FROM order_details as od LEFT JOIN products as p ON p.code=od.pid WHERE od.oid='$oid' ");
        }

        $products = '';
        $total_price = 0;
        // ############## Print Product ##############
        while ($details = mysqli_fetch_array($details_query)) {
            $products .= "
                <div id='orders-product'>
                    <div class='orders-product-name'>{$details['name']}</div>
                    <div class='orders-product-qty'>{$details['qty']}</div>
                    <div class='orders-product-price'>" . number_format($details['price']) . " تومان </div>
                </div>";
            $total_price += $details['price'] * $details['qty'];
        }
        // ############## Print Order ##############
        print "<div id='orders-container'>
                    <div id='orders'>
                        <p class='orders-code'>کد سفارش: $oid</p>
                        <p class='orders-date'> تاریخ: $date</p>
                        <p class='orders-status'> وضعیت: $status</p>
                        <p class='orders-price'>مبلغ سفارش : " . number_format($total_price) . " تومان </p>
                        $products
                    </div>
                </div>";
    } else {
        print "<p>سفارشی وجود ندارد </p>";
    }
} else {
    print("برای دسترسی به این صفحه ابتدا وارد حساب کاربری خود شوید");
}
?>
<?php include("parts/footer.php"); ?>