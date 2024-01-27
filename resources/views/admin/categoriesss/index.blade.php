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


    <div class="w-full py-3 flex justify-start">
        <button id="CreatedCategory" type="button" class="btn  btn-info bg-info-500 text-white">
            <i class="fa-solid fa-plus"></i>
            {{ __('Created Category') }} </button>
    </div>
    @if (@isset($categories) and count($categories) > 0)

        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="w-[13%] py-3 px-2  text-center">{{ __('id') }}</th>
                    <th scope="col" class="w-[13%] py-3 px-2  text-center">{{ __('Category name') }}</th>
                    <th scope="col" class="w-[20%] py-3 px-2  text-center">{{ __('Image') }}</th>
                    <th scope="col" class="w-[20%] py-3 px-2  text-center">{{ __('Products') }}</th>
                    <th scope="col" class=" py-3 px-2  text-center">{{ __('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="bg-white hover:bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-2  text-center"><b>{{ $category->id }}</b></td>
                        <td class="py-4 px-2  text-center"><b>{{ $category->name }}</b></td>
                        <td class="py-4 px-2  flex justify-center"><img class="h-10 w-10"
                                src="{{ asset($category->image) }}"alt="">
                        </td>
                        <td class="py-4 px-2  text-center"><b>{{ $category->products->count() }}</b></td>
                        <td class="py-4 px-2  text-center">
                            <div class="w-full flex flex-row space-x-2">

                                <button value="{{ $category->id }}" type="button"
                                    class="editeCategory w-full btn  btn-primary bg-primary-700 text-white"><i
                                        class="fa-regular fa-pen-to-square"></i>
                                    {{ __('Edite') }} </button>
                                <div></div>
                                <button value="{{ $category->id }}" data-name="{{ $category->name }}" type="button"
                                    class="deleteCategory btn btn-block btn-primary bg-primary-700  text-white">
                                    <i class="fa-solid fa-trash-can"></i>
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <div class="w-full h-[65vh] flex flex-col justify-center items-center space-y-3">
            <i class="fa-solid fa-cart-shopping text-6xl text-secondary-200"></i>
            <p class="text-secondary-700">{{ __('There are no categories yet') }}</p>
        </div>
    @endif







    <div class="modal fade " id="Modal" role="dialog"></div>



@endsection
@section('script')
    <script>
        $(document).ready(function() {

            var Modal = $('#Modal');
            var CreatedCategory = $('#CreatedCategory')
            var deleteCategory = $('.deleteCategory');
            var editeCategory = $('.editeCategory');






            CreatedCategory.on('click', function() {
                axios.get('{{ route('created') }}', {
                    "_token": '{{ csrf_token() }}',
                }).then(function(response) {
                    Modal.html(response.data);
                    Modal.modal('show');

                }).catch(function(error) {
                    var message = error.response.data.message;
                    toastr.error(message)

                });
            });





            deleteCategory.each(function() {
                var button = $(this);
                button.on('click', function() {
                    $id = $(this).attr('value');
                    axios.post('{{ route('showCategory') }}', {
                        "_token": '{{ csrf_token() }}',
                        'id': $id
                    }).then(function(response) {
                        console.log(response);
                        Modal.html(response.data);
                        Modal.modal('show');

                    }).catch(function(error) {
                        var title = error.response.data.title
                        var message = error.response.data.message;
                        toastr.error(message)

                    });
                });
            });




            editeCategory.each(function() {
                var button = $(this);
                button.on('click', function() {
                    $id = $(this).attr('value');
                    axios.post('{{ route('editCategory') }}', {
                        "_token": '{{ csrf_token() }}',
                        'id': $id
                    }).then(function(response) {
                        console.log(response);
                        Modal.html(response.data);
                        Modal.modal('show');

                    }).catch(function(error) {
                        var title = error.response.data.title
                        var message = error.response.data.message;
                        toastr.error(message)

                    });
                });
            });






        });
    </script>
@endsection
