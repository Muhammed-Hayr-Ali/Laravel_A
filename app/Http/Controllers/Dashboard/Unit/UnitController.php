<?php

namespace App\Http\Controllers\Dashboard\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use App\Models\Category;
// use App\Models\Level;
// use App\Models\Image;
// use App\Models\Brand;
use App\Models\Unit;
//use App\Models\Status;
use App\Traits\ImageUploader;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use App\Exports\ExportProducts;
// use PDF;
// use Excel;

class UnitController extends Controller
{
    use ImageUploader;

    // INDEX OK!!
    public function index()
    {
        $perPage = request()->get('perPage', 10);
        $units = Unit::latest()->paginate($perPage);
        return view('dashboard.Unit.index', compact('units'));
    }

    // CREATE OK!!
    public function create()
    {
        return view('dashboard.Unit.create');
    }

    // STORE OK!!
    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'description' => 'required|max:255',
                    'image' => 'image|max:5000|mimes:jpeg,png,jpg',
                ],
                [
                    'name.required' => 'Enter the unit name',
                    'name.max' => 'Maximum length is 255 characters',
                    'description.required' => 'Enter the unit description',
                    'description.max' => 'Maximum length is 255 characters',
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
            if ($request->image) {
                $input['image'] = $this->saveImage($request->image, 'unit');
            }
            $unit = Unit::create($input);

            return $this->sendResponses('Success', __('responses.The Unit has been added successfully'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // EDIT OK!!
    public function edit(string $id)
    {
        $unit = Unit::find($id);
        if (!$unit) {
            return back()->with('error', __('responses.Unit not found'));
        }

        return view('dashboard.Unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $unit = Unit::findOrFail($id);
        if (!$unit) {
            return back()->with('error', __('responses.Unit not found'));
        }

        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'description' => 'required|max:255',
                    'image' => 'image|max:5000|mimes:jpeg,png,jpg',
                ],
                [
                    'name.required' => 'Enter the unit name',
                    'name.max' => 'Maximum length is 255 characters',
                    'description.required' => 'Enter the unit description',
                    'description.max' => 'Maximum length is 255 characters',
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

            if ($request->image) {
                $input['image'] = $this->saveImage($request->image, 'unit');
            }
            $unit->update($input);

            return $this->sendResponses('Success', __('responses.The Unit has been Updated successfully'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    //GetImages OK!!
    public function getImages(Request $request)
    {
        $id = $request->id;
        $unit = Unit::find($id);

        return view('dashboard.Unit.components.images', compact('unit'));
    }

    //Delete Image OK!!
    public function deleteImage(Request $request)
    {
        try {
            $id = $request->id;
            $unit = Unit::find($id);

            if (!$unit) {
                return $this->sendError('Error', __('responses.Unit not found'), 404);
            }

            $path = $unit->image;
            if (file_exists($path)) {
                unlink($path);
            }

            $unit->image = null;
            $unit->save();

            return $this->sendResponses('Success', __('responses.Image deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    //Delete OK!!
    public function destroy(string $id)
    {
        try {
            $unit = Unit::find($id);
            if (!$unit) {
                return $this->sendError('Error', __('responses.Unit not found'), 404);
            }

            $name = __($unit->name);
            $count = $unit->products->count();

            if ($count > 0) {
                return $this->sendError('Error', __('responses.Unit :name contains :count products that must be deleted or moved to another Unit in order to be able to delete the Unit', ['name' => $name, 'count' => $count]), 404);
            }

            $image = $unit->image;
            $unit->delete();
            if ($image) {
                $path = $image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            return $this->sendResponses('Success', __('responses.Unit deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }
}
