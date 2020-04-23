<?php  
	require 'includes/_header.php';
?>
	<nav class="navbar">
		<div class="flex">
			<div class="logo"><a href="index.php"><img src="assets/logo/logo.svg" alt=""></a></div>
			<a href="add_post.php"><button class="button add-btn"><img src="assets/icons/add_icon.svg" alt="">&nbsp;&nbsp;&nbsp;Add a Job Post</button></a>
		</div>
		<div class="flex">
			<form method="POST" action="index.php" class="flex">
				<div class="search-input">
					<img src="assets/icons/search_icon.svg" alt="">&nbsp;
					<input type="text" name="skill" placeholder="Enter a Job skill"></input>
				</div>
				<input type="submit" text="skills" value="Search By Skills" class="button search-btn"></input>
			</form>
			<form method="POST" action="index.php" class="flex">
				<div class="search-input">
					<img src="assets/icons/search_icon.svg" alt="">&nbsp;
					<input type="text" name="location" placeholder="Enter a Job Location"></input>
				</div>
				<input type="submit" text="location" value="Search By Location" class="button search-btn"></input>
			</form>
		</div>
		

	</nav>

	<div class="container">
		<?php 
			if(isset($_POST["skill"])){			
				require 'includes/_search.php';
			} else if(isset($_POST["location"])){
				require 'includes/_search_by_location.php';
			} 
			else {
				require 'includes/_job_posts.php';	
			}
		?>

	</div>
	<?php  
		
	?>
<?php  
	require 'includes/_footer.php';
?>