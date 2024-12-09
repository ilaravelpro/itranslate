<?php



/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/1/20, 7:24 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp\Http\Controllers\API\v1\TranslateModel;


trait Filters
{
    public function filters($request, $model, $parent = null, $operators = [])
    {
        $filters = [
            [
                'name' => 'all',
                'title' => _t('all'),
                'type' => 'text',
            ],
            [
                'name' => 'model_type',
                'title' => _t('model_type'),
                'type' => 'text',
            ],
            [
                'name' => 'model_id',
                'title' => _t('model_id'),
                'type' => 'text',
            ],
        ];
        return [$filters, [], $operators];
    }
}
