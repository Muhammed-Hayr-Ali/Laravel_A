    <div class="container my-5 py-2">
        <h2 class="text-center font-weight-bold my-5">
            {{ __('webSite.' . $settings->three_blcok) }}
        </h2>
        <div class="row">
            <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center space-y-1">
                <img src="{{ $settings->image_1 }}" alt="Anti-spam" class="mx-auto">
                <h4 class="font-bold">{{ __('webSite.' . $settings->title_1) }}</h4>
                <p>{{ __('webSite.' . $settings->sub_title_1) }}</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center space-y-1">
                <img src="{{ $settings->image_2 }}" alt="Anti-spam" class="mx-auto">
                <h4 class="font-bold">{{ __('webSite.' . $settings->title_2) }}</h4>
                <p>{{ __('webSite.' . $settings->sub_title_2) }}</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center space-y-1">
                <img src="{{ asset('assets/website/img/smart-protect-3.jpg') }}" alt="Anti-spam" class="mx-auto">
                <h4 class="font-bold">{{ __('webSite.' . $settings->title_3) }}</h4>
                <p>{{ __('webSite.' . $settings->sub_title_3) }}</p>
            </div>
        </div>
    </div>
