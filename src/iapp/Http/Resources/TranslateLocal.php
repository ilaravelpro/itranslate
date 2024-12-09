<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/15/20, 1:10 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp\Http\Resources;

use iLaravel\Core\iApp\Http\Resources\Resource;

class TranslateLocal extends Resource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        if ($this->parent_id){
            $data['parent_id'] = [
                'text' => $this->parent->name,
                'value' => $this->parent->code,
                'direction' => $this->parent->direction ? : 'ltr',
                'id' => $this->parent->serial,
            ];
            if ($this->parent->parent_id){
                $data['grandpa_id'] = [
                    'text' => $this->parent->parent->title,
                    'value' => $this->parent->parent->name,
                    'direction' => $this->parent->parent->direction ? : 'ltr',
                    'id' => $this->parent->parent->serial,
                ];
            }
        }
        return $data;
    }
}
