
var loginButton = document.getElementById('loginButton');
var closeLogin = document.getElementById('closeLogin');
var login = document.getElementById('login');



loginButton.addEventListener('click', function() {
    login.style.display = 'flex';
});

closeLogin.addEventListener('click', function() {
    login.style.display = 'none';
});




var registerButton = document.getElementById('registerButton');
var closeRegister = document.getElementById('closeRegister');
var registr = document.getElementById('registr');



registerButton.addEventListener('click', function() {
    registr.style.display = 'flex';
});

closeRegister.addEventListener('click', function() {
    registr.style.display = 'none';
});




