<?php

namespace App\Http\Controllers\Dashboard\Status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use App\Models\Status;
use App\Models\Status;
// use App\Models\Image;
// use App\Models\Brand;
// use App\Models\Unit;
// use App\Models\Status;
use App\Traits\ImageUploader;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use App\Exports\ExportProducts;
// use PDF;
// use Excel;

class StatusController extends Controller
{
    use ImageUploader;

    // INDEX OK!!
    public function index()
    {
        $statuss = Status::all();
        return view('dashboard.Status.index', compact('statuss'));
    }

    // CREATE OK!!
    public function create()
    {
        return view('dashboard.Status.create');
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
                    'image' => 'required|image|max:5000|mimes:jpeg,png,jpg',
                ],
                [
                    'name.required' => 'Enter the status name',
                    'name.max' => 'Maximum length is 255 characters',
                    'description.required' => 'Enter the status description',
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
            $input['image'] = $this->saveImage($request->image, 'status');
            $status = Status::create($input);

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ has been added successfully', ['_THIS_VAR_' => __('the status')]), 200);
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
        $status = Status::find($id);
        if (!$status) {
            return back()->with('error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the status')]));
        }

        return view('dashboard.Status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $status = Status::findOrFail($id);
        if (!$status) {
            return back()->with('error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the status')]));
        }

        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'description' => 'required|max:255',
                ],
                [
                    'name.required' => 'Enter the status name',
                    'name.max' => 'Maximum length is 255 characters',
                    'description.required' => 'Enter the status description',
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

            $image = $status->image;
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
                $input['image'] = $this->saveImage($request->image, 'status');
            }
            $status->update($input);

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ has been Updated successfully', ['_THIS_VAR_' => __('the status')]));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    //GetImages OK!!
    public function getImages(Request $request)
    {
        $id = $request->id;
        $status = Status::find($id);

        return view('dashboard.Status.components.images', compact('status'));
    }

    //Delete Image OK!!
    public function deleteImage(Request $request)
    {
        try {
            $id = $request->id;
            $status = Status::find($id);

            if (!$status) {
                return $this->sendError('Error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the status')]), 404);
            }

            $path = $status->image;
            if (file_exists($path)) {
                unlink($path);
            }

            $status->image = null;
            $status->save();

            return $this->sendResponses('Success', __('responses.Image deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    //Delete OK!!
    public function destroy(string $id)
    {
        try {
            $status = Status::find($id);
            if (!$status) {
                return $this->sendError('Error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the status')]), 404);
            }

            $name = __($status->name);
            $count = $status->products->count();

            if ($count > 0) {
                return $this->sendError('Error', __('responses.:_THIS_VAR_ :_KEY_ contains :_VALUE_ products that must be deleted or moved to another : _VAR_  in order to be able to delete :_THIS_VAR_', ['_THIS_VAR_' => __('the status'), '_VAR_' => __('status'), '_KEY_' => $name, '_VALUE_' => $count]), 404);
            }

            $image = $status->image;
            $status->delete();
            if ($image) {
                $path = $image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ deleted successfully', ['_THIS_VAR_' => __('the status')]), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }
}
