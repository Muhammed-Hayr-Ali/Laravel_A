    <div class="jumbotron jumbotron-fluid feature" id="feature-first">
        <div class="container my-5">
            <div class="row justify-content-between text-center text-md-left">
                <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="col-md-6">
                    <h2 class="font-weight-bold">{{ __($settings['feature_1_title']) }}</h2>
                    <p class="my-4">{{ __($settings['feature_1_text_1']) }}
                        <br> {{ __($settings['feature_1_text_2']) }}
                    </p>
                    <a href="{{ $settings['link_1'] }}"
                        class="btn my-4 font-weight-bold atlas-cta cta-blue">{{ __($settings['button_1']) }}</a>
                </div>
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-once="true"
                    class="col-md-6 align-self-center">
                    <img src="{{ asset($settings['feature_1_image']) }}" alt="Take a look inside"
                        class="mx-auto d-block">
                </div>
            </div>
        </div>
    </div>
    <!-- feature (green background) -->
    <div class="jumbotron jumbotron-fluid feature" id="feature-last">
        <div class="container">
            <div class="row justify-content-between text-center text-md-left">
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-once="true" class="col-md-6 flex-md-last">
                    <h2 class="font-weight-bold">{{ __($settings['feature_2_title']) }}</h2>
                    <p class="my-4">
                        {{ __($settings['feature_2_text_1']) }}
                        <br>
                        {{ __($settings['feature_2_text_2']) }}
                    </p>
                    <a href="{{ $settings['link_2'] }}"
                        class="btn my-4 font-weight-bold atlas-cta cta-blue">{{ __($settings['button_2']) }}</a>
                </div>
                <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true"
                    class="col-md-6 align-self-center flex-md-first">
                    <img src="{{ asset($settings['feature_2_image']) }}" alt="Safe and reliable"
                        class="mx-auto d-block">
                </div>
            </div>
        </div>
    </div>
