@extends('admin.layouts.master')
@section('title', trans('Categories'))
@section('content-header')

    <li>
        <a href="{{ route('categories') }}"
            class="text-neutral-500 transition duration-200 hover:text-neutral-600 hover:ease-in-out motion-reduce:transition-none dark:text-neutral-200">{{ __('Categories') }}</a>
    </li>
@endsection
@section('Categories', 'active')
@section('content')

    <div class="grid grid-cols-3 gap-4 pb-5">
        <div id="categories" class="col-span-2 ">
        </div>

        @include('admin.categories.createdCategory')
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function() {

            getAllCategories();

            function getAllCategories() {
                axios.get("{{ route('getAllCategories') }}", {
                    "_token": '{{ csrf_token() }}',
                }).then(function(response) {
                    $('#categories').html(response.data);
                    useInjectedElements();

                }).catch(function(error) {
                    var message = error.response.data.message;
                    toastr.error(message)
                })

            };



            $('#add').on('click', function() {

                $('#add').prop('disabled', true);
                $('#add').text("{{ __('Loading...') }}");

                const formData = new FormData($('#form')[0]);
                formData.append('_token', '{{ csrf_token() }}');

                axios.post('{{ route('createdCategory') }}', formData)
                    .then(function(response) {
                        $('#add').prop('disabled', false);
                        $('#add').text("{{ __('Add') }}");
                        var message = response.data.message;
                        toastr.success(message);
                        getAllCategories();
                        $('#form')[0].reset();



                    })
                    .catch(function(error) {
                        $('#add').prop('disabled', false);
                        $('#add').text("{{ __('Add') }}");
                        var message = error.response.data.message;
                        toastr.error(message);
                    });

            });

            function useInjectedElements() {

                $('.deleteCategory').each(function() {
                    var button = $(this);
                    button.on('click', function() {
                        $id = $(this).attr('value');
                        axios.post('{{ route('deleteCategory') }}', {
                            "_token": '{{ csrf_token() }}',
                            'id': $id
                        }).then(function(response) {
                            var message = response.data.message;
                            toastr.success(message);
                            getAllCategories();

                        }).catch(function(error) {
                            var title = error.response.data.title
                            var message = error.response.data.message;
                            toastr.error(message)

                        });
                    });

                });
            }
        });
    </script>
@endsection
