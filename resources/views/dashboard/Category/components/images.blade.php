@if (isset($category) && isset($category->image))
    <div class="col-12">
        <div class="product-list">
            <ul class="row">
                <li>
                    <div class="productviews">
                        <div class="productviewsimg">
                            <a href="{{ asset($category->image) }}" class="image-popup" data-lightbox="roadtrip"> <img
                                    src="{{ asset($category->image) }}" alt="img"></a>
                        </div>
                        <div class="productviewscontent">
                            <div class="productviewsname">
                                <h2>{{ $category->name }}</h2>
                            </div>
                            <a class="delete" data-id="{{ $category->id }}" data-name="{{ $category->name }}">x</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endif
<script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>
