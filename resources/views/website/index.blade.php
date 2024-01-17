<!DOCTYPE html>
{{-- <html dir="rtl"> --}}

<head>
    @include('website.layouts.head')
    <!-- Talwind -->
</head>

<body>

    <!-- lang -->

    @include('website.layouts.navbar')

    <!-- banner -->

    @include('website.layouts.banner')



    <!-- three-blcok -->
    @include('website.layouts.three_blcok')

    <!-- feature (skew background) -->
    <!-- feature (green background) -->
    @include('website.layouts.feature')


    <!-- price table -->
    {{-- <div class="container my-5 py-2" id="price-table">
        <h2 class="text-center font-weight-bold d-block mb-3">Check our pricing</h2>
        <div class="row">
            <div data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center py-4 mt-5">
                <h4 class="my-4">STARTUP</h4>
                <p class="font-weight-bold">$ <span class="display-2 font-weight-bold">0</span> / MO.</p>
                <ul class="list-unstyled">
                    <li>Up to 5 Documents</li>
                    <li>Up to 3 Reviews</li>
                    <li>5 team Members</li>
                    <li>Limited Support</li>
                </ul>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-ghost">Get Free</a>
            </div>
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center py-4 mt-5 rounded" id="price-table__premium">
                <h4 class="my-4">PREMIUM</h4>
                <p class="font-weight-bold">$ <span class="display-2 font-weight-bold">10</span> / MO.</p>
                <ul class="list-unstyled">
                    <li>Up to 15 Documents</li>
                    <li>Up to 10 Reviews</li>
                    <li>25 team Members</li>
                    <li>Limited Support</li>
                </ul>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-green">Get Free</a>
            </div>
            <div data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center py-4 mt-5">
                <h4 class="my-4">PROFESSIONAL</h4>
                <p class="font-weight-bold">$ <span class="display-2 font-weight-bold">30</span> / MO.</p>
                <ul class="list-unstyled">
                    <li>Unlimited Documents</li>
                    <li>Unlimited Reviews</li>
                    <li>Unlimited Members</li>
                    <li>Unlimited Support</li>
                </ul>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-ghost">Get Free</a>
            </div>
        </div>
    </div> --}}
    <!-- client -->
    @include('website.layouts.client')

    <!-- contact -->



    <div class=" jumbotron jumbotron-fluid" id="contact"
        style="background-image: url({{ asset('assets/website/img/contact-bk.jpg') }});">
        <div class="container my-5">
            <div class="flex justify-center flex-col items-center space-y-10 text-white">
                <h2 class="font-weight-bold">{{ __('Contact Us') }}</h2>
                <div dir="rtl" class="col-md-6">
                    @include('website.layouts.contact')
                </div>
            </div>
        </div>
    </div>

    <!-- copyright -->
    @include('website.layouts.copyright')


    @include('website.layouts.script')

</body>

</html>
