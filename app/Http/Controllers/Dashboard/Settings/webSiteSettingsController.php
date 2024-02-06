<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Carbon;

class webSiteSettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::first();
        if (!$settings) {
            $var = [
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

        return view('dashboard.Settings.webSiteSettings', compact('settings'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
