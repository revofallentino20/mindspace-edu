<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public static function get($key, $default = '')
    {
        $content = static::where('key', $key)->first();
        return $content ? $content->value : $default;
    }
}