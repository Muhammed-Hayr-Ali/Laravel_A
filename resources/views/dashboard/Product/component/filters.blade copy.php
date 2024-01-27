<div id="filter_inputs" class="flex flex-row border-r-red-500 h-200 w-full"></div>

<!--
<div class="card mb-0" id="filter_inputs">
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="row">
                    <div class="col-lg col-sm-6 col-12">
                        <div class="form-group">


                            <form action="{{ route('filters') }}" method="POST">
                                @csrf



                                <select class="select" name="category">
                                    <option value="all">{{ __('productlist.all') }}</option>
                                    @php
                                        $categories = \App\Models\Category::all();
                                    @endphp
                                    @foreach ($categories as $category)
<option value="{{ $category->id }}"
                                            @if (request()->input('category') == $category->id) selected @endif>
                                            {{ __('category.' . $category->name) }}
                                        </option>
@endforeach
                                </select>






                        </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                        <div class="form-group">
                            <div class="flex flex-row items-center">
                                <label for="brand" class="pl-1">{{ __('general.Brand') }}:</label>




                                <select class="select" id="brand" name="brand">
                                    <option value="all">{{ __('productlist.all') }}</option>
                                    @php
                                        $brands = \App\Models\Brand::all();
                                    @endphp
                                    @foreach ($brands as $brand)
<option value="{{ $brand->id }}"
                                            @if (request()->input('brand') == $brand->id) selected @endif>
                                            {{ __('brand.' . $brand->name) }}
                                        </option>
@endforeach
                                </select>









                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                        <div class="form-group">

                            <div class="flex flex-row items-center">
                                <label for="unit" class="pl-1">{{ __('unit.Unit') }}:</label>
                                <select id="unit" class="select" name="unit">
                                    <option value="all">{{ __('productlist.all') }}</option>
                                    @php
                                        $units = \App\Models\Unit::all();
                                    @endphp
                                    @foreach ($units as $unit)
<option value="{{ $unit->id }}"
                                            @if (request()->input('unit') == $unit->id) selected @endif>
                                            {{ __('unit.' . $unit->name) }}</option>
                                        </option>
@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">


                    </div>

                    <div class="col-lg-1 col-sm-6 col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><img
                                    src="{{ asset('dashboard/assets/img/icons/search-whites.svg') }}"
                                    alt="img"></button>
                        </div>
                    </div>


                    </form>


                </div>
            </div>
        </div>
    </div>
</div> -->
