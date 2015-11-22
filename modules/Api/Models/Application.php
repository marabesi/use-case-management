<?php

namespace Modules\Api\Models;

use Modules\Api\Models\Base;

class Application extends Base
{
    protected $table = 'sistema';
    protected $primaryKey = 'id_sistema';
    public $timestamps = false;

    public function fetchAll($limit)
    {
        return $this->paginate($limit);
    }

}
