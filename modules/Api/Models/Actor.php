<?php

namespace Modules\Api\Models;

use Modules\Api\Models\Base;

class Actor extends Base
{
    protected $table = 'ator';
    protected $primaryKey = 'id_ator';
    public $timestamps = false;

    public function fetchAll($limit)
    {
        return $this->paginate($limit);
    }

}
