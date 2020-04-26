	document.getElementById('login_form').addEventListener('submit', function (e) {
		e.preventDefault();

		var loginEndpoint = "http://localhost:8080/SABAS/api/login.php";

		var username = document.getElementById('username').value;
		var password = document.getElementById('password').value;

		var param = "{\"email\" : \"" + username + "\",\"password\" : \"" + password + "\"}" ; 
		// var param = "{\"email\" : \"test@test.com\",\"password\" : \"1234\"}"; 
	
		console.log(param);

		var xhr = new XMLHttpRequest();

		xhr.open('POST',loginEndpoint,true);
		
		xhr.setRequestHeader('Content-type', 'application/json');
		
		xhr.onload = function() {
			var data = JSON.parse(xhr.responseText);
			console.log(data);

			//check for status
			if(data.statusCode=="200"){
				sessionStorage.user = data.userName;
				window.location.replace("http://localhost:8080/Online%20Job%20Portal");
			} else {
				document.getElementById("error-msg").innerHTML = data.message;
			}
		}

		xhr.send(param);

	});