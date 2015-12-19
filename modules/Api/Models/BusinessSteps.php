<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessSteps extends Model
{

    /**
     * @var string
     */
    protected $table = 'relacionamento_regra_de_negocio';

    /**
     * @var string
     */
    protected $primaryKey = 'id_regra_de_negocio';

    /**
     * @var boolean
     */
    public $timestamps = false;

}