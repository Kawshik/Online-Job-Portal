<?php 
	if(isset($_POST["search"])){
		search($_POST["search"]);
	}

	function search($skill)
	{
		require '_db_connection.php';

		$sql = "SELECT * FROM job_posts WHERE job_id IN 
		( SELECT job_id FROM post_to_skill WHERE skill_id IN 
		(SELECT skill_id FROM job_skills WHERE skill_name = ?)) ORDER BY published_at DESC";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Connection Error";
		} else {

			mysqli_stmt_bind_param($stmt,"s",$skill);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt);

			echo "<h2 class=\"banner-text\"> These Jobs are found</h2>";

			//check for empty results
			if($result->num_rows == null){
				echo "no job found";
			} else {
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
		}
	}
?>