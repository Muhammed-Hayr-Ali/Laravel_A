<?php

namespace App\Http\Controllers\Dashboard\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Level;
use App\Models\Status;
use App\Models\Unit;
use App\Traits\ImageUploader;

class DataController extends Controller
{
    use ImageUploader;

    // INDEX OK!!
    public function index(string $name)
    {
        switch ($name) {
            case 'Brand':
                $values = Brand::all();
                break;

            case 'Category':
                $values = Category::all();
                break;

            case 'Level':
                $values = Level::all();
                break;

            case 'Status':
                $values = Status::all();
                break;

            case 'Unit':
                $values = Unit::all();
                break;
        }
        return view('dashboard.data.index', compact('values', 'name'));
    }

    // CREATE OK!!
    public function create(string $name)
    {
        return view('dashboard.data.create', compact('name'));
    }

    // STORE OK!!
    public function store(string $name, Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'description' => 'required|max:255',
                    'image' => 'required|image|max:5000|mimes:jpeg,png,jpg',
                ],
                [
                    'name.required' => 'Enter the ' . $name . ' name',
                    'name.max' => 'Maximum length is 255 characters',
                    'description.required' => 'Enter the ' . $name . ' description',
                    'description.max' => 'Maximum length is 255 characters',
                    'image.required' => 'At least one image is required',
                    'image.image' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                    'image.max' => 'The selected image must not be larger than 5MB',
                    'image.mimes' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                ],
            );

            if ($validator->fails()) {
                $errorField = $validator->errors()->keys()[0];
                return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
            }

            $input = $request->all();

            $user_id = Auth::id();
            $input['user_id'] = $user_id;
            $input['image'] = $this->saveImage($request->image, $name);

            switch ($name) {
                case 'Brand':
                    $value = Brand::create($input);
                    $a = 'the brand';
                    break;

                case 'Category':
                    $value = Category::create($input);
                    $a = 'the category';
                    break;

                case 'Level':
                    $value = Level::create($input);
                    $a = 'the level';
                    break;

                case 'Status':
                    $value = Status::create($input);
                    $a = 'the status';
                    break;

                case 'Unit':
                    $value = Unit::create($input);
                    $a = 'the unit';
                    break;
            }

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ has been added successfully', ['_THIS_VAR_' => __($a)]), 200);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    // EDIT OK!!
    public function edit(string $name, string $id)
    {
        switch ($name) {
            case 'Brand':
                $value = Brand::find($id);
                $a = 'the brand';
                break;

            case 'Category':
                $value = Category::find($id);
                $a = 'the category';
                break;

            case 'Level':
                $value = Level::find($id);
                $a = 'the level';
                break;

            case 'Status':
                $value = Status::find($id);
                $a = 'the status';
                break;

            case 'Unit':
                $value = Unit::find($id);
                $a = 'the unit';
                break;
        }

        if (!$value) {
            return back()->with('error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __($a)]));
        }

        return view('dashboard.data.edit', compact('value', 'name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $name, string $id, Request $request)
    {
        try {
            switch ($name) {
                case 'Brand':
                    $value = Brand::findOrFail($id);
                    $a = 'the brand';
                    break;

                case 'Category':
                    $value = Category::findOrFail($id);
                    $a = 'the category';
                    break;

                case 'Level':
                    $value = Level::findOrFail($id);
                    $a = 'the level';
                    break;

                case 'Status':
                    $value = Status::findOrFail($id);
                    $a = 'the status';
                    break;

                case 'Unit':
                    $value = Unit::findOrFail($id);
                    $a = 'the unit';
                    break;
            }

            if (!$value) {
                return back()->with('error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __($a)]));
            }

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'description' => 'required|max:255',
                ],
                [
                    'name.required' => 'Enter the ' . $name . ' name',
                    'name.max' => 'Maximum length is 255 characters',
                    'description.required' => 'Enter the ' . $name . ' description',
                    'description.max' => 'Maximum length is 255 characters',
                ],
            );

            if ($validator->fails()) {
                $errorField = $validator->errors()->keys()[0];
                return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
            }

            $input = $request->all();

            $user_id = Auth::id();
            $input['user_id'] = $user_id;

            $image = $value->image;
            if ($image == null) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'image' => 'required|image|max:5000|mimes:jpeg,png,jpg',
                    ],
                    [
                        'image.required' => 'At least one image is required',
                        'image.image' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                        'image.max' => 'The selected image must not be larger than 5MB',
                        'image.mimes' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                    ],
                );

                if ($validator->fails()) {
                    $errorField = $validator->errors()->keys()[0];
                    return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
                }
            }
            if ($request->image) {
                $input['image'] = $this->saveImage($request->image, $name);
            }
            $value->update($input);

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ has been Updated successfully', ['_THIS_VAR_' => __($a)]));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    //GetImages OK!!
    public function getImage(string $name, string $id)
    {
        switch ($name) {
            case 'Brand':
                $value = Brand::find($id);
                break;

            case 'Category':
                $value = Category::find($id);
                break;

            case 'Level':
                $value = Level::find($id);
                break;

            case 'Status':
                $value = Status::find($id);
                break;

            case 'Unit':
                $value = Unit::find($id);
                break;
        }
        return view('dashboard.data.components.images', compact('value'));
    }

    //Delete Image OK!!
    public function deleteImage(string $name, string $id)
    {
        try {
            switch ($name) {
                case 'Brand':
                    $value = Brand::find($id);
                    $a = 'the brand';
                    break;

                case 'Category':
                    $value = Category::find($id);
                    $a = 'the category';
                    break;

                case 'Level':
                    $value = Level::find($id);
                    $a = 'the level';
                    break;

                case 'Status':
                    $value = Status::find($id);
                    $a = 'the status';
                    break;

                case 'Unit':
                    $value = Unit::find($id);
                    $a = 'the unit';
                    break;
            }

            if (!$value) {
                return $this->sendError('Error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __($a)]), 404);
            }

            $path = $value->image;
            if (file_exists($path)) {
                unlink($path);
            }

            $value->image = null;
            $value->save();

            return $this->sendResponses('Success', __('responses.Image deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    //Delete OK!!
    public function destroy(string $name, string $id)
    {
        try {
            switch ($name) {
                case 'Brand':
                    $value = Brand::find($id);
                    $a = 'the brand';
                    $b = 'brand';
                    break;

                case 'Category':
                    $value = Category::find($id);
                    $a = 'the category';
                    $b = 'category';
                    break;

                case 'Level':
                    $value = Level::find($id);
                    $a = 'the level';
                    $b = 'level';
                    break;

                case 'Status':
                    $value = Status::find($id);
                    $a = 'the status';
                    $b = 'status';
                    break;

                case 'Unit':
                    $value = Unit::find($id);
                    $a = 'the unit';
                    $b = 'unit';
                    break;
            }

            $name = __($value->name);
            $count = $value->products->count();

            if ($count > 0) {
                return $this->sendError('Error', __('responses.:_THIS_VAR_ :_KEY_ contains :_VALUE_ products that must be deleted or moved to another : _VAR_  in order to be able to delete :_THIS_VAR_', ['_THIS_VAR_' => __($a), '_VAR_' => __($b), '_KEY_' => $name, '_VALUE_' => $count]), 404);
            }

            $image = $value->image;
            $value->delete();
            if ($image) {
                $path = $image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ deleted successfully', ['_THIS_VAR_' => __($a)]), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }
}
