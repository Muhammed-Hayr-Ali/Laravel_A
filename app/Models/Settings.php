<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = ['multilingual','defaultLanguage' , 'logo', 'black_logo', 'siteName', 'big_title_1', 'big_title_2', 'sm_title_1', 'sm_title_2', 'button', 'button_link', 'three_blcok', 'image_1', 'title_1', 'sub_title_1', 'image_2', 'title_2', 'sub_title_2', 'image_3', 'title_3', 'sub_title_3', 'feature_1_title', 'feature_1_text_1', 'feature_1_text_2', 'button_1', 'button_1_link', 'feature_1_image', 'feature_2_title', 'feature_2_text_1', 'feature_2_text_2', 'button_2', 'button_2_link', 'feature_2_image', 'client_title', 'client_logo_1', 'client_logo_2', 'client_logo_3', 'client_logo_4', 'client_logo_5', 'client_logo_6', 'github', 'twitter', 'facebook', 'android', 'youtube', 'year'];
}
