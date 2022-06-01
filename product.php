<?php include("parts/header.php"); ?>
<?php
if (isset($_GET['code']) && is_numeric($_GET['code'])) {

    $code = mysqli_real_escape_string($link, $_GET['code']);

    $query = mysqli_query($link, "SELECT * FROM `products` WHERE code = $code ");

    if (mysqli_num_rows($query) > 0) {

        ($record = mysqli_fetch_array($query));

        if (!empty($record['image']))
            $image = "images/{$record['image']}";
        else
            $image = "images/noimage.png";

        print("
            <div class='product'>
                <div class='product-contain'>
                    <div class='product_image'>
                        <img src='$image' class = 'product_img'>
                    </div>
                    <div class='product_content'>

                        <div class='product_desc'>
                            <p>" .  nl2br($record['details']) . "</p>
                        </div>
                        
                        <div class='product_price'>
                            <p>" . number_format($record['price']) . "</p>
                        </div>

                        <form action='shopcart' method='post'>
                            <input type='hidden' name='code' value='$code'>
                            <input type='number' name='num'min='1' value='1'>
                            <input type='submit' name='add_to_cart' value='خرید'>
                        </form>

                    </div> 
                </div>
            </div>
        ");
    } else {
        print("چنین محصولی برای نمایش وجود ندارد");
    }
} else {
    print "خطای کد محصول";
}
?>
<?php include("parts/footer.php"); ?>