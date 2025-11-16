<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 12/20/20, 8:27 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TranslateMessage extends \iLaravel\Core\iApp\Model
{
    public static $s_prefix = "ITRM";
    public static $s_start = 21869999999;
    public static $s_end = 634229999999;
    public $set_creator = false;

    public static function boot()
    {
        parent::boot();
        parent::saving(function () {
            Cache::forget("i_local_messages");
        });
    }

    public static function firstOrCreate($key) {
        if ($key) {
            $local = \Illuminate\Support\Facades\App::getLocale();
            $translate = @app('i_local_messages')[Str::slug($key, '_'). "_{$local}"];
            if (!$translate && $local !== 'en' && strpos($key, 'SQLSTATE') === false && class_exists('\Stichoza\GoogleTranslate\GoogleTranslate')) {
                try {
                    set_time_limit(0);
                    $tr = new \Stichoza\GoogleTranslate\GoogleTranslate();
                    $tr->setSource('en');
                    $tr->setTarget($local);
                    $transed = $tr->translate(str_replace(['_', '-'], '', str_replace(['_at', '_id'], '', $key)));
                } catch (\Throwable $exception) {
                    $transed = $key;
                }
                $translate = static::updateOrCreate(['key' => $key, 'value' => $transed, 'local' => $local]);
            }elseif(!$translate && $local == 'en')
                $translate = static::updateOrCreate(['key' => $key, 'value' => $key, 'local' => $local]);
            return is_string($translate) ? $translate : $translate->value;
        }else
            return false;
    }
}
