<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 12/20/20, 8:27 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp;

use iLaravel\Core\iApp\Modals\Modal;

class TranslateIndex extends \iLaravel\Core\iApp\Methods\MetaData
{
    use Modal;
    public static $s_prefix = "ITRI";
    public static $s_start = 21869999999;
    public static $s_end = 634229999999;

    protected $table = 'translate_indexes';

    protected $guarded = [];
}
