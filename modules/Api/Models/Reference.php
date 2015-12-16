<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    
    /**
     * @var string
     */
    protected $table = 'referencia';

    /**
     * @var string
     */
    protected $primaryKey = 'id_referencia';

    /**
     * @var boolean
     */
    public $timestamps = false;

}