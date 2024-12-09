<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/2/21, 8:13 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iTranslate\iApp\Policies;

use iLaravel\Core\Vendor\iRole\iRolePolicy;

class TranslateLocalPolicy extends iRolePolicy
{
    public $prefix = 'translate_locals';
    public $model = 'TranslateLocal';
}
