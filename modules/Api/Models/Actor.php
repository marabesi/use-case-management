<?php

namespace Modules\Api\Models;

use Modules\Api\Models\Base;

class Actor extends Base
{
    
    /**
     * @var string
     */
    protected $table = 'ator';

    /**
     * @var string
     */
    protected $primaryKey = 'id_ator';

    /**
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function revisionActor()
    {
        return $this->belongsToMany('Modules\Api\Models\RevisionActors', 'id_ator');
    }
    
    /**
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAll($limit)
    {
        return $this->paginate($limit);
    }
}
