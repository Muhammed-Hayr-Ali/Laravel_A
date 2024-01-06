
const loginButton = document.getElementById("loginButton");
const registerButton = document.getElementById("registerButton");


const loginDiv = document.getElementById("login");
const registerDiv = document.getElementById("register");


const closeLogin = document.getElementById("closeLogin");
const closeRegister = document.getElementById("closeRegister");


loginButton.addEventListener("click", function() {
  loginDiv.style.display = "block";
});


registerButton.addEventListener("click", function() {
  registerDiv.style.display = "block";
});



closeLogin.addEventListener("click", function() {
  loginDiv.style.display = "none";
});


closeRegister.addEventListener("click", function() {
  registerDiv.style.display = "none";
});

