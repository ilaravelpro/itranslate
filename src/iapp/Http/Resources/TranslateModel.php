<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/15/20, 1:10 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp\Http\Resources;

use iLaravel\Core\iApp\Http\Resources\Resource;
use iLaravel\iTranslate\iApp\TranslateLocal;

class TranslateModel extends Resource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        if (isset($data['local']) && $data['local'])
            $data['local'] = [
                'text' => TranslateLocal::where('code',  $data['local'])->first()->name,
                'value' => $data['local'],
            ];
        return $data;
    }
}
