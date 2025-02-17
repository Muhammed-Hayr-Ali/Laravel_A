<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class WebsiteController extends Controller
{
    use BaseResponse;

    public function index()
    {
        $settings = Settings::first();
        if (!$settings) {
            $var = [
                'multilingual' => 1,
                'defaultLanguage' => 'ar',
                'logo' => 'website/img/logo.png',
                'black_logo' => 'website/img/black_logo.png',
                'siteName' => 'Marketna',
                'big_title_1' => 'A New Way',
                'big_title_2' => 'To Start Business',
                'sm_title_1' => 'Discover the new world of shopping with our distinctive application',
                'sm_title_2' => 'Get an innovative shopping experience that combines comfort, variety and quality.',
                'button' => 'Download',
                'button_link' => '#',
                'three_blcok' => 'Smarter shopping starts here',
                'image_1' => 'website/img/smart-protect-1.png',
                'title_1' => 'Communication',
                'sub_title_1' => 'Get the best offers and discounts',
                'image_2' => 'website/img/smart-protect-2.png',
                'title_2' => 'Easy capture',
                'sub_title_2' => 'Receive your orders wherever you are',
                'image_3' => 'website/img/smart-protect-3.png',
                'title_3' => 'Smart Scan',
                'sub_title_3' => 'Find your favorite products in one place',
                'feature_1_title' => 'Take a look inside',
                'feature_1_text_1' => 'Join our growing family',
                'feature_1_text_2' => 'benefit from a great opportunity to create a sustainable income',
                'button_1' => 'Learn More',
                'button_1_link' => '#',
                'feature_1_image' => 'website/img/feature-1.png',
                'feature_2_title' => 'Safe and reliable',
                'feature_2_text_1' => 'Join us today and start your successful path!,',
                'feature_2_text_2' => 'We provide a stimulating work environment and comprehensive training to help you achieve success.',
                'button_2' => 'Learn More',
                'button_2_link' => '#',
                'feature_2_image' => 'website/img/feature-2.png',
                'client_title' => 'Success Partners',
                'client_logo_1' => 'website/img/client-1.png',
                'client_logo_2' => 'website/img/client-2.png',
                'client_logo_3' => 'website/img/client-3.png',
                'client_logo_4' => 'website/img/client-4.png',
                'client_logo_5' => 'website/img/client-5.png',
                'client_logo_6' => 'website/img/client-6.png',
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

         App::setLocale(session()->get('locale') ?? $settings['defaultLanguage']);

        return view('website.index', compact('settings'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'message' => 'required|min:20|max:255',
                ],
                [
                    'name.required' => 'Please enter your Name',
                    'name.max' => 'The length of the Name must not exceed 255 characters',
                    'email.required' => 'Please enter your email address',
                    'email.email' => 'Please enter a valid email',
                    'email.max' => 'The length of the email must not exceed 255 characters',
                    'message.required' => 'Please enter your Message',
                    'message.min' => 'The message length must be at least 20 characters',
                    'message.max' => 'The message length must not exceed 255 characters',
                ],
            );
            if ($validator->fails()) {
                return $this->sendError('Error', __('validators.' . $validator->errors()->first()), 400);
            }
            $input = $request->all();

            $user = User::where('role_id', '=', 1)->orwhere('role_id', '=', 2)->first();
            if (!$user) {
                return $this->sendError('Error', 'validators.Unable to find recipients', 500);
            }

            $input['user_id'] = $user->id;
            $newMessame = Message::create($input);

            if ($newMessame) {
                return $this->sendResponses('Success', __('validators.Send Message Successfully'));
            }
        } catch (\Exception $ex) {
            return $this->sendError('Error', 'An unknown error occurred while sending the message', 500);
        }
    }
}
