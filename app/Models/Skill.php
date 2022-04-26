<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
    ];
    
    public static function getAvailableBgColors()
    {
        // return the bg colors in the customization.json file
        $elements = json_decode(
            // get from resource path
            File::get(resource_path('json/customization.json'))
        );
        // return the element backgrounds from the json file
        return $elements->backgrounds;
    }
}
