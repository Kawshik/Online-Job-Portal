<?php  
	session_start();
	require 'includes/_header.php';
	// if(!isset($_SESSION["username"]))
		// header("Location: login.html");
	// $_SESSION['username'] = "kawshik";
	// echo $_SESSION['username'];
?>
	<nav class="navbar">
		<div class="flex nav-row-1">
			<div class="logo"><a href="index.php"><img src="assets/logo/logo.svg" alt=""></a></div>
			<!-- <a href="add_post.php"><button class="button add-btn"><img src="assets/icons/add_icon.svg" alt="">&nbsp;&nbsp;&nbsp;Add a Job Post</button></a> -->
			<div class="auth-container">
				<a href="login.html" class="" id="login-btn">Log In</a>
				<a href="signup.html" class="" id="signup-btn">Sign Up</a>
				<div id="greeting"></div>
				<div class="logout-btn" id="logout-btn">Logout</div>
			</div>
			
		</div>
		<div class="flex nav-row-2">
			<form method="GET" action="index.php" class="flex">
				<div class="search-input">
					<img src="assets/icons/search_icon.svg" alt="">&nbsp;
					<input type="text" name="skill" placeholder="Enter a Job skill"></input>
				</div>
				<input type="submit" text="skills" value="Search By Skills" class="button search-btn"></input>
			</form>
			<form method="GET" action="index.php" class="flex">
				<div class="search-input">
					<img src="assets/icons/search_icon.svg" alt="">&nbsp;
					<input type="text" name="location" placeholder="Enter a Job Location"></input>
				</div>
				<input type="submit" text="location" value="Search By Location" class="button search-btn"></input>
			</form>
		</div>
	</nav>
	
	<div class="container">
		<div class="left-sidebar"><?php require 'includes/_left_sidebar.php'; ?></div>
		<div class="mid-container">
			<?php 
				if(isset($_GET["skill"]) && isset($_GET["location"])){			
					require 'includes/_search.php';
				} else if(isset($_GET["location"])){
					require 'includes/_search_by_location.php';
				} else if(isset($_GET["skill"])){
					require 'includes/_search_by_skill.php';
				}
				else {
					require 'includes/_job_posts.php';	
				}
			?>

		</div>
		
		<div class="right-sidebar">ADVERTISEMENTS</div>
	</div>
<?php  
	require 'includes/_footer.php';
?>