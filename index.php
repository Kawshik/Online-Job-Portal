<?php  
	require 'includes/_header.php';
?>
	<h2>This is an <a href="index.php"> Online Job Portal </a></h2>
	<a href="add_post.php"><button class=>Add a Job Post</button></a>

	<div class="container">
		<form method="POST" action="index.php">
			<input type="text" name="search" placeholder="Enter skill name"></input>
			<input type="submit" text="Search"></input>
		</form>
	

		<?php 
			if(isset($_POST["search"])){			
				require 'includes/_search.php';
			}  else {
				require 'includes/_job_posts.php';	
			}
		?>

	</div>
	<?php  
		
	?>
<?php  
	require 'includes/_footer.php';
?>