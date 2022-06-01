<?php include("parts/header.php"); ?>
<?php
if (!empty($_POST)) {
	if (!empty($_POST['name']) && !empty($_POST['tel'])) {

		$name = htmlspecialchars(mysqli_real_escape_string($link, $_POST['name']));

		$tel = htmlspecialchars(mysqli_real_escape_string($link, $_POST['tel']));

		$comment = htmlspecialchars(mysqli_real_escape_string($link, $_POST['comment']));

		mysqli_query($link, "INSERT INTO `contact` (`name`, `tel`, `comment`)
			  VALUES ('$name', '$tel', '$comment')");

		print "اطلاعات دریافت شد";
	} else {
		print "اطلاعات دریافت نشد";
	}
} else {
?>
	<!-- /////////////////// PAGE CONTENT /////////////////// -->
	<div class="contact-form-container">
		<form class="contact-form" method="post">
			<!-- --------- title --------- -->
			<h3 class="form-title">
				تماس با ما
			</h3>
			<!-- --------- Name --------- -->
			<label for="name">نام و نام خانوادگی:</label>
			<input type="text" name="name" id="name">
			<!-- --------- Tell --------- -->
			<label for="tel">شماره تماس:</label>
			<input type="text" name="tel" id="tel">
			<!-- --------- Comment --------- -->
			<label for="comment">پیام:</label>
			<textarea name="comment" id="comment"></textarea>
			<!-- --------- Submit --------- -->
			<input type="submit" name="submit" id="submit" value="ارسال">
		</form>
	</div>
<?php } ?>
<?php include("parts/footer.php"); ?>