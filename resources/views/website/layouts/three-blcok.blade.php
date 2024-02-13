    <div class="container my-5 py-2">
        <h2 class="text-center font-weight-bold my-5">{{ __($settings['three_blcok']) }}</h2>
        <div class="row">
            <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center">
                <img src="{{ asset($settings['image_1']) }}" alt="Anti-spam" class="mx-auto">
                <h4>{{ __($settings['title_1']) }}</h4>
                <p>{{ __($settings['sub_title_1']) }}</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center">
                <img src="{{ asset($settings['image_2']) }}" alt="Phishing Detect" class="mx-auto">
                <h4>{{ __($settings['title_2']) }}</h4>
                <p>{{ __($settings['sub_title_2']) }}</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center">
                <img src="{{ asset($settings['image_3']) }}" alt="Smart Scan" class="mx-auto">
                <h4>{{ __($settings['title_3']) }}</h4>
                <p>{{ __($settings['sub_title_3']) }}</p>
            </div>
        </div>
    </div>
