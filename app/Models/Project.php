<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'color',
        'icon_name',
    ];

    public static function getAvailableTextColors()
    {
        // return the bg colors in the customization.json file
        $elements = json_decode(
            // get from resource path
            File::get(resource_path('json/customization.json'))
        );
        // return the element texts from the json file
        return $elements->texts;
    }

    public static function getAvailableIcons()
    {
        // return the bg colors in the customization.json file
        $elements = json_decode(
            // get from resource path
            File::get(resource_path('json/customization.json'))
        );
        // return the element icons from the json file
        return $elements->icons;
    }
}
