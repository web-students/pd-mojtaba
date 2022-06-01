<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- //////////// Links //////////// -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/FNT.css">
    <!-- //////////// Connect To DataBase //////////// -->
    <?php
    // -------- Start Session --------
    session_start();
    // -------- Persian Time Format --------
    include("parts/jdf.php");
    // -------- Connect to DB --------
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // Connect To DataBase
    $link = mysqli_connect("localhost", "root", "", "online-store");
    // change character set to utf8mb4
    mysqli_set_charset($link, "utf8mb4");
    print mysqli_connect_error();
    ?>

    <!-- //////////// Title //////////// -->
    <title>فروشگاه کتاب الماس | Almas Book Store</title>
</head>

<body dir="rtl">
    <div id="main-container">
        <!-- ////////////// Header ////////////// -->
        <header>
            <h1>فروشگاه کتاب الماس</h1>
        </header>
        <!-- ////////////// Main Content ////////////// -->
        <div class="content-container">
            <!-- ----------- Main Content ----------- -->
            <nav id='main-menu'>
                <a href="index.php">صفحه اصلی</a>
                <a href="store.php">فروشگاه</a>
                <a href="contact.php">تماس با ما</a>
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login']) {
                    print("<a href='shopcart.php'>سبد خرید(" . count($_SESSION['shopcart']) . ")</a>");
                    print("<a href='order.php'>سفارشات</a>");
                    print("<a> {$_SESSION['user_name']} </a>");
                    print("<a href='logout.php' class='acc-logout'>(خروج از حساب)</a>");
                } else {
                    print("<a href='login.php'>ثبت نام / ورود</a>");
                }
                ?>
            </nav>

            <main>