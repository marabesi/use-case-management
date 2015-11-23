<?php

namespace Modules\Api\Models;

use Modules\Api\Models\Base;

class Version extends Base
{
    protected $table = 'dados_revisao';
    protected $primaryKey = 'id_dados_revisao';
    public $timestamps = false;

    public function fetchAll($limit)
    {
        return $this->paginate($limit);
    }

}
