<?php include("parts/header.php"); ?>
<?php
if (isset($_SESSION['login'])) {

	print "شما قبلا وارد شده اید";
} elseif (!empty($_POST)) {

	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {

		if ($_POST['password'] == $_POST['repassword'] && strlen($_POST['password']) >= 6) {

			$name = htmlspecialchars(mysqli_real_escape_string($link, $_POST['name']));
			$email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
			$tel = htmlspecialchars(mysqli_real_escape_string($link, $_POST['tel']));
			$address = htmlspecialchars(mysqli_real_escape_string($link, $_POST['address']));
			$password = htmlspecialchars(mysqli_real_escape_string($link, $_POST['password']));

			$password = md5($password);

			mysqli_query($link, "INSERT INTO `users`(`name`,`email`,`tel`,`address`,`password`)
				VALUES('$name','$email','$tel','$address','$password')");

			$error = mysqli_error($link);



			if (empty($error))
				print("ثبت نام با موفقیت انجام شد");
			else
				print $error;
		} else {

			print("گذرواژه با تکرار گذرواژه مطابقت ندارد یا طول گذرواژه کمتر از 6 حرف می باشد");
		}
	} else {

		print("اطلاعات مورد نیاز وارد نشده است");
	}
} else { ?>
	<!-- /////////////////// PAGE CONTENT /////////////////// -->
	<div class="signup-form-container">
		<form class="signup-form" method="post">
			<!-- --------- title --------- -->
			<h3 class="form-title">
				حساب کاربری | ثبت نام
			</h3>
			<!-- --------- name --------- -->
			<label for="name">نام و نام خانوادگی:</label>
			<input type="text" name="name" id="name">
			<!-- --------- email --------- -->
			<label for="email">پست الکترونیک:</label>
			<input type="email" name="email" id="email">
			<!-- --------- Tell --------- -->
			<label for="tel">شماره تماس:</label>
			<input type="text" name="tel" id="tel">
			<!-- --------- address --------- -->
			<label for="address">آدرس:</label>
			<input type="text" name="address" id="address">
			<!-- --------- password --------- -->
			<label for="password">گذرواژه:</label>
			<input type="password" name="password" id="password">
			<!-- --------- repassword --------- -->
			<label for="repassword">تکرار گذرواژه:</label>
			<input type="password" name="repassword" id="repassword">
			<!-- --------- Submit --------- -->
			<input type="submit" name="submit" id="submit" value="ثبت نام">
			<!-- --------- acc login --------- -->
			<a href="login.php" class="acc-link">حساب کاربری دارید؟ وارد شوید</a>
		</form>
	</div>
<?php } ?>
<?php include("parts/footer.php"); ?>