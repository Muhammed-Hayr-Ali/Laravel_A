@if (isset($user->profile) && $user->profile != null)
    <div class="col-12">
        <div class="product-Gallery">
            <div class="card">
                <a href="{{ asset($user->profile) }}" class="image-popup" data-lightbox="roadtrip">
                    <img src="{{ asset($user->profile) }}" class="card-img-top" alt=""></a>
                <div class="card-body">

                    <div class="row  align-items-center">
                        <button type="button" class="delete btn btn-danger" data-id="{{ $user->id }}"
                            data-name="{{ basename($user->profile) }}">x</button>
                        <p class="col card-text en">{{ basename($user->profile) }}</p>

                    </div>
                </div>
            </div>
        </div>
@endif
<script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>
