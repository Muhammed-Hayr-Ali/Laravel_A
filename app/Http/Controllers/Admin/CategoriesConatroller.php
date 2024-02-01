<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\ImageUploader;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Validator;

class CategoriesConatroller extends Controller
{
    use ImageUploader;
    use BaseResponse;

    public function index()
    {
        return view('admin.categories.index');
    }

    public function getAllCategories()
    {
        $categories = Category::all();
        return view('admin.categories.catrgories', compact('categories'));
    }

    public function createdCategory(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),

                [
                    'name' => 'required|max:16|regex:/^[\p{L}\s]+$/u',
                    'image' => 'required|image|mimes:png,jpg,jpeg|max:5120',
                ],
                [
                    'name.required' => 'Please enter Category name',
                    'name.max' => 'The Category name should not exceed 16 characters',
                    'name.regex' => 'The Category name should only contain Arabic and English letters and spaces',
                    'image.required' => 'Please choose a Category image picture',
                    'image.image' => 'Please select an image file',
                    'image.mimes' => 'The image must be a PNG, JPG, or JPEG file',
                    'image.max' => 'The image size should not exceed 5MB',
                ],
            );

            if ($validator->fails()) {
                return $this->sendError('Error', $validator->errors()->first());
            }

            $image = $this->saveImage($request, 'image', 'category');
            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image,
            ]);
            return $this->sendResponses('Success', 'Category created successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    public function deleteCategory(Request $request)
    {
        try {
            $id = $request->id;
            $category = Category::find($id);
            if (!$category) {
                return $this->sendError('Error', 'Category not found', 404);
            }
            $this->deleteImage($category->image);
            $category->delete();
            return $this->sendResponses('Success', 'Category deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }
}
//     public function created(Request $request)
//     {
//         return view('admin.categories.created');
//     }

//     public function categories()
//     {
//         $categories = Category::all();
//         return view('admin.categories.index', compact('categories'));
//     }

//     public function showCategories(Request $request)
//     {
//         try {
//             $id = $request->id;
//             $category = Category::find($id);
//             if (!$category) {
//                 return $this->sendError('Error', 'Category not found', 404);
//             }

//             return view('admin.categories.delete', compact('category'));
//         } catch (\Exception $e) {
//             return $this->sendError('Error', $e->getMessage(), 500);
//         }
//     }

//     public function showCategory(Request $request)
//     {
//         try {
//             $id = $request->id;
//             $category = Category::find($id);
//             if (!$category) {
//                 return $this->sendError('Error', 'Category not found', 404);
//             }

//             return view('admin.categories.delete', compact('category'));
//         } catch (\Exception $e) {
//             return $this->sendError('Error', $e->getMessage(), 500);
//         }
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function editCategory(Request $request)
//     {
//         try {
//             $id = $request->id;
//             $category = Category::find($id);
//             if (!$category) {
//                 return $this->sendError('Error', 'Category not found', 404);
//             }

//             return view('admin.categories.edit', compact('category'));
//         } catch (\Exception $e) {
//             return $this->sendError('Error', $e->getMessage(), 500);
//         }
//     }
//     /**
//      * Update the specified resource in storage.
//      */
//     public function updateCategory(Request $request)
//     {
//         try {
//             $validator = Validator::make(
//                 $request->all(),

//                 [
//                     'image' => 'image|mimes:png,jpg,jpeg|max:5120',
//                     'name' => 'max:16|regex:/^[\p{L}\s]+$/u',
//                 ],
//                 [
//                     'image.image' => 'Please select an image file',
//                     'image.mimes' => 'The image must be a PNG, JPG, or JPEG file',
//                     'image.max' => 'The image size should not exceed 5MB',
//                     'name.max' => 'The Category name should not exceed 16 characters',
//                     'name.regex' => 'The Category name should only contain Arabic and English letters and spaces',
//                 ],
//             );

//             if ($validator->fails()) {
//                 return $this->sendError('Error', $validator->errors()->first());
//             }

//             $id = $request->id;
//             $category = Category::find($id);
//             if (!$category) {
//                 return $this->sendError('Error', 'Category not found', 404);
//             }
//             $category->name = $request->name ?? $category->name;

//             if ($request->hasFile('image')) {
//                 $this->deleteImage($category->image);
//                 $category->image = $this->saveImage($request, 'image', 'category');
//             }

//             $category->save();
//             return $this->sendResponses('Success', 'Category updated successfully', 200);
//         } catch (\Exception $e) {
//             return $this->sendError('Error', $e->getMessage(), 500);
//         }
//     }
//     /**
//      * Remove the specified resource from storage.
//      */
//     public function deleteCategory(Request $request)
//     {
//         try {
//             $id = $request->id;
//             $category = Category::find($id);
//             if (!$category) {
//                 return $this->sendError('Error', 'Category not found', 404);
//             }
//             $category->delete();
//             return $this->sendResponses('Success', 'Category deleted successfully', 200);
//         } catch (\Exception $e) {
//             return $this->sendError('Error', $e->getMessage(), 500);
//         }
//     }
// }
