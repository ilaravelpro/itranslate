<?php
namespace iLaravel\iTranslate\iApp\Traits;


trait Model
{
    public static function getTModelType()
    {
        return static::$t_model_type ? : class_basename(static::class);
    }

    public static function getTModelKey()
    {
        return static::$t_model_key ? : (class_name(static::class, false, 4, '_') . '_id');
    }

    public static function getTModelClass()
    {
        return static::$t_model_class ? : static::class;
    }
}
