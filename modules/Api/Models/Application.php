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
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    /**
     * @var int
     */
    public $timestamps = false;
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function useCase()
    {
        return $this->belongsToMany('Modules\Api\Models\UseCase', 'id_sistema');
    }
}
