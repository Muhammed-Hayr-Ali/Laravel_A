        <div class="modal-dialog w-full @yield('min-w')">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@yield('title')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="p-2 h-screen @yield('max-h') overflow-auto scroll flex flex-col items-center">

                    @yield('body')

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default bg-default-500"
                        data-dismiss="modal">@yield('Close')</button>
                    <div class="flex flex-row">
                        @yield('footer')
                    </div>




                </div>
            </div>
        </div>
