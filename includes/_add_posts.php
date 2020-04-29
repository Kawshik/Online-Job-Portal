<?php 

// ***********
// *
// *
// *	Todo: Change for to foreach loop
// *	Todo: Security and validation 
// *
// *
// ***********


/**
* HashMap 
*/
class HashMap 
{
	private $map = array();
	private $salt = "1234";
	
	private $containsCheck = true;

	public function add($value) {
		$this->map+=[hash('gost', $value.$this->salt)=>$value];				
	}

	public function contains($value) {
		$hash = hash('gost', $value.$this->salt);
		if(array_key_exists($hash, $this->map)){
			return true;
		} else {
			return false;
		}
	}

	public function print() {
		print_r($this->map);
	}
}


require '_db_connection.php';


if(isset($_POST["add_post"])){
	$title = $_POST["title"];
	$company = $_POST["company"];
	$skills = $_POST["skills"];
	$location = $_POST["location"];
	$description = $_POST["description"];
	$link = $_POST["link"];

	addPost($title,$description,$company,$skills,$location,$link,$conn);
	
	$skillsArr = getIndividualSkills($skills);
	
	$newSkills  = identifyNewSkills($skillsArr,$conn);
	
	addNewSkills($newSkills,$conn);

	addPostToSkillRelation($title,$description,$company,$skills,$location,$link,$skillsArr,$conn);
}

function addPost($title,$description,$company,$skills,$location,$link,$conn) {
	$sql = "INSERT INTO job_posts(job_title,job_description,job_company,job_skills,job_location,job_link) VALUES(?,?,?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo "error";
	} else {
		mysqli_stmt_bind_param($stmt,"ssssss",$title,$description,$company,$skills,$location,$link);
		mysqli_stmt_execute($stmt);
	}
} 

function addPostToSkillRelation($title,$description,$company,$skills,$location,$link,$skillsArr,$conn) {
	$postId = 0;

	$sql = "SELECT job_id FROM job_posts WHERE job_title=? AND job_description=? AND job_company=? AND job_skills=? AND job_location=? AND job_link=?";
	$stmt = mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo "error";
	} else {
		mysqli_stmt_bind_param($stmt,"ssssss",$title,$description,$company,$skills,$location,$link);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		$postId = $row["job_id"];		
	}

	$skillId = array();
	foreach ($skillsArr as $skill) {
		$sql = "SELECT skill_id FROM job_skills WHERE skill_name = ?";
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt,$sql)){
			echo "error";
		} else {
			mysqli_stmt_bind_param($stmt,"s",$skill);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			array_push($skillId,$row["skill_id"]);		
		}		
	}

	foreach ($skillId as $id) {
		$sql = "INSERT INTO post_to_skill(job_id,skill_id) VALUES(?,?)";
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt,$sql)){
			echo "error";
		} else {
			mysqli_stmt_bind_param($stmt,"ii",$postId,$id);
			mysqli_stmt_execute($stmt);
		}	
	}
}


function identifyNewSkills($skillsArr,$conn) {

	$newSkills = array();
	$storedSkillsMap = new HashMap();

	$sql = "SELECT skill_name FROM job_skills";
	$stmt = mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo "error";
	} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($row = mysqli_fetch_assoc($result)){
			$storedSkillsMap->add($row["skill_name"]);
		}
	}



	foreach ($skillsArr as $skill) {
		if(!$storedSkillsMap->contains($skill)){
			array_push($newSkills, $skill);
		}
	}
	return $newSkills;
}


function addNewSkills($newSkills,$conn) {
	foreach ($newSkills as $newSkill) {
		$sql = "INSERT INTO job_skills(skill_name) VALUES(?)";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			echo "error";
		} else {
			mysqli_stmt_bind_param($stmt,"s",$newSkill);
			mysqli_stmt_execute($stmt);
		}
	}
}


function getIndividualSkills($skills) {
	$seperatingCharMap = array(","=>0,"or"=>0,"/"=>0,"and"=>0);

	$skillArr = array();

	while (list($key, $val) = each($seperatingCharMap)) {
	  	if(strpos($skills,"$key"))
	    	$seperatingCharMap[$key] = 1;
	}

	reset($seperatingCharMap);
	
	//if string contains only one skill
	if($seperatingCharMap[","] == 0 && $seperatingCharMap["or"] == 0 && $seperatingCharMap["/"] == 0 && $seperatingCharMap["and"] == 0){
		$skillArr[0] = $skills;
		return $skillArr;
	}


	while(list($key,$value) = each($seperatingCharMap)){
		if($seperatingCharMap[$key] == 1){
			if(count($skillArr)>1){ 							//Todo: Change it to foreach loop  
				for ($i=0; $i < count($skillArr); $i++) { 
					$skill = $skillArr[$i];
					$moreSkillArr = array();
					if(strpos($skill, $key)!=null){
						$moreSkillArr = explode($key,$skill);
						array_splice($skillArr,$i,1,$moreSkillArr);
					}
				}
			} else {
				$skillArr = explode($key,$skills);
			}
		}
	}

	for ($i=0; $i < count($skillArr); $i++) {
		$skillArr[$i] = trim($skillArr[$i]);
	}

	return $skillArr;
}
?>