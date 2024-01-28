<div class="card mb-0" id="filter_inputs">
    <div class="card-body pb-0">
        <form action="{{ route('filters') }}" method="POST">
            @csrf

            <div class="w-full flex flex-row space-x-2 pb-4">

                <div></div>

                <div class="flex flex-row items-center">
                    <div class="pl-1">{{ __('productlist.Category') }}</div>
                    <div class="w-40">
                        <select class="select" name="category">
                            <option value="all">{{ __('category.All') }}</option>
                            @php
                                $categories = \App\Models\Category::all();
                            @endphp
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (request()->input('category') == $category->id) selected @endif>
                                    {{ __('category.' . $category->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-row items-center">
                    <div class="pl-1">{{ __('productlist.Brand') }}</div>
                    <div class="w-40">
                        <select class="select" id="brand" name="brand">
                            <option value="all">{{ __('productlist.All') }}</option>
                            @php
                                $brands = \App\Models\Brand::all();
                            @endphp
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @if (request()->input('brand') == $brand->id) selected @endif>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-row items-center">
                    <div class="pl-1">{{ __('productlist.Unit') }}</div>
                    <div class="w-40">
                        <select id="unit" class="select" name="unit">
                            <option value="all">{{ __('unit.All') }}</option>
                            @php
                                $units = \App\Models\Unit::all();
                            @endphp
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" @if (request()->input('unit') == $unit->id) selected @endif>
                                    {{ __('unit.' . $unit->name) }}</option>
                                </option>
                            @endforeach
                        </select>


                    </div>
                </div>
                <div class=" flex flex-auto justify-end">

                    <div class="">
                        <button type="submit" class="btn btn-primary"><img
                                src="{{ asset('dashboard/assets/img/icons/search-whites.svg') }}"
                                alt="img"></button>
                    </div>
                </div>




            </div>
        </form>
    </div>
</div>
