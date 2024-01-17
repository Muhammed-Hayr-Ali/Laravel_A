const showPassword = document.getElementById('showPassword');
const hidePassword = document.getElementById('hidePassword');
const password = document.getElementById('loginPassword');



showPassword.addEventListener("click", function(event) {
    event.preventDefault();
    showPassword.style.display = "none";
    password.type = "text";
    hidePassword.style.display = "block";
});

hidePassword.addEventListener("click", function(event) {
    event.preventDefault();
    hidePassword.style.display = "none";
    password.type = "password";
    showPassword.style.display = "block";
});







$(document).ready(function() {
    const loginForm = document.getElementById("loginForm");
    const loginError = document.getElementById("loginError");

    $("#loginForm").on("submit", function(event) {
        var submitButton = $("#submitButton");
        event.preventDefault();
        loginResetErrorMessages();

        const formData = new FormData(loginForm);
        axios.post(loginForm.action, formData)
            .then(function(response) {
                console.log(response.data);

                             

                window.location.href = "/";

            }).catch(function(error) {
                console.log(error);

                var errorMessage = error.response.data.message;
                switch (errorMessage) {
                    case 'Please enter your email address':
                    case 'Please enter a valid email':
                        loginUpdateAlerts('loginEmail', errorMessage, '#993333');
                        break;
                    case 'Please enter a password':
                    case 'The password must not be less than 8 characters':
                        loginUpdateAlerts('loginPassword', errorMessage, '#993333');
                        break;
                    default:
                        loginError.style.display = 'block';
                        loginError.innerText = errorMessage;
                        break;
                }





            });
    });
});


function loginResetErrorMessages() {
    loginUpdateAlerts('loginEmail', '', 'transparent');
    loginUpdateAlerts('loginPassword', '', 'transparent');
    loginError.style.display = 'none';
    loginError.innerText = '';

}



function loginUpdateAlerts(key, errorMessage, borderColor) {
    const errorDiv = document.getElementById(key)
    const errorText = document.getElementById(key + 'Alert');

    errorDiv.style.borderColor = borderColor;
    errorText.innerText = errorMessage;
}