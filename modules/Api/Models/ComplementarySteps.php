<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementarySteps extends Model
{
    /**
     * @var string
     */
    protected $table = 'relacionamento_informacao_complementar';

    /**
     * @var string
     */
    protected $primaryKey = 'id_informacao_complementar';

    /**
     * @var boolean
     */
    public $timestamps = false;

}