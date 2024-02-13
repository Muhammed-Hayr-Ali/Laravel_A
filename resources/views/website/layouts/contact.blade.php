    <div class="jumbotron jumbotron-fluid" id="contact"
        style="background-image: url({{ asset('website/img/contact-bk.jpg') }});">
        <div class="container my-5">
            <div class="row justify-content-center">
                {{-- <div class="col-md-6 text-white">
                    <h2 class="font-weight-bold">Contact Us</h2>
                    <p class="my-4">
                        Te iisque labitur eos, nec sale argumentum scribentur,
                        <br> augue disputando in vim. Erat fugit sit at, ius lorem.
                    </p>
                    <ul class="list-unstyled">
                        <li>Email : company_email@com</li>
                        <li>Phone : 361-688-5824</li>
                        <li>Address : 4826 White Avenue, Corpus Christi, Texas</li>
                    </ul>
                </div> --}}
                <div class="col-md-6">
                    <form id="form" action="{{ route('send') }}" method="POST">
                        @csrf
                        <div class="container" style="padding-bottom: 32px; text-align: center">
                            <h2 class="font-weight-bold">{{ __('Contact Us') }}</h2>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">{{ __('Your Name') }}</label>
                                <input type="name" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Email">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">{{ __('Message') }}</label>
                            <textarea class="form-control" id="message" rows="3" name="message" maxlength="255"></textarea>
                        </div>
                        <button id="submit" type="submit"
                            class="btn font-weight-bold atlas-cta atlas-cta-wide cta-green my-3">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {


            $('#form').on("submit", function(event) {
                event.preventDefault();




                const formData = new FormData(form);

                axios.post(form.action, formData)
                    .then(function(response) {
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

                    }).catch(function(error) {
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
    </script>
