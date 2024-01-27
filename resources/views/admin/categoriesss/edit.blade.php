@extends('admin.layouts.model_with_title')
@section('title', trans('Edit Category'))
@section('min-w', 'min-w-[40%]')
@section('max-h', 'max-h-[48vh] ')
@section('body')
    <form id="form" class="w-full" enctype="multipart/form-data" action="{{ route('updateCategory') }}" method="POST">
        @csrf

        <div class="w-full flex flex-col items-center space-y-4">

            <img class="h-10 w-10" src="{{ asset($category->image) }}"alt="">
            <p>{{ $category->name }}</p>

            <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
            <div class="form-group w-full ">
                <label>{{ __('Category name') }}</label>

                <input
                    class="h-10 w-full  flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                    name="image" id="formFileLg" type="file" />

            </div>

            <div class="form-group w-full ">
                <label>{{ __('Category name') }}</label>
                <input value="{{ $category->name }}" type="text" class="h-10 w-full  form-control text-black"
                    id="name" name="name" placeholder="{{ __('Category name') }}">
            </div>
        </div>
    </form>


@endsection
@section('Close', trans('Cancel'))
@section('footer')

    <button id="Save" class="btn btn-primary bg-primary-700 text-white">
        <i class="fa-regular fa-floppy-disk"></i>
        {{ __('Save') }} </button>
@endsection
<script>
    $(document).ready(function() {

        var Save = $('#Save');
        var form = $('#form')[0];

        var id = '{{ $category->id }}';
        var token = '{{ csrf_token() }}';
        var route = '{{ route('updateCategory') }}';



        Save.click(function() {

            Save.prop('disabled', true);
            Save.text("{{ __('Loading...') }}");

            const formData = new FormData(form);
            formData.append('id', id);
            formData.append('_token', token);



            axios.post(route, formData)
                .then(function(response) {
                    location.reload();
                })
                .catch(function(error) {
                    Save.prop('disabled', false);
                    Save.text("{{ __('Save') }}");
                    var message = error.response.data.message;
                    toastr.error(message)


                });

        })



    })
</script>
