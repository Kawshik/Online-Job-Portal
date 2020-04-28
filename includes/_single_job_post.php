<?php 
	require '_db_connection.php';

	echo "<h1 class=\"banner-text\">Hurry Apply Now...</h1>";

	$id = 0;
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		getSinglePost($id,$conn);		
	}


	function getSinglePost($id,$conn){
		$sql = "SELECT * FROM job_posts WHERE job_id=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Connection Error";
		} else {
			mysqli_stmt_bind_param($stmt,"i",$id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);	
			while($row = mysqli_fetch_assoc($result)){
			
?>

			<div class="post-container">
				<h3 class="title"><?php echo $row["job_title"]; ?></h3>
				<div class="row-2">
					<div class="company-name">
						<img src="assets/icons/business_center_icon.svg" alt="">
						<h5><?php echo $row["job_company"]; ?></h5>
					</div>
					<div class="post-date">
						<img src="assets/icons/event_icon.svg" alt="">
						<h5><?php echo substr($row["published_at"], 0,10); ?></h5>
					</div>
				</div>
				<div class="description">
					<span>Description</span>
					<h4><?php echo $row["job_description"]; ?></h4>
				</div>
				<div class="row-4">
					<div class="skills">
						<span>Skills</span>
						<h4><?php echo $row["job_skills"]; ?></h4>
					</div>
					<a href=<?php echo "./job_post.php?id=".$row["job_id"]; ?>>
						<div class="button apply-btn">
							<img src="assets/icons/send_icon.svg" alt="">
							<h4>Apply For This Job</h4>
						</div>
					</a>
				</div>
			</div>
<?php 

		}

	}
}

?>