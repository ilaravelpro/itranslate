<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/15/20, 1:10 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp\Http\Resources;

use iLaravel\Core\iApp\Http\Resources\ResourceData;

class TranslateLocalData extends ResourceData
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['text'] = $this->name;
        $data['value'] = $this->code ? : strtolower($this->name);
        $data['direction'] = $this->direction ? : 'ltr';
        $data['id'] = $this->serial;
        if ($this->parent_id){
            $data['parent_id'] = $this->parent->serial;
            if ($this->parent->parent_id)
                $data['grandpa_id'] = $this->parent->parent->serial;
        }
        return $data;
    }
}
