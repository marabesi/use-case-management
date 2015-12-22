<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceSteps extends Model
{

    /**
     * @var string
     */
    protected $table = 'relacionamento_referencia';

    /**
     * @var string
     */
    protected $primaryKey = 'id_referencia';

    /**
     * @var boolean
     */
    public $timestamps = false;

        /**
     * @param int $id_passos
     * @return type
     */
    public function fetchAll($id_passos)
    {
        return $this->select('*')
            ->from('relacionamento_referencia AS r')
            ->join('referencia AS rf', 'r.id_referencia', '=' , 'rf.id_referencia')
            ->where('r.id_passos', $id_passos)
            ->get();
    }
}