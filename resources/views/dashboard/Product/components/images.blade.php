@if (isset($images) && count($images) > 0)
    <div class="col-12">
        <div class="product-Gallery">
            <ul class="row">
                @foreach ($images as $key => $image)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card">
                            <a href="{{ asset($image->url) }}" class="image-popup" data-lightbox="roadtrip">
                                <img src="{{ asset($image->url) }}" class="card-img-top" alt=""></a>
                            <div class="card-body">

                                <div class="row  align-items-center">
                                    <button type="button" class="delete btn btn-danger" data-id="{{ $image->id }}"
                                        data-name="{{ $image->name }}">x</button>
                                    <p class="col card-text ">{{ $image->name }}</p>

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
{{-- <div id="{{ $image->id }}" class="productviews">
                            <div class="productviewsimg">
                                <a href="{{ asset($image->url) }}" class="image-popup" data-lightbox="roadtrip"> <img
                                        src="{{ asset($image->url) }}" alt="img"></a>
                            </div>
                            <div class="productviewscontent">
                                <div class="productviewsname">
                                    <h2>{{ $image->name }}</h2>
                                </div>
                                <a class="delete" data-id="{{ $image->id }}" data-name="{{ $image->name }}">x</a>
                            </div>
                        </div> --}}
