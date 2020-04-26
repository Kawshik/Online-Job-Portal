<?php  
	require 'includes/_header.php';
	require 'includes/_add_posts.php';
?>
	<nav class="navbar ">
		<div class="flex nav-row-1">
			<div class="logo"><a href="index.php"><img src="assets/logo/logo.svg" alt=""></a></div>
			<a href="add_post.php"><button class="button add-btn"><img src="assets/icons/add_icon.svg" alt="">&nbsp;&nbsp;&nbsp;Add a Job Post</button></a>
		</div>
	</nav>
	<div class="container" style="padding-top: 100px;">
		<div class="form-banner"><h1>Fill in the details...</h1></div>
		<div class="row-1">
			<form method="POST" action="add_post.php" class="flex-row">
				<div class="row-1-1">
					<input type="text" name="title" placeholder="Enter job title"></input>
					<input type="text" name="company" placeholder="Enter your company's name"></input>
				</div>
				<div class="row-1-1">
					<input type="text" name="skills" placeholder="Enter skills required" class="skills"></input>
					<input type="text" name="location" placeholder="Enter job location" class="skills"></input>
				</div>
				<textarea name="description" placeholder="Giva a brief description of the job" cols="30" rows="10"></textarea>
				<input type="submit" name="add_post" class="button submit-btn"></input>
			</form>

			<img src="assets/illustrations/form_illus.svg" alt="">
		</div>
	</div>

<?php  
	require 'includes/_footer.php';
?>