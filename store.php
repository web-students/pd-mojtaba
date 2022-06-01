<?php include("parts/header.php"); ?>
<?php
print "<div class='products'>";

$query = mysqli_query($link, "SELECT * FROM `products` ");
if (mysqli_num_rows($query) > 0) {

    while ($record = mysqli_fetch_array($query)) {

        if (!empty($record['image']))
            $image = "images/{$record['image']}";
        else
            $image = "images/noimage.png";
        print "
		<div class='products_container';>

			<a href='product.php?code={$record['code']}'>
			<img src='$image' class='prod_img' > </a> 
			<h4 class='prod_title'>{$record['name']}</h4>
			<p class='prod_price'>" . number_format($record['price']) . " تومان</p>
	
		</div>";
    }
} else {
    print("محصولی برای نمایش وجود ندارد");
}

print "</div>";
?>
<?php include("parts/footer.php"); ?>