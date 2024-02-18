@extends('dashboard.layouts.master')
@section('title', trans('setting.Website settings'))
@section('Website Settings', 'active')
@section('head')
@endsection
@section('content')


    {{-- page-header --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('setting.Website settings') }}</h4>
            <h6>{{ __('setting.Full control over the website') }}</h6>
        </div>
    </div>



<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{ __('setting.When you use custom text it is not translated using multilingual') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <div class="card">
        <div class="card-body">








            <form id="form" action="{{ route('/updateWebSite') }}" method="POST" enctype="multipart/form-data"
                id="form">
                @csrf


                <ul class="nav nav-tabs justify-content-center " id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="General-tab" data-bs-toggle="tab"
                            data-bs-target="#General-tab-pane" type="button" role="tab"
                            aria-controls="General-tab-pane" aria-selected="true">
                            <p class="tabTitle">{{ __('setting.General') }}</p>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Three_Blcok-tab" data-bs-toggle="tab"
                            data-bs-target="#Three_Blcok-tab-pane" type="button" role="tab"
                            aria-controls="Three_Blcok-tab-pane" aria-selected="false">
                            <p class="tabTitle">{{ __('setting.Three Blcok') }}</p>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Feature-tab" data-bs-toggle="tab" data-bs-target="#Feature-tab-pane"
                            type="button" role="tab" aria-controls="Feature-tab-pane" aria-selected="false">
                            <p class="tabTitle">{{ __('setting.Feature') }}</p>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="client-tab" data-bs-toggle="tab" data-bs-target="#client-tab-pane"
                            type="button" role="tab" aria-controls="client-tab-pane" aria-selected="false">
                            <p class="tabTitle">{{ __('setting.Client') }}</p>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Social_Media-tab" data-bs-toggle="tab"
                            data-bs-target="#Social_Media-tab-pane" type="button" role="tab"
                            aria-controls="Social_Media-tab-pane" aria-selected="false">
                            <p class="tabTitle">{{ __('setting.Social Media') }}</p>
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- banner -->
                    <div class="tab-pane fade show active" id="General-tab-pane" role="tabpanel"
                        aria-labelledby="General-tab" tabindex="0">





                        <div class="row">
                            <div class="col-sm-8 col-12">
                                <!-- Site name -->
                                <div class="row align-items-center ">


                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Default language') }}</label>
                                            <select class="select" name="defaultLanguage" id="defaultLanguage">
                                                <option @if ($settings['defaultLanguage'] == 'ar') selected @endif value="ar">
                                                    عربي</option>
                                                <option @if ($settings['defaultLanguage'] == 'en') selected @endif value="en">
                                                    English</option>
                                                <option @if ($settings['defaultLanguage'] == 'tr') selected @endif value="tr">
                                                    Türkçe</option>
                                                <option @if ($settings['defaultLanguage'] == 'ku') selected @endif value="ku">
                                                    kurdî</option>

                                            </select>
                                            <p id="defaultLangugeError"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="switch-group align-items-center   ">
                                            <div class="row justify-content-between ">
                                                <div class="col-auto  ">
                                                    <label>{{ __('setting.multilingual') }}</label>
                                                </div>
                                                <div class="col-auto ">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckDefault" name="multilingual"
                                                            @if (old('multilingual', $settings['multilingual'] == true)) checked @endif>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Web Site Name') }}</label>
                                            <input type="text" name="siteName" id="siteName"
                                                value="{{ old('siteName', $settings['siteName']) }}">
                                            <p id="siteNameError"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Big Title -->
                                <p class="subsectionTitle">{{ __('setting.Big Title') }}</p>
                                </p>
                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Big Title 1') }}</label>
                                            <input type="text" name="big_title_1" id="big_title_1"
                                                value="{{ old('big_title_1', $settings['big_title_1']) }}">
                                            <p id="big_title_1Error"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Big Title 2') }}</label>
                                            <input type="text" name="big_title_2" id="big_title_2"
                                                value="{{ old('big_title_2', $settings['big_title_2']) }}">
                                            <p id="big_title_2Error"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Small Title -->
                                <p class="subsectionTitle">{{ __('setting.Small Title') }}</p>
                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Small Title 1') }}</label>
                                            <input type="text" name="sm_title_1" id="sm_title_1"
                                                value="{{ old('sm_title_1', $settings['sm_title_1']) }}">
                                            <p id="sm_title_1Error"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Small Title 2') }}</label>
                                            <input type="text" name="sm_title_2" id="sm_title_2"
                                                value="{{ old('sm_title_2', $settings['sm_title_2']) }}">
                                            <p id="sm_title_2Error"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button -->
                                <p class="subsectionTitle">{{ __('setting.Button') }}</p>
                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Button Text') }}</label>
                                            <input type="text" name="button" id="button"
                                                value="{{ old('button', $settings['button']) }}">
                                            <p id="buttonError"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Button Link') }}</label>
                                            <input type="text" name="button_link" id="button_link"
                                                value="{{ old('button_link', $settings['button_link']) }}">
                                            <p id="button_linkError"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <!-- logo -->
                                <div class="form-group">
                                    <label> {{ __('setting.White Logo') }}</label>
                                    <div class="image-upload" id="logo">
                                        <input type="file" name="logo"accept=".jpg, .jpeg, .png">
                                        <div class="image-uploads">
                                            <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                alt="img">
                                            <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                        </div>
                                    </div>
                                    <p id="logoError"></p>
                                </div>
                                <div class="form-group">
                                    <label> {{ __('setting.Black Logo') }}</label>
                                    <div class="image-upload" id="black_logo">
                                        <input type="file" name="black_logo"accept=".jpg, .jpeg, .png">
                                        <div class="image-uploads">
                                            <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                alt="img">
                                            <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                        </div>
                                    </div>
                                    <p id="black_logoError"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- three-blcok -->
                    <div class="tab-pane fade" id="Three_Blcok-tab-pane" role="tabpanel"
                        aria-labelledby="Three_Blcok-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12 col-md-6 ">
                                <div class="form-group">
                                    <label>{{ __('setting.Title') }}</label>
                                    <input type="text" name="three_blcok" id="three_blcok"
                                        value="{{ old('three_blcok', $settings['three_blcok']) }}">
                                    <p id="three_blcokError"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <p class="subsectionTitle">{{ __('setting.Title 1') }}</p>
                            <div class="col-sm-8 col-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label>{{ __('setting.Title 1') }}</label>
                                        <input type="text" name="title_1" id="title_1"
                                            value="{{ old('title_1', $settings['title_1']) }}">
                                        <p id="title_1Error"></p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>{{ __('setting.sub Title 1') }}</label>
                                        <input type="text" name="sub_title_1" id="sub_title_1"
                                            value="{{ old('sub_title_1', $settings['sub_title_1']) }}">
                                        <p id="sub_title_1Error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label> {{ __('setting.title 1 Image') }}</label>
                                    <div class="image-upload" id="image_1">
                                        <input type="file" name="image_1"accept=".jpg, .jpeg, .png">
                                        <div class="image-uploads">
                                            <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                alt="img">
                                            <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                        </div>
                                    </div>
                                    <p id="image_1Error"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <p class="subsectionTitle">{{ __('setting.Title 2') }}</p>
                            <div class="col-sm-8 col-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label>{{ __('setting.Title 2') }}</label>
                                        <input type="text" name="title_2" id="title_2"
                                            value="{{ old('title_2', $settings['title_2']) }}">
                                        <p id="title_2Error"></p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>{{ __('setting.sub title 2') }}</label>
                                        <input type="text" name="sub_title_2" id="sub_title_2"
                                            value="{{ old('sub_title_2', $settings['sub_title_2']) }}">
                                        <p id="sub_title_2Error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label> {{ __('setting.title 2 Image') }}</label>
                                    <div class="image-upload" id="image_2">
                                        <input type="file" name="image_2"accept=".jpg, .jpeg, .png">
                                        <div class="image-uploads">
                                            <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                alt="img">
                                            <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                        </div>
                                    </div>
                                    <p id="image_2Error"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <p class="subsectionTitle">{{ __('setting.Title 3') }}</p>
                            <div class="col-sm-8 col-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label>{{ __('setting.Title 3') }}</label>
                                        <input type="text" name="title_3" id="title_3"
                                            value="{{ old('title_3', $settings['title_3']) }}">
                                        <p id="title_3Error"></p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>{{ __('setting.sub title 3') }}</label>
                                        <input type="text" name="sub_title_3" id="sub_title_3"
                                            value="{{ old('sub_title_3', $settings['sub_title_3']) }}">
                                        <p id="sub_title_3Error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label> {{ __('setting.title 3 Image') }}</label>
                                    <div class="image-upload" id="image_3">
                                        <input type="file" name="image_3"accept=".jpg, .jpeg, .png">
                                        <div class="image-uploads">
                                            <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                alt="img">
                                            <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                        </div>
                                    </div>
                                    <p id="image_3Error"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- feature -->
                    <div class="tab-pane fade" id="Feature-tab-pane" role="tabpanel" aria-labelledby="Feature-tab"
                        tabindex="0">
                        <div class="row">
                            <p class="subsectionTitle">{{ __('setting.Feature 1') }}</p>
                            <div class="col-sm-8 col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.feature 1 title') }}</label>
                                            <input type="text" name="feature_1_title" id="feature_1_title"
                                                value="{{ old('feature_1_title', $settings['feature_1_title']) }}">
                                            <p id="feature_1_titleError"></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Feature 1 text 1') }}</label>
                                            <input type="text" name="feature_1_text_1" id="feature_1_text_1"
                                                value="{{ old('feature_1_text_1', $settings['feature_1_text_1']) }}">
                                            <p id="feature_1_text_1Error"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.feature 1 text 2') }}</label>
                                            <input type="text" name="feature_1_text_2" id="feature_1_text_2"
                                                value="{{ old('feature_1_text_2', $settings['feature_1_text_2']) }}">
                                            <p id="feature_1_text_2Error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Feature 1 Button') }}</label>
                                            <input type="text" name="button_1" id="button_1"
                                                value="{{ old('button_1', $settings['button_1']) }}">
                                            <p id="button_1Error"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.feature 1 Link') }}</label>
                                            <input type="text" name="button_1_link" id="button_1_link"
                                                value="{{ old('button_1_link', $settings['button_1_link']) }}">
                                            <p id="button_1_linkError"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label> {{ __('setting.Feature 1 Image') }}</label>
                                    <div class="image-upload" id="feature_1_image">
                                        <input type="file" name="feature_1_image"accept=".jpg, .jpeg, .png">
                                        <div class="image-uploads">
                                            <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                alt="img">
                                            <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                        </div>
                                    </div>
                                    <p id="feature_1_imageError"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <p class="subsectionTitle">{{ __('setting.Feature 2') }}</p>
                            <div class="col-sm-8 col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.feature 2 title') }}</label>
                                            <input type="text" name="feature_2_title" id="feature_2_title"
                                                value="{{ old('feature_2_title', $settings['feature_2_title']) }}">
                                            <p id="feature_2_titleError"></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Feature 2 text 1') }}</label>
                                            <input type="text" name="feature_2_text_1" id="feature_2_text_1"
                                                value="{{ old('feature_2_text_1', $settings['feature_2_text_1']) }}">
                                            <p id="feature_2_text_1Error"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.feature 2 text 2') }}</label>
                                            <input type="text" name="feature_2_text_2" id="feature_2_text_2"
                                                value="{{ old('feature_2_text_2', $settings['feature_2_text_2']) }}">
                                            <p id="feature_2_text_2Error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.Feature 2 Button') }}</label>
                                            <input type="text" name="button_2" id="button_2"
                                                value="{{ old('button_2', $settings['button_2']) }}">
                                            <p id="button_2Error"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('setting.feature 2 Link') }}</label>
                                            <input type="text" name="button_2_link" id="button_2_link"
                                                value="{{ old('button_2_link', $settings['button_2_link']) }}">
                                            <p id="button_2_linkError"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label> {{ __('setting.Feature 2 Image') }}</label>
                                    <div class="image-upload" id="feature_2_image">
                                        <input type="file" name="feature_2_image"accept=".jpg, .jpeg, .png">
                                        <div class="image-uploads">
                                            <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                alt="img">
                                            <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                        </div>
                                    </div>
                                    <p id="feature_2_imageError"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- client -->
                    <div class="tab-pane fade" id="client-tab-pane" role="tabpanel" aria-labelledby="client-tab"
                        tabindex="0">
                        <div class="row justify-content-center ">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label> {{ __('setting.client 1 logo') }}</label>
                                        <div class="image-upload" id="client_logo_1">
                                            <input type="file" name="client_logo_1"accept=".jpg, .jpeg, .png">
                                            <div class="image-uploads">
                                                <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                    alt="img">
                                                <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                            </div>
                                        </div>
                                        <p id="client_logo_1Error"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label> {{ __('setting.client 2 logo') }}</label>
                                        <div class="image-upload" id="client_logo_2">
                                            <input type="file" name="client_logo_2"accept=".jpg, .jpeg, .png">
                                            <div class="image-uploads">
                                                <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                    alt="img">
                                                <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                            </div>
                                        </div>
                                        <p id="client_logo_2Error"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label> {{ __('setting.client 3 logo') }}</label>
                                        <div class="image-upload" id="client_logo_3">
                                            <input type="file" name="client_logo_3"accept=".jpg, .jpeg, .png">
                                            <div class="image-uploads">
                                                <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                    alt="img">
                                                <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                            </div>
                                        </div>
                                        <p id="client_logo_3Error"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label> {{ __('setting.client 4 logo') }}</label>
                                        <div class="image-upload" id="client_logo_4">
                                            <input type="file" name="client_logo_4"accept=".jpg, .jpeg, .png">
                                            <div class="image-uploads">
                                                <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                    alt="img">
                                                <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                            </div>
                                        </div>
                                        <p id="client_logo_4Error"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label> {{ __('setting.client 5 logo') }}</label>
                                        <div class="image-upload" id="client_logo_5">
                                            <input type="file" name="client_logo_5"accept=".jpg, .jpeg, .png">
                                            <div class="image-uploads">
                                                <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                    alt="img">
                                                <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                            </div>
                                        </div>
                                        <p id="client_logo_5Error"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label> {{ __('setting.client 6 logo') }}</label>
                                        <div class="image-upload" id="client_logo_6">
                                            <input type="file" name="client_logo_6"accept=".jpg, .jpeg, .png">
                                            <div class="image-uploads">
                                                <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}"
                                                    alt="img">
                                                <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                            </div>
                                        </div>
                                        <p id="client_logo_6Error"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- social-media -->
                    <div class="tab-pane fade" id="Social_Media-tab-pane" role="tabpanel"
                        aria-labelledby="Social_Media-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('github') }}</label>
                                    <input type="text" name="github" id="github"
                                        value="{{ old('github', $settings['github']) }}">
                                    <p id="githubError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('twitter') }}</label>
                                    <input type="text" name="twitter" id="twitter"
                                        value="{{ old('twitter', $settings['twitter']) }}">
                                    <p id="twitterbError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('facebook') }}</label>
                                    <input type="text" name="facebook" id="facebook"
                                        value="{{ old('facebook', $settings['facebook']) }}">
                                    <p id="facebookError"></p>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('android') }}</label>
                                    <input type="text" name="android" id="android"
                                        value="{{ old('android', $settings['android']) }}">
                                    <p id="androidError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('youtube') }}</label>
                                    <input type="text" name="youtube" id="youtube"
                                        value="{{ old('youtube', $settings['youtube']) }}">
                                    <p id="youtubeError"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>












                {{-- Button ROW --}}
                <div class="row">
                    <div class="col-sm-2 col">
                        <button id="submit" type="submit"
                            class="btn btn-submit w-100 ">{{ __('Update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')

    <script>
        $(document).ready(function() {


            $("#form").on("submit", function(event) {
                event.preventDefault();
                $('#submit').prop('disabled', true);
                var formData = new FormData(this);
                formData.append('id', 1);

                axios.post(this.action, formData)
                    .then(function(response) {
                        $('#submit').prop('disabled', false);
                        var message = response.data.message;
                        Swal.fire({
                            icon: "success",
                            title: message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        getImages();

                    }).catch(function(error) {
                        $('#submit').prop('disabled', false);

                        var title = error.response.data.title
                        var message = error.response.data.message;


                        if (title == 'error') {
                            Swal.fire({
                                title: "{{ __('swal_fire.Error') }}",
                                text: message,
                                icon: "error",
                                confirmButtonText: "{{ __('swal_fire.Ok') }}",
                            });
                        } else if (title.indexOf('images') !== -1) {
                            updateError('images', message);
                        } else {
                            updateError(title, message);
                        }


                    });
            });



            function updateError(elements, message) {
                const element = $('#' + elements);
                const error = $('#' + elements + 'Error');
                element.css('border', '1px solid #993333');
                error.css('color', 'brown');
                error.text(message);
                element.focus();
            }
        });
    </script>

@endsection
