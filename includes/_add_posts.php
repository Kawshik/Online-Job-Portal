<?php 

// ***********
// *
// *
// *	Todo: Clean up code
// *	Todo: Change for to foreach loop 
// *
// *
// ***********


/**
* HashMap 
*/
class HashMap 
{
	public $map = array();
	public $salt = "1234";
	
	function __construct()
	{
		
	}

	public function add($value)
	{
		$this->map+=[hash('gost', $value.$this->salt)=>$value];				
	}

	public function contains($value)
	{
		$hash = hash('gost', $value.$this->salt);
		if(array_key_exists($hash, $this->map)){
			return true;
		} else {
			return false;
		}
	}

	public function print()
	{
		// foreach ($this->map as $key => $value) {
		// 	echo $key . "=>" . $value;
		// }
		print_r($this->map);
	}
}


require '_db_connection.php';

if(isset($_POST["add_post"])){
	$title = $_POST["title"];
	$company = $_POST["company"];
	$skills = $_POST["skills"];
	$description = $_POST["description"];

	// addPost($title,$description,$company,$skills,$conn);
	// var_dump(getIndividualSkills($skills));
	$skillsArr = getIndividualSkills($skills);
	$newSkills  = identifyNewSkills($skillsArr,$conn);
	addNewSkills($newSkills,$conn);
}



function addPost($title,$description,$company,$skills,$conn) {
	$sql = "INSERT INTO job_posts(job_title,job_description,job_company,job_skills) VALUES(?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo "error";
	} else {
		mysqli_stmt_bind_param($stmt,"ssss",$title,$description,$company,$skills);
		mysqli_stmt_execute($stmt);
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
			// array_push($storedSkills, $row);
			$storedSkillsMap->add($row["skill_name"]);
		}
	}

	

	foreach ($skillsArr as $skill) {
		if(!$storedSkillsMap->contains($skill)){
			echo $skill;
			array_push($newSkills, $skill);
		}
	}
	// print_r($newSkills);
	// $storedSkillsClass->print();
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
	//array(0,0,0,0) = ",","/","or","and"
	// $seperatingCharArr = array(0,0,0,0);
	$seperatingCharMap = array(","=>0,"or"=>0,"/"=>0,"and"=>0);

	$skillArr = array();

	while (list($key, $val) = each($seperatingCharMap)) {
	  	if(strpos($skills,"$key"))
	    	$seperatingCharMap[$key] = 1;
	}

	reset($seperatingCharMap);
	// echo current($seperatingCharMap);
	// var_dump($seperatingCharMap);

	// if(strpos($skills, ",")!=null){
	// 	$seperatingCharArr[0] = 1;		
	// }
	// if(strpos($skills, "or")!=null){
	// 	$seperatingCharArr[1] = 1;		
	// }
	// if(strpos($skills, "/")!=null){
	// 	$seperatingCharArr[2] = 1;		
	// }
	// if(strpos($skills, "and")!=null){
	// 	$seperatingCharArr[3] = 1;		
	// }


	//if string contains only one skill
	if($seperatingCharMap[","] == 0 && $seperatingCharMap["or"] == 0 && $seperatingCharMap["/"] == 0 && $seperatingCharMap["and"] == 0){
		$skillArr[0] = $skills;
		// echo "return";
		return $skillArr;
	}






	//checking for " , "
	// if($seperatingCharArr[0]==1){
	// 	$skillArr = explode(',',$skills);
	// }

	// //ckecking for " or "
	// if($seperatingCharArr[1]==1){
	// 	if($skillArr>1){
	// 		for ($i=0; $i < count($skillArr); $i++) { 
	// 			$skill = $skillArr[$i];
	// 			$moreSkillArr = array();
	// 			if(strpos($skill, "or")!=null){
	// 				$moreSkillArr = explode('or',$skill);
	// 			}
	// 			array_splice($skillArr,$i,1,$moreSkillArr);
	// 		}
	// 	} else {
	// 		$skillArr = explode('or',$skills);		
	// 	}
	// }



	while(list($key,$value) = each($seperatingCharMap)){
		if($seperatingCharMap[$key] == 1){
			// echo $seperatingCharMap[$key];
			// echo $key;
			if(count($skillArr)>1){ 							//Todo: Change it to foreach loop  
				for ($i=0; $i < count($skillArr); $i++) { 
					$skill = $skillArr[$i];
					$moreSkillArr = array();
					if(strpos($skill, $key)!=null){
						$moreSkillArr = explode($key,$skill);
						array_splice($skillArr,$i,1,$moreSkillArr);
					}
					// print_r($moreSkillArr);
				}
			} else {

				$skillArr = explode($key,$skills);
				// print_r($skillArr);		
			}
		}
	}

	return $skillArr;
}

?>