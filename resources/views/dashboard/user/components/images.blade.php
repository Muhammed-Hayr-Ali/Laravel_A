@if (isset($user->profile) && $user->profile != null)
    <div class="image-group">
        <div class="col-12 border border-secondary-subtle rounded-2 text-center ">
            <a href="{{ asset($user->profile) }}" class="image-popup" data-lightbox="roadtrip">
                <img src="{{ asset($user->profile) }}" alt="">
            </a>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-auto m-0 p-0"><button class="delete btn btn-circle"
                            data-name="{{ basename($user->profile) }}"   data-id="{{ basename($user->id) }}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="col text-center">
                        <h7>{{ basename($user->profile) }}</h7>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>
