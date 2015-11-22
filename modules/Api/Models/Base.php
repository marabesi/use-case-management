<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Base extends Model
{

    const DEFAULT_LIMIT = 10;
    const DEFAULT_PAGE = 1;

}
