

<?php 
	

	if(isset($_POST["search"])){
		search($_POST["search"]);
	}

	function search($skill)
	{
		require '_db_connection.php';

		// $skill_name = "C";

		$sql = "SELECT * FROM job_posts WHERE job_id = ( SELECT job_id FROM post_to_skill WHERE skill_id = (SELECT skill_id FROM job_skills WHERE skill_name = ?))";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Connection Error";
		} else {

			mysqli_stmt_bind_param($stmt,"s",$skill);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt);

			// $row = mysqli_fetch_assoc($result);
			// var_dump($result->num_rows == 0);
			// if($result->num_rows == null){
			// 	echo "true";
			// } else {
			// 	echo "false";
			// }

			//check for empty results
			if($result->num_rows == null){
				echo "no job found";
			} else {
				while($row = mysqli_fetch_assoc($result)){
					// echo $row["job_title"];
					// echo "<br>";
					echo "<h2> These Jobs are found</h2>";
					
					echo "<div style=\"width:680px; background:#cccccc; white-space:pre-wrap;\">";
					echo "<h4>";
					echo $row["job_title"];
					echo "</h4>";
					echo $row["job_description"];
					echo "</div>";
				}
			}


			// var_dump($row);
		}
	}
?>