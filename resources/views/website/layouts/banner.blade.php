<!-- banner -->
<div class="jumbotron jumbotron-fluid" id="banner"
    style="background-image: url({{ asset('assets/website/img/banner-bk.jpg') }});">
    <div class="container text-center text-md-left">
        <header>
            <div class="row justify-content-between">
                <div class="col-2">


                    <img src="{{ $settings->logo }}" alt="logo">


                </div>
                <div class="col-6 align-self-center text-right">


                    {{-- <a href="#" class="text-white lead">{{__("Get Started")}}</a> --}}


                </div>
            </div>
        </header>

        <h1 data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true"
            class="display-3 text-white font-weight-bold my-5 leading-tight">
            {{ __('webSite.' . $settings->big_title_1) }}
            <br>
            {{ __('webSite.' . $settings->big_title_2) }}
        </h1>
        <p data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true"
            class="lead text-white my-4">
            {{ __('webSite.' . $settings->sm_title_1) }}
            <br>
            {{ __('webSite.' . $settings->sm_title_2) }}
        </p>
        <a href="{{ $settings->button_link }}" data-aos="fade" data-aos-easing="linear" data-aos-duration="1000"
            data-aos-once="true"
            class="btn my-4 font-weight-bold atlas-cta cta-green">{{ __('webSite.' . $settings->button) }}</a>
        </a>
    </div>
</div>
