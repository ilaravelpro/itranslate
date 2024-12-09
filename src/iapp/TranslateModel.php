<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 12/20/20, 8:27 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp;

class TranslateModel extends \iLaravel\Core\iApp\Model
{
    use \iLaravel\Core\iApp\Methods\Metable;
    use Traits\Model;

    public static $s_prefix = "ITRM";
    public static $s_start = 21869999999;
    public static $s_end = 634229999999;
    public static $t_model_class = null;
    public static $t_model_type = null;
    public static $t_model_key = null;

    protected $table = 'translate_models';
    public $metaTable = 'translate_indexes';
    public $metaClass = TranslateIndex::class;
    public $hidden = ['model_type', 'model_id', 'metas'];

    protected function getMetaKeyName()
    {
        return 'model_id';
    }

    protected static function boot()
    {
        parent::boot();
        parent::creating(function (self $static) {
            $static->model_id = $static->{$static->getTModelKey()};
            $static->model_type = $static->getTModelType();
            unset($static->{$static->getTModelKey()});
        });
        parent::deleting(function (self $self) {
            $self->metas()->delete();
        });
    }
}
