@if (isset($status->image) && $status->image != null)
    <div class="col-12">
        <div class="product-Gallery">
            <ul class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card">
                        <a href="{{ asset($status->image) }}" class="image-popup" data-lightbox="roadtrip">
                            <img src="{{ asset($status->image) }}" class="card-img-top" alt=""></a>
                        <div class="card-body">

                            <div class="row  align-items-center">
                                <button type="button" class="delete btn btn-danger" data-id="{{ $status->id }}"
                                    data-name="{{ $status->name }}">x</button>
                                <p class="col card-text ">{{ $status->name }}</p>

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
