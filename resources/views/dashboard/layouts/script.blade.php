    <script src="{{ asset('dashboard/assets/js/axios.1.6.5.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery.slimscroll.min.js') }}"></script>



    <script src="{{ asset('dashboard/assets/js/jquery.dataTables.min.js') }}"></script>


    <script src="{{ asset('dashboard/assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>



    <script src="{{ asset('dashboard/assets/js/script.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>

    @yield('script')
    @php
        $currentLocale = app()->getLocale();
        $position = $currentLocale == 'ar' ? 'left' : 'right';
    @endphp


    <script type="text/javascript" language="JavaScript">
        $slimScrolls.slimScroll({
            height: 'auto',
            width: '100%',
            size: '6px',
            color: '#FF9F43',
            opacity: 1,
            wheelStep: 10,
            touchScrollStep: 100,
            borderRadius: 0,
            railVisible: true,
            railColor: '#F1F1F1',
            railOpacity: 1.0,
            alwaysVisible: true,
            position: '{{ $position }}'
        });
    </script>
    <script type="text/javascript" language="JavaScript">
        if ($('.datanew').length > 0) {
            $('.datanew').DataTable({
                "order": [
                    [0, 'desc']
                ],

                "bFilter": true,
                "sDom": 'fBtlpi',
                'pagingType': 'numbers',
                "ordering": true,
                "language": {
                    emptyTable: "{{ __('dataTable.No data available in table') }}",
                    info: "{{ __('dataTable.Showing _START_ to _END_ of _TOTAL_ entries') }}",
                    infoEmpty: "{{ __('dataTable.Showing 0 to 0 of 0 entries') }}",
                    infoFiltered: "{{ __('dataTable.(filtered from _MAX_ total entries)') }}",
                    lengthMenu: "{{ __('dataTable.View per page: _MENU_') }}",
                    loadingRecords: "{{ __('dataTable.Loading...') }}",
                    processing: "{{ __('dataTable.processing') }}",
                    search: " ",
                    zeroRecords: "{{ __('dataTable.No matching records found') }}",

                    first: "{{ __('dataTable.First') }}",
                    last: "{{ __('dataTable.Last') }}",
                    Next: "{{ __('dataTable.Next') }}",
                    previous: "{{ __('dataTable.Previous') }}",

                    sortAscending: "{{ __('dataTable.: activate to sort column ascending') }}",
                    sortDescending: "{{ __('dataTable.: activate to sort column descending') }}",




                    sLengthMenu: '_MENU_',
                    searchPlaceholder: "{{ __('dataTable.Search...') }}",
                },
                initComplete: (settings, json) => {
                    $('.dataTables_filter').appendTo('#tableSearch');
                    $('.dataTables_filter').appendTo('.search-input');
                },
            });
        }

        if ($('.dataOnly').length > 0) {
            $('.dataOnly').DataTable({
                "order": [
                    [0, 'asc']
                ],
                "info": false,
                "paging": false,
                "bFilter": false,
                "ordering": true,

                "sDom": 'fBtlpi',
                'pagingType': 'numbers',
                "language": {
                    emptyTable: "{{ __('dataTable.No data available in table') }}",
                    info: "{{ __('dataTable.Showing _START_ to _END_ of _TOTAL_ entries') }}",
                    infoEmpty: "{{ __('dataTable.Showing 0 to 0 of 0 entries') }}",
                    infoFiltered: "{{ __('dataTable.(filtered from _MAX_ total entries)') }}",
                    lengthMenu: "{{ __('dataTable.View per page: _MENU_') }}",
                    loadingRecords: "{{ __('dataTable.Loading...') }}",
                    processing: "{{ __('dataTable.processing') }}",
                    search: " ",
                    zeroRecords: "{{ __('dataTable.No matching records found') }}",

                    first: "{{ __('dataTable.First') }}",
                    last: "{{ __('dataTable.Last') }}",
                    Next: "{{ __('dataTable.Next') }}",
                    previous: "{{ __('dataTable.Previous') }}",

                    sortAscending: "{{ __('dataTable.: activate to sort column ascending') }}",
                    sortDescending: "{{ __('dataTable.: activate to sort column descending') }}",




                    sLengthMenu: '_MENU_',
                    searchPlaceholder: "{{ __('dataTable.Search...') }}",
                },
                initComplete: (settings, json) => {
                    $('.dataTables_filter').appendTo('#tableSearch');
                    $('.dataTables_filter').appendTo('.search-input');
                },
            });
        }

        if ($('.dataSearch').length > 0) {
            $('.dataSearch').DataTable({
                "order": [
                    [0, 'asc']
                ],
                "info": false,
                "paging": false,
                "bFilter": true,
                "ordering": true,

                "sDom": 'fBtlpi',
                'pagingType': 'numbers',
                "language": {
                    emptyTable: "{{ __('dataTable.No data available in table') }}",
                    info: "{{ __('dataTable.Showing _START_ to _END_ of _TOTAL_ entries') }}",
                    infoEmpty: "{{ __('dataTable.Showing 0 to 0 of 0 entries') }}",
                    infoFiltered: "{{ __('dataTable.(filtered from _MAX_ total entries)') }}",
                    lengthMenu: "{{ __('dataTable.View per page: _MENU_') }}",
                    loadingRecords: "{{ __('dataTable.Loading...') }}",
                    processing: "{{ __('dataTable.processing') }}",
                    search: " ",
                    zeroRecords: "{{ __('dataTable.No matching records found') }}",

                    first: "{{ __('dataTable.First') }}",
                    last: "{{ __('dataTable.Last') }}",
                    Next: "{{ __('dataTable.Next') }}",
                    previous: "{{ __('dataTable.Previous') }}",

                    sortAscending: "{{ __('dataTable.: activate to sort column ascending') }}",
                    sortDescending: "{{ __('dataTable.: activate to sort column descending') }}",




                    sLengthMenu: '_MENU_',
                    searchPlaceholder: "{{ __('dataTable.Search...') }}",
                },
                initComplete: (settings, json) => {
                    $('.dataTables_filter').appendTo('#tableSearch');
                    $('.dataTables_filter').appendTo('.search-input');
                },
            });
        }
    </script>
