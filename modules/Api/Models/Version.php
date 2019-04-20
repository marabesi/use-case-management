<?php

namespace Modules\Api\Models;

use Modules\Api\Models\Base;

class Version extends Base
{

    /**
     * @var string
     */
    protected $table = 'dados_revisao';

    /**
     * @var string
     */
    protected $primaryKey = 'id_dados_revisao';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAll($limit)
    {
        return $this->paginate($limit);
    }
}
