<?php

namespace App\Http\Controllers\Dashboard\Status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use App\Models\Category;
// use App\Models\Level;
// use App\Models\Image;
// use App\Models\Brand;
// use App\Models\Unit;
use App\Models\Status;
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
        $perPage = request()->get('perPage', 10);
        $status = Status::latest()->paginate($perPage);
        return view('dashboard.Status.index', compact('status'));
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

            return $this->sendResponses('Success', __('responses.The Status has been added successfully'));
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
            return back()->with('error', __('responses.Status not found'));
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
            return back()->with('error', __('responses.Status not found'));
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

            return $this->sendResponses('Success', __('responses.The Status has been Updated successfully'));
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
                return $this->sendError('Error', __('responses.Status not found'), 404);
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
                return $this->sendError('Error', __('responses.Status not found'), 404);
            }

            $name = __($status->name);
            $count = $status->products->count();

            if ($count > 0) {
                return $this->sendError('Error', __('responses.Status :name contains :count products that must be deleted or moved to another status in order to be able to delete the status', ['name' => $name, 'count' => $count]), 404);
            }

            $image = $status->image;
            $status->delete();
            if ($image) {
                $path = $image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            return $this->sendResponses('Success', __('responses.Status deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }
}
