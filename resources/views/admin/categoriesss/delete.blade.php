@extends('admin.layouts.model_without_title')
@section('min-w', 'min-w-[40%]')
@section('max-h', 'max-h-[20vh] ')
@section('body')

    <div class="w-full h-full flex justify-center items-center">
        <h5>{{ __('Are you sure you want to delete the category') }} <b>{{ $category->name }}</b></h5>
    </div>
@endsection
@section('Close', trans('Cancel'))
@section('footer')
    <button value="{{ $category->id }}" id="deleteButton" class="btn btn-danger bg-danger-500 text-white">
        <i class="fa-solid fa-trash-can"></i>
        {{ __('Delete') }} </button>
@endsection
<script>
    $(document).ready(function() {
        var deleteButton = $('#deleteButton');
        deleteButton.on('click', function() {
            var id = $(this).val();
            $(this).text("{{ __('Loading...') }}");
            axios.post('{{ route('deleteCategory') }}', {
                "_token": '{{ csrf_token() }}',
                'id': id
            }).then(function(response) {
                $(this).text("{{ __('Done') }}");
                location.reload();
            }).catch(function(error) {
                var title = error.response.data.title
                var message = error.response.data.message;
                toastr.error(message)
            });
        });

    })
</script>
