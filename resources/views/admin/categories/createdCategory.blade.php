    <div class="rounded-[4px] bg-slate-50 shadow-md">
        <div class="rounded-t-[4px]  py-3 px-3 bg-primary-700 text-white">
            <b>{{ __('Add New Category') }}</b>
        </div>
        <div class="rounded-b-[4px]  pb-4 px-1 ">

            <form id="form" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('Category Name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Category Name') }}">
                    </div>


                    <div class="form-group">
                        <label>{{ __('Category description') }}</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="{{ __('Category description') }}"></textarea>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputFile">{{ __('Category Icon') }}</label>
                        <input name="image"
                            class="form-control file:-mt-2 file:-mr-3 file:h-10 file:overflow-hidden file:rounded-none file:border-0 file:border-solid  file:bg-neutral-100"
                            type="file" id="formFile" />
                    </div>

                </div>


            </form>

            <div class="flex justify-center">
                <button id="add" class="btn btn-primary bg-primary-700">{{ __('Add') }}</button>
            </div>
        </div>

    </div>
