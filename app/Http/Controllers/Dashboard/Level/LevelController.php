<?php

namespace App\Http\Controllers\Dashboard\Level;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Level;
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

class LevelController extends Controller
{
    use ImageUploader;

    // index OK!!
    public function index()
    {
        $perPage = request()->get('perPage', 10);
        $levels = Level::latest()->paginate($perPage);
        return view('dashboard.Level.index', compact('levels'));
    }

    // CREATE OK!!
    public function create()
    {
        return view('dashboard.Level.create');
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
                    'name.required' => 'Enter the level name',
                    'name.max' => 'Maximum length is 255 characters',
                    'description.required' => 'Enter the level description',
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
                $input['image'] = $this->saveImage($request->image, 'level');
            }
            $level = Level::create($input);

            return $this->sendResponses('Success', __('responses.The Level has been added successfully'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    // EDIT OK!!
    public function edit(string $id)
    {
        $level = Level::find($id);
        if (!$level) {
            return back()->with('error', __('responses.level not found'));
        }

        return view('dashboard.Level.edit', compact('level'));
    }

    // update  OK!!
    public function update(Request $request)
    {
        $id = $request->id;
        $level = Level::findOrFail($id);
        if (!$level) {
            return back()->with('error', __('responses.Level not found'));
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
                    'name.required' => 'Enter the level name',
                    'name.max' => 'Maximum length is 255 characters',
                    'description.required' => 'Enter the level description',
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
                $input['image'] = $this->saveImage($request->image, 'level');
            }
            $level->update($input);

            return $this->sendResponses('Success', __('responses.The Level has been Updated successfully'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    //GetImages OK!!
    public function getImages(Request $request)
    {
        $id = $request->id;
        $level = Level::find($id);

        return view('dashboard.Level.components.images', compact('level'));
    }

    // //Delete Image OK!!
    public function deleteImage(Request $request)
    {
        try {
            $id = $request->id;
            $level = Level::find($id);

            if (!$level) {
                return $this->sendError('Error', __('responses.Level not found'), 404);
            }

            $path = $level->image;
            if (file_exists($path)) {
                unlink($path);
            }

            $level->image = null;
            $level->save();

            return $this->sendResponses('Success', __('responses.Image deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    //Delete OK!!
    public function destroy(string $id)
    {
        try {
            $Level = Level::find($id);
            if (!$Level) {
                return $this->sendError('Error', __('responses.Level not found'), 404);
            }

            $name = __($Level->name);
            $count = $Level->products->count();

            if ($count > 0) {
                return $this->sendError('Error', __('responses.Level :name contains :count products that must be deleted or moved to another Level in order to be able to delete the Level', ['name' => $name, 'count' => $count]), 404);
            }

            $image = $Level->image;
            $Level->delete();
            if ($image) {
                $path = $image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            return $this->sendResponses('Success', __('responses.Level deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }
}
