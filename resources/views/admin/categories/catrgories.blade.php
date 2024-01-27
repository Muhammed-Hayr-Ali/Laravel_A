<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="w-[13%] py-3 px-2  text-center">{{ __('id') }}</th>
            <th scope="col" class="w-[13%] py-3 px-2  text-center">{{ __('Category name') }}</th>
            <th scope="col" class="w-[20%] py-3 px-2  text-center">{{ __('Image') }}</th>
            <th scope="col" class="py-3 px-2  text-center">{{ __('description') }}</th>
            <th scope="col" class="w-[20%]  py-3 px-2  text-center">{{ __('Options') }}</th>
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
                <td class="py-4 px-2  text-center"><b>{{ $category->description }}</b></td>
                <td class="py-4 px-2  text-center">
                    <div class="w-full flex flex-row space-x-2">

                        <button value="{{ $category->id }}" type="button"
                            class="editeCategory btn btn-primary bg-primary-700  text-white"><i
                                class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <div></div>
                        <button value="{{ $category->id }}" data-name="{{ $category->name }}" type="button"
                            class="deleteCategory btn btn-primary bg-primary-700  text-white">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>


<script>
    // $(document).ready(function() {

    //     $('.deleteCategory').each(function() {
    //         var button = $(this);
    //         button.on('click', function() {
    //             $id = $(this).attr('value');
    //             alert('1');
    //             axios.post('{{ route('deleteCategory') }}', {
    //                 "_token": '{{ csrf_token() }}',
    //                 'id': $id
    //             }).then(function(response) {
    //                 var message = response.data.message;
    //                 toastr.success(message);
    //                 getAllCategories();

    //             }).catch(function(error) {
    //                 var title = error.response.data.title
    //                 var message = error.response.data.message;
    //                 toastr.error(message)

    //             });
    //         });

    //     });
    // });
</script>
