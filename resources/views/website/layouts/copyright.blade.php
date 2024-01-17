<div class="jumbotron jumbotron-fluid" id="copyright">
    <div class="container">
        <div class="flex flex-col items-center">

            <div class="flex flex-row justify-center text-white text-xl space-x-8 py-10">
                <div> <a href="{{ $settings->github }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-github hover:text-primaryColor-500" aria-hidden="true"></i>
                    </a></div>
                <div> <a href="{{ $settings->youtube }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-youtube-play  hover:text-primaryColor-500" aria-hidden="true"></i>
                    </a></div>
                <div> <a href="{{ $settings->android }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-android  hover:text-primaryColor-500" aria-hidden="true"></i>
                    </a></div>
                <div>
                    <a href="#"{{ $settings->facebook }} class="d-inline-block text-center ml-2">
                        <i class="fa fa-facebook  hover:text-primaryColor-500" aria-hidden="true"></i>
                    </a>
                </div>
                <div> <a href="{{ $settings->twitter }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-twitter  hover:text-primaryColor-500" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="text-white align-self-center text-center text-xs">

                © {{ $settings->year }} {{ $settings->siteName }}, Inc.

            </div>
        </div>
    </div>
</div>
