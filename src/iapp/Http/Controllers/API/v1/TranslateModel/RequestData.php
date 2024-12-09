<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/21/21, 6:07 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp\Http\Controllers\API\v1\TranslateModel;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;


trait RequestData
{
    public function requestData(Request $request, $action, &$data)
    {
        if (in_array($action, ['store', 'update'])) {
            if (isset($data['local'])) {
                $data['local'] = is_array($data['local']) && isset($data['local']['value']) ? $data['local']['value'] : $data['local'];
                $request->merge(['local' => $data['local']]);
                request()->merge(['local' => $data['local']]);
            }
            $model_key = $this->model::getTModelKey();
            if (isset($data[$model_key])) {
                $model_class = $this->model::getTModelClass();
                $data[$model_key] = is_array($data[$model_key]) && isset($data[$model_key]['value']) ? $data[$model_key]['value'] : $data[$model_key];
                $data[$model_key] = $model_class::id($data[$model_key]);
            }
        }
    }
}
