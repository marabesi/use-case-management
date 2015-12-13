<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    /**
     * @var string
     */
    protected $table = 'fluxo';

    /**
     * @var string
     */
    protected $primaryKey = 'id_fluxo';

    /**
     * @var boolean
     */
    public $timestamps = false;

}