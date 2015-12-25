<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessSteps extends Model
{

    /**
     * @var string
     */
    protected $table = 'relacionamento_regra_de_negocio';

    /**
     * @var string
     */
    protected $primaryKey = 'id_passos';

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
        return $this->select('r.id_regra_de_negocio AS id',
            'rn.identificador AS identifier',
            'rn.descricao AS description')
            ->from('relacionamento_regra_de_negocio AS r')
            ->join('regra_de_negocio AS rn', 'r.id_regra_de_negocio', '=' , 'rn.id_regra_de_negocio')
            ->where('r.id_passos', $id_passos)
            ->get();
    }
}