@if (isset($images) && count($images) > 0)
    <div class="col-12">
        <div class="product-list">
            <ul class="row">
                @foreach ($images as $key => $image)
                    <li>
                        <div id="{{ $image->id }}" class="productviews">
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
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>
