$(document).ready(function () {
    $('#form').on("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(form);
        axios.post(form.action, formData)
            .then(function (response) {
                console.log(response.data.message);
                var title = response.data.title
                var message = response.data.message;
                form.reset();
                Swal.fire({
                    icon: "success",
                    text: message,
                    showConfirmButton: false,
                    timer: 2500
                });
            }).catch(function (error) {
                var title = error.response.data.title
                var message = error.response.data.message;
                Swal.fire({
                    icon: "warning",
                    text: message,
                    showConfirmButton: false,
                    timer: 2500
                });
            });
    });
});
