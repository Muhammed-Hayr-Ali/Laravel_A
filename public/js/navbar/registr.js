$(document).ready(function() {
    const registrForm = document.getElementById("registrForm");
    const registrError = document.getElementById("registrError");

    $("#registrForm").on("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(registrForm);
        axios.post(registrForm.action, formData)
            .then(function(response) {
                console.log(response.data);
                location.reload();

            }).catch(function(error) {
                console.log(error);

                var errorMessage = error.response.data.message;

                switch (errorMessage) {
                    case 'Please choose a profile picture':
                    case 'Please select an image file':
                    case 'The image must be a PNG, JPG, or JPEG file':
                    case 'The image size should not exceed 5MB':
                        updateAlerts('registrProfile', errorMessage);
                        break;
                    case 'Please enter your name':
                    case 'The name should not exceed 60 characters':
                    case 'The name should only contain Arabic and English letters and spaces':
                        updateAlerts('registrName', errorMessage);
                        break;
                    case 'Please enter your email address':
                    case 'Please enter a valid email':
                    case 'This email address is already in use':
                        updateAlerts('registrEmail', errorMessage);
                        break;
                    case 'Please enter a password':
                    case 'The password must not be less than 8 characters':
                        updateAlerts('registrPassword', errorMessage);
                        break
                    case 'The password confirmation does not match':
                        updateAlerts('registrPassword', errorMessage);
                        document.getElementById('registrPasswordConfirmation').style
                            .borderColor = '#993333';
                        break;
                    default:
                        registrError.style.display = 'block';
                        registrError.innerText = errorMessage;
                        break;
                }





            });
    });
});



function updateAlerts(key, errorMessage) {
    const errorDiv = document.getElementById(key)
    const errorText = document.getElementById(key + 'Alert');

    errorDiv.style.borderColor = '#993333';
    errorText.innerText = errorMessage;
}
