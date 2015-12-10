<?php

namespace Modules\Api\Models;

use Modules\Api\Models\Base;

class Application extends Base
{

    /**
     * @var string
     */
    protected $table = 'sistema';

    /**
     * @var string
     */
    protected $primaryKey = 'id_sistema';

    /**
     * @var int
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
