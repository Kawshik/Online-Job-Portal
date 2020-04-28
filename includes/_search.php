<?php 
	if(isset($_GET["skill"]) && isset($_GET["location"])){
		searchBySkill($_GET["skill"],$_GET["location"]);
	}

	function searchBySkill($skill,$location)
	{
		require '_db_connection.php';

		$sql = "SELECT * FROM job_posts WHERE job_id IN 
		( SELECT job_id FROM post_to_skill WHERE skill_id IN 
		(SELECT skill_id FROM job_skills WHERE skill_name = ?)) AND job_location = ? ORDER BY published_at DESC";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Connection Error";
		} else {

			mysqli_stmt_bind_param($stmt,"ss",$skill,$location);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt);

			// echo "<h2 class=\"banner-text\"> These Jobs are found for skill</h2>";

			//check for empty results
			if($result->num_rows == null){
				// echo "no job found";
				?>

				<div class="post-container">
					<h3 class="title">no job found for skill <?php echo $skill ?> and location <?php echo $location ?></h3>
				</div>

			<?php 
			} else {
				echo "<h2 class=\"banner-text\"> These Jobs are found for skill " . $skill . " and location " . $location . "</h2>";
				while($row = mysqli_fetch_assoc($result)){		
					// echo "<div style=\"width:680px; background:#cccccc; white-space:pre-wrap;\">";
					// echo "<h4>";
					// echo $row["job_title"];
					// echo "</h4>";
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
						<h4><?php echo substr($row["job_description"],0,600) . "   ....";?></h4>
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
	}
?>

