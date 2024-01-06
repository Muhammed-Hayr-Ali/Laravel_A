$(document).ready(function() {
    const loginForm = document.getElementById("loginForm");
    const loginError = document.getElementById("loginError");

    $("#loginForm").on("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(loginForm);
        axios.post(loginForm.action, formData)
            .then(function(response) {
                console.log(response.data);
            }).catch(function(error) {
                console.log(error);

                var errorMessage = error.response.data.message;
                switch (errorMessage) {
                    case 'Please enter your email address':
                    case 'Please enter a valid email':
                        updateAlerts('loginEmail', errorMessage);
                        break;
                    case 'Please enter a password':
                    case 'The password must not be less than 8 characters':
                        updateAlerts('loginPassword', errorMessage);
                        break;
                    default:
                        loginError.style.display = 'block';
                        loginError.innerText = errorMessage;
                        break;
                }





            });
    });
});


function updateAlerts(key, errorMessage) {
    const errorDiv = document.getElementById(key)
    const errorText = document.getElementById(key+'Alert');

    errorDiv.style.borderColor = '#993333';
    errorText.innerText = errorMessage;
}
