<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceSteps extends Model
{

    /**
     * @var string
     */
    protected $table = 'relacionamento_referencia';

    /**
     * @var string
     */
    protected $primaryKey = 'id_referencia';

    /**
     * @var boolean
     */
    public $timestamps = false;
    
}