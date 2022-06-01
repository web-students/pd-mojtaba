<?php include("parts/header.php"); ?>
<?php
if (isset($_SESSION['login'])) {

    print "شما قبلا وارد شده اید";
} elseif (!empty($_POST)) {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        print("پست الکترونیک و گذرواژه نمی تواند خالی باشد");
    } else {

        $email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));

        $password = htmlspecialchars(mysqli_real_escape_string($link, $_POST['password']));

        $password = md5($password);

        $query = mysqli_query($link, "SELECT * FROM `users` WHERE `email`='$email' AND `password`= '$password' ");

        if (mysqli_num_rows($query) > 0) {

            $record = mysqli_fetch_assoc($query);

            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $record['code'];
            $_SESSION['user_name'] = $record['name'];
            $_SESSION['shopcart'] = array();

            header("Location: store.php");
        } else {

            print "اطلاعات کاربری اشتباه است<br>";
        }
    }
} else {
?>
    <!-- /////////////////// PAGE CONTENT /////////////////// -->
    <div class="login-form-container">
        <form class="login-form" method="post">
            <!-- --------- title --------- -->
            <h3 class="form-title">
                حساب کاربری | ورود
            </h3>
            <!-- --------- email --------- -->
            <label for="email">پست الکترونیک:</label>
            <input type="email" name="email" id="email">
            <!-- --------- password --------- -->
            <label for="password">رمز:</label>
            <input type="password" name="password" id="password">
            <!-- --------- Submit --------- -->
            <input type="submit" name="submit" id="submit" value="ورود">
            <!-- --------- acc login --------- -->
            <a href="signup.php" class="acc-link">حساب کاربری ندارید؟ ثبت نام کنید</a>
        </form>
    </div>
<?php } ?>
<?php include("parts/footer.php"); ?>