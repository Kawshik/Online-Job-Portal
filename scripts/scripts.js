if(sessionStorage.user!=null){
	// console.log(sessionStorage.user);
	var greeting = document.getElementById('greeting');
	greeting.innerHTML = "Welcome, " + sessionStorage.user;
	// window.location.replace("http://localhost:8080/Online%20Job%20Portal/");
	document.getElementById("signup-btn").classList.add("hide");
	document.getElementById("login-btn").classList.add("hide");
} else {
	document.getElementById("logout-btn").classList.add("hide");
	// window.location.replace("http://localhost:8080/Online%20Job%20Portal/login.html");
}

document.getElementById("logout-btn").addEventListener('click', function (){
	sessionStorage.clear();
	window.location.replace("http://localhost:8080/Online%20Job%20Portal");
	console.log("hello");
}, false);

