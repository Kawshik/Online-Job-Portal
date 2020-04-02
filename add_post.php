<?php  
	require 'includes/_header.php';
	require 'includes/_add_posts.php';
?>

<form method="POST" action="add_post.php">
	<input type="text" name="title" placeholder="title"></input>
	<input type="text" name="company" placeholder="company"></input>
	<input type="text" name="skills" placeholder="skills"></input>
	<textarea name="description" placeholder="description" cols="30" rows="10"></textarea>
	<input type="submit" name="add_post"></input>
</form>


<?php  
	require 'includes/_footer.php';
?>