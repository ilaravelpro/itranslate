<?php

namespace iLaravel\iTranslate\iApp\Http\Controllers\API\v1\Traits;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

trait SaveLocals
{
    public function save_locals($request, $model, $translateModel = null, $unset = [], $parent = null)
    {
        $translateModel = $translateModel ? : (isset($this->translateModel) ? $this->translateModel : ($this->model ? imodal(last(explode('\\', $this->model)) . 'Translate') : null));
        if ($translateModel && isset($request->locals) && count($request->locals) && isset($model->translates) && $model->translates) {
            foreach ($request->locals as $local => $dataall) {
                $local_request = (new Request())->merge($dataall);
                $rules = $translateModel::getRules($local_request, 'update');
                $fields = $this->fillable('store') ?: array_keys($rules);
                $except = method_exists($this,'except') ? $this->except($local_request, 'locals_save') : ['tags', 'terms', 'attachments'];
                $fields = $this->handelFields($except, $fields, $dataall);
                $data = [];
                foreach ($fields as $value)
                    if (_has_key($dataall, $value))
                        $data = _set_value($data, $value, _get_value($dataall, $value));
                if (is_callable($unset)) list($data, $dataall) = $unset($local, $data, $dataall);
                else foreach ($unset as $item) unset($data[$item]);
                if (isset($translateModel::$t_model_key) && $translateModel::$t_model_key)
                    $data[$translateModel::$t_model_key] = $model->id;
                if (isset($data['local']) && is_array($data['local'])) $data['local'] = isset($data['local']['value']) ? $data['local']['value'] : $local;
                $recordTranslate = $model->translates()->updateOrCreate(['local' => $local], $data);
                if (method_exists($recordTranslate, 'additionalUpdate'))
                    $recordTranslate->additionalUpdate($recordTranslate, $dataall, $local_request);
            }
        }
    }
}
