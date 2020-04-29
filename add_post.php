<?php  
	require 'includes/_header.php';
	require 'includes/_add_posts.php';
?>
	<nav class="navbar ">
		<div class="flex nav-row-1">
			<div class="logo"><a href="index.php"><img src="assets/logo/logo1.svg" alt=""></a></div>
			<!-- <a href="add_post.php"><button class="button add-btn"><img src="assets/icons/add_icon.svg" alt="">&nbsp;&nbsp;&nbsp;Add a Job Post</button></a> -->
			<div class="auth-container">
				<a href="login.html" class="" id="login-btn">Log In</a>
				<a href="signup.html" class="" id="signup-btn">Sign Up</a>
				<div id="greeting"></div>
				<div class="logout-btn" id="logout-btn">Logout</div>
			</div>
		</div>
	</nav>
	<div class="container" style="padding-top: 100px;flex-direction: column; justify-content: center;align-items: center;">
		<div class="form-banner" style="text-align: center;padding-left: 0px;"><h1>Fill in the details...</h1></div>
		<div class="row-1">
			<form method="POST" action="add_post.php" class="flex-row">
				<div class="row-1-1">
					<input type="text" name="title" placeholder="Enter job title"></input>
					<input type="text" name="company" placeholder="Enter your company's name"></input>
				</div>
				<div class="row-1-1">
					<input type="text" name="skills" placeholder="Enter skills required"></input>
					<input type="text" name="location" placeholder="Enter job location"></input>
				</div>
				<input type="text" name="link" placeholder="Enter job link" class="skills"></input>
				<textarea id="description" name="description" placeholder="Giva a brief description of the job" cols="30" rows="10"></textarea><br>
				<input type="submit" name="add_post" class="button submit-btn"></input>
			</form>

			<!-- <img src="assets/illustrations/form_illus.svg" alt=""> -->
		</div>
	</div>
	<br>

<script src='https://cdn.tiny.cloud/1/wm7knm6hb2wdc0icmog712msyiaze8y6qlk53dkpciib1p6y/tinymce/5/tinymce.min.js' referrerpolicy="origin">
  </script>
<script>
	tinymce.init({
		selector:'#description',
		plugins: "advlist importcss paste help hr fullscreen link lists autoresize",
		content_css: "css/styles.css",
		importcss_append: true,
		autoresize_bottom_margin: 50,
		autoresize_on_init: true,
		autoresize_overflow_padding: 10,
		max_height: 300,
		min_height: 350
	});
</script>
<?php  
	require 'includes/_footer.php';
?>