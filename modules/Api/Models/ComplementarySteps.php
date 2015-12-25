<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementarySteps extends Model
{
    /**
     * @var string
     */
    protected $table = 'relacionamento_informacao_complementar';

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
        return $this->select(
            'r.id_informacao_complementar AS id',
            'ci.identificador AS identifier',
            'ci.descricao AS description')
            ->from('relacionamento_informacao_complementar AS r')
            ->join('informacao_complementar AS ci', 'r.id_informacao_complementar', '=' , 'ci.id_informacao_complementar')
            ->where('r.id_passos', $id_passos)
            ->get();
    }
}