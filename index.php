<?php  
	require 'includes/_header.php';
?>
	<h2>This is an Online Job Portal</h2>
	
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
	<?php  
		
	?>
<?php  
	require 'includes/_footer.php';
?>