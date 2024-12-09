<?php
namespace iLaravel\iTranslate\iApp\Traits;


trait Translate
{
    public function toLocal($local) {
        if (method_exists($this, 'translates') && $this->local &&
            $this->local !== $local && $translate = $this->translates()->where('local', $local)->first()) {
            $t_attributes = isset($this->t_attributes) && is_array($this->t_attributes) ? $this->t_attributes : [];
            $data = [];
            $excepts = isset($this->t_excepts) && is_array($this->t_excepts) ? $this->t_excepts : [];
            if (count($t_attributes)) {
                foreach ($t_attributes as $index => $t_attribute) {
                    if (isset($translate->{is_numeric($index) ? $t_attribute : $index}) && !in_array($t_attribute, $excepts))
                        $data[$t_attribute] = $translate->{is_numeric($index) ? $t_attribute : $index};
                }
            }elseif(isset($this->attributes) && count($this->attributes)) {
                if (!count($excepts)) $excepts = ['id', 'created_at', 'update_at'];
                foreach ($this->attributes as $index => $attribute) {
                    if (isset($translate->$index) && !in_array($index, $excepts))
                        $data[$index] = $translate->$index;
                }
            }
            if (count($data)) {
                $data['parent'] = [
                    'text' => $this->title,
                    'value' => $this->serial,
                ];
                return $data;
            }
        }
        return false;
    }
}
