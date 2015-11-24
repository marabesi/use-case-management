<?php

namespace Modules\Api\Models;

use Modules\Api\Models\Base;

class UseCase extends Base
{
    protected $table = 'caso_de_uso';
    protected $primaryKey = 'id_caso_de_uso';
    public $timestamps = false;

    public function fetchAll($limit)
    {
        return $this->join(
            'revisao', 'revisao.id_caso_de_uso', '=',
            'caso_de_uso.id_caso_de_uso'
        )->paginate($limit);
    }

}
