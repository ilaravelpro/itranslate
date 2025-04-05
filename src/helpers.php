<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/13/20, 8:07 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

function itranslate_path($path = null)
{
    $path = trim($path, '/');
    return __DIR__ . ($path ? "/$path" : '');
}

function itranslate($key = null, $default = null)
{
    return iconfig('itranslate' . ($key ? ".$key" : ''), $default);
}

function _t($trans = null, $replace = null)
{

    if ($trans) {
        $model = imodal('TranslateMessage');
        $translate = $model::firstOrCreate($trans);
        return $replace ? _set_values_text($translate ? $translate->value : $trans, $replace): ($translate ? $translate->value : $trans);
    }else
        return $trans;
}

function _ti($trans = null, $replace = null)
{
    if ($trans) {
        $translate = \iLaravel\iTranslate\iApp\TranslateMessage::firstOrCreate($trans);
        return $replace ? _set_values_text($translate->value ? : $trans, $replace): ($translate->value ? : $trans);
    }else
        return $trans;
}

function i_locale($locale) {
    return app('i_locals')->where('code', $locale)->first();
}