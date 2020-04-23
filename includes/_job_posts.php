<?php 

	require '_db_connection.php';

	$sql = "SELECT * FROM job_posts ORDER BY published_at DESC";
	// $sql = "SELECT * FROM job_posts";
	$stmt = mysqli_stmt_init($conn);

	echo "<h1 class=\"banner-text\">Job's Available For You</h1>";

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "Connection Error";
	} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);	

		while($row = mysqli_fetch_assoc($result)){
			// echo "<h4>";
			// echo $row["job_title"];
			// echo "</h4>";
			// echo "<div style=\"width:680px; background:#cccccc; white-space:pre-wrap;\">";
			// echo $row["job_description"];
			// echo "</div>";
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
					<div class="button apply-btn">
						<img src="assets/icons/send_icon.svg" alt="">
						<h4>Apply For This Job</h4>
					</div>
				</div>
			</div>
<?php 

		}

	}

?>