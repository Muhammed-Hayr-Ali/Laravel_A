@if (isset($images) && count($images) > 0)
    <div class="col-12">
        <div class="product-Gallery">
            <ul class="row">
                @foreach ($images as $key => $image)
                    <div class="col-12 col-sm-6 col-md-3 mb-3 ">
                        <div class="border border-secondary-subtle rounded-2 p-1 text-center">
                            <a href="{{ asset($image->url) }}" class="image-popup" data-lightbox="roadtrip">
                                <img class="itemImage" src="{{ asset($image->url) }}" alt="">
                            </a>
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-auto m-0 p-0"><button class="delete btn btn-circle"
                                            data-id="{{ $image->id }}" data-name="{{ basename($image->url) }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="col text-center">
                                        <h7>{{ basename($image->url) }}</h7>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </ul>
        </div>
    </div>
@endif
<script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>
