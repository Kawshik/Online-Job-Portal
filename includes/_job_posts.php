<?php 

	require '_db_connection.php';

	$sql = "SELECT * FROM job_posts";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "Connection Error";
	} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);	

		while($row = mysqli_fetch_assoc($result)){
			echo "<h4>";
			echo $row["job_title"];
			echo "</h4>";
			echo "<div style=\"width:680px; background:#cccccc; white-space:pre-wrap;\">";
			echo $row["job_description"];
			echo "</div>";
		}

	}


