<?php



/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/1/20, 7:24 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp\Http\Controllers\API\v1\TranslateLocal;


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
                'name' => 'code',
                'title' => _t('title'),
                'type' => 'text',
            ],
            [
                'name' => 'name',
                'title' => _t('name'),
                'type' => 'text',
            ],
            [
                'name' => 'direction',
                'title' => _t('direction'),
                'type' => 'text',
            ],
            [
                'name' => 'parent',
                'title' => _t('parent'),
                'type' => 'text',
            ],
        ];
        return [$filters, [], $operators];
    }
}
