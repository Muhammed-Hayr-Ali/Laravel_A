@if (isset($level) && isset($level->image))
    <div class="col-12">
        <div class="product-list">
            <ul class="row">
                <li>
                    <div class="productviews">
                        <div class="productviewsimg">
                            <a href="{{ asset($level->image) }}" class="image-popup" data-lightbox="roadtrip"> <img
                                    src="{{ asset($level->image) }}" alt="img"></a>
                        </div>
                        <div class="productviewscontent">
                            <div class="productviewsname">
                                <h2>{{ $level->name }}</h2>
                            </div>
                            <a class="delete" data-id="{{ $level->id }}" data-name="{{ $level->name }}">x</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endif
<script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>
