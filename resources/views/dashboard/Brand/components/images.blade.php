@if (isset($brand->image) && $brand->image != null)
    <div class="col-12">
        <div class="product-Gallery">
            <ul class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card">
                        <a href="{{ asset($brand->image) }}" class="image-popup" data-lightbox="roadtrip">
                            <img src="{{ asset($brand->image) }}" class="card-img-top" alt=""></a>
                        <div class="card-body">

                            <div class="row  align-items-center">
                                <button type="button" class="delete btn btn-danger" data-id="{{ $brand->id }}"
                                    data-name="{{ basename($brand->image) }}">x</button>
                                <p class="col card-text ">{{ basename($brand->image) }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
@endif
<script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>
