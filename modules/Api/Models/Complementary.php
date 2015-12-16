<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Complementary extends Model
{

    /**
     * @var string
     */
    protected $table = 'informacao_complementar';

    /**
     * @var string
     */
    protected $primaryKey = 'id_informacao_complementar';

    /**
     * @var boolean
     */
    public $timestamps = false;
}