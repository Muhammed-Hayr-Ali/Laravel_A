<!-- Content here -->
<form id="form" action="{{ route('store') }}" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="name">{{ __('webSite.'.'Your Name') }}</label>
            <input class="form-control" id="name" name="name">
        </div>
        <div class="form-group col-md-6">
            <label for="email">{{ __('webSite.'.'Email') }}</label>
            <input class="form-control" id="email" name="email">
        </div>
    </div>
    <div class="form-group">
        <label for="message">{{ __('webSite.'.'Message') }}</label>
        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
    </div>
    <button id="submit" type="submit"
        class="h-10 flex justify-center items-center btn bg-primaryColor-500 font-weight-bold atlas-cta atlas-cta-wide cta-green my-3">
        <div id="text" class="block">{{ __('webSite.'.'Submit') }}</div>

        <svg id="Loading" class="hidden animate-spin h-5 w-5 mr-3 " viewBox="0 0 16 16"
            xmlns="http://www.w3.org/2000/svg" fill="none" class="hds-flight-icon--animation-loading">
            <g fill="#ffffff" fill-rule="evenodd" clip-rule="evenodd">
                <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2" />
                <path
                    d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z" />
            </g>
        </svg>
    </button>
</form>



<script>
    const form = document.getElementById('form');
    const submit = document.getElementById('submit');
    const text = document.getElementById('text');
    const loading = document.getElementById('Loading');

    toastr.options = {
        "positionClass": "toast-bottom-center",
        "timeOut": "5000",

    }

    $(document).ready(function() {


        $(form).on("submit", function(event) {
            event.preventDefault();

            text.style.display = "none";
            loading.style.display = "flex";
            submit.disabled = true;

            const formData = new FormData(form);

            axios.post(form.action, formData)
                .then(function(response) {
                    console.log(response.data.message);


                    text.style.display = "flex";
                    loading.style.display = "none";
                    submit.disabled = false;
                    var title = response.data.title
                    var message = response.data.message;

                    toastr.success(message)
                    form.reset();

                }).catch(function(error) {
                    var title = error.response.data.title
                    var message = error.response.data.message;
                    toastr.error(message)
                    text.style.display = "flex";
                    loading.style.display = "none";
                    submit.disabled = false;

                });
        });
    });
</script>



{{--
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





            }); --}}
