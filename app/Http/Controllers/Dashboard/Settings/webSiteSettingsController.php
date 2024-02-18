<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Carbon;
use App\Traits\ImageUploader;

class webSiteSettingsController extends Controller
{
    use ImageUploader;

    public function index()
    {
        $settings = Settings::first();
        if (!$settings) {
            $var = [
                'multilingual' => true,
                'defaultLanguage' => 'ar',
                'logo' => 'assets/website/img/logo.png',
                'black_logo' => 'assets/website/img/black_logo.png',
                'siteName' => 'Marketna',
                'big_title_1' => 'A New Way',
                'big_title_2' => 'To Start Business',
                'sm_title_1' => 'Discover the new world of shopping with our distinctive application',
                'sm_title_2' => 'Get an innovative shopping experience that combines comfort, variety and quality.',
                'button' => 'Download',
                'button_link' => '#',
                'three_blcok' => 'Smarter shopping starts here',
                'image_1' => 'assets/website/img/smart-protect-1.jpg',
                'title_1' => 'Communication',
                'sub_title_1' => 'Get the best offers and discounts',
                'image_2' => 'assets/website/img/smart-protect-2.jpg',
                'title_2' => 'Easy capture',
                'sub_title_2' => 'Receive your orders wherever you are',
                'image_3' => 'assets/website/img/smart-protect-3.jpg',
                'title_3' => 'Smart Scan',
                'sub_title_3' => 'Find your favorite products in one place',
                'feature_1_title' => 'Take a look inside',
                'feature_1_text_1' => 'Join our growing family',
                'feature_1_text_2' => 'benefit from a great opportunity to create a sustainable income',
                'button_1' => 'Learn More',
                'button_1_link' => '#',
                'feature_1_image' => 'assets/website/img/feature-1.png',
                'feature_2_title' => 'Safe and reliable',
                'feature_2_text_1' => 'Join us today and start your successful path!,',
                'feature_2_text_2' => 'We provide a stimulating work environment and comprehensive training to help you achieve success.',
                'button_2' => 'Learn More',
                'button_2_link' => '#',
                'feature_2_image' => 'assets/website/img/feature-2.png',
                'client_title' => 'Success Partners',
                'client_logo_1' => 'assets/website/img/client-1.png',
                'client_logo_2' => 'assets/website/img/client-2.png',
                'client_logo_3' => 'assets/website/img/client-3.png',
                'client_logo_4' => 'assets/website/img/client-4.png',
                'client_logo_5' => 'assets/website/img/client-5.png',
                'client_logo_6' => 'assets/website/img/client-6.png',
                'github' => '#',
                'twitter' => '#',
                'facebook' => '#',
                'android' => '#',
                'youtube' => '#',
                'year' => 2024,
            ];

            $settings = json_decode(json_encode($var), false);
        } else {
            $settings->visitors++;
            $settings->save();
            $settings['year'] = Carbon::now()->year;
        }

        return view('dashboard.Settings.website_settings', compact('settings'));
    }

    //

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $settings = Settings::findOrFail($request->id);

            if (!$settings) {
                return back()->with('error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the settings')]));
            }

            $input = $request->all();

            $multilingual = $request->input('multilingual', 0);
            if ($multilingual == 'on') {
                $input['multilingual'] = 1;
            } else {
                $input['multilingual'] = 0;
            }

            if ($request->logo) {
                $input['logo'] = $this->saveImage($request->logo, 'website_images', 'logo');
            }

            if ($request->black_logo) {
                $input['black_logo'] = $this->saveImage($request->black_logo, 'website_images', 'black_logo');
            }

            if ($request->image_1) {
                $input['image_1'] = $this->saveImage($request->image_1, 'website_images', 'image_1');
            }

            if ($request->image_2) {
                $input['image_2'] = $this->saveImage($request->image_2, 'website_images', 'image_2');
            }

            if ($request->image_3) {
                $input['image_3'] = $this->saveImage($request->image_3, 'website_images', 'image_3');
            }

            if ($request->feature_1_image) {
                $input['feature_1_image'] = $this->saveImage($request->feature_1_image, 'website_images', 'feature_1_image');
            }

            if ($request->feature_2_image) {
                $input['feature_2_image'] = $this->saveImage($request->feature_2_image, 'website_images', 'feature_2_image');
            }

            if ($request->client_logo_1) {
                $input['client_logo_1'] = $this->saveImage($request->client_logo_1, 'website_images', 'client_logo_1');
            }

            if ($request->client_logo_2) {
                $input['client_logo_2'] = $this->saveImage($request->client_logo_2, 'website_images', 'client_logo_2');
            }

            if ($request->client_logo_3) {
                $input['client_logo_3'] = $this->saveImage($request->client_logo_3, 'website_images', 'client_logo_3');
            }

            if ($request->client_logo_4) {
                $input['client_logo_4'] = $this->saveImage($request->client_logo_4, 'website_images', 'client_logo_4');
            }

            if ($request->client_logo_5) {
                $input['client_logo_5'] = $this->saveImage($request->client_logo_5, 'website_images', 'client_logo_5');
            }

            if ($request->client_logo_6) {
                $input['client_logo_6'] = $this->saveImage($request->client_logo_6, 'website_images', 'client_logo_6');
            }

            $settings->update($input);
            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ has been Updated successfully', ['_THIS_VAR_' => __('the setting')]));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
