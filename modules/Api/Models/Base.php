<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Base extends Model
{

    /**
     * Max limit to use when fetching data from database
     * @var int
     */
    const DEFAULT_LIMIT = 10;

    /**
     * Default page number to use when use pagination
     * @var int
     */
    const DEFAULT_PAGE = 1;
}
