<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 3/1/21, 12:08 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp\Http\Controllers\API\v1\TranslateModel;


trait QueryFilterType
{
    public function query_filter_type($model, $filter, $params, $current)
    {
        $model_key = $this->model::getTModelKey();
        $model_type = $this->model::getTModelType();
        if (!$this::$_self_key) $model->where('model_type', $model_type);
        $current['model'] = $model_type;
        switch ($params->type){
            case $model_key:
                $model_class = $this->model::getTModelClass();
                $model->where($this::$_self_key ? $model_key : 'model_id', $model_class::id($filter->value));
                $current[$model_key] = $filter->value;
                break;
        }
        return $current;
    }
}
