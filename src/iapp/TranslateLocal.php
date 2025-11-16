<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 12/20/20, 8:27 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;
use Illuminate\Support\Facades\Cache;

class TranslateLocal extends \iLaravel\Core\iApp\Model
{
    public static $s_prefix = "ITRL";
    public static $s_start = 10000;
    public static $s_end = 40000;


    public static function boot()
    {
        parent::boot();
        parent::saving(function () {
            Cache::forget("i_locals");
        });
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function kids()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function rules(Request $request, $action, $arg1 = null)
    {
        $arg1 = is_string($arg1) ? $this::findBySerial($arg1) : $arg1;
        $rules = [];
        switch ($action) {
            case 'store':
            case 'update':
                $rules = array_merge($rules, [
                    'parent_id' => "nullable|exists:translate,id",
                    'code' => "required|string",
                    'name' => "required|string",
                    'direction' => "required|in:ltr,rtl",
                    'is_default' => "required|in:ltr,rtl",
                    'status' => 'nullable|in:' . join( ',', iconfig('status.types', iconfig('status.global'))),
                ]);
                break;
        }
        return $rules;
    }
}
