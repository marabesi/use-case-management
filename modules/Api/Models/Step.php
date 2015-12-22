<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    /**
     * @var string
     */
    protected $table = 'passos';

    /**
     * @var string
     */
    protected $primaryKey = 'id_passos';

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
        return $this->select('c.id_caso_de_uso', 'c.descricao AS caso_de_uso_descricao',
            'f.id_fluxo', 'f.tipo', 'p.id_passos', 'p.identificador', 'p.descricao',
            'r.id_revisao')
            ->from('fluxo AS f')
            ->join('passos AS p', 'f.id_fluxo', '=', 'p.id_fluxo')
            ->join('revisao AS r', 'r.id_revisao', '=', 'f.id_revisao')
            ->join('caso_de_uso AS c', 'r.id_caso_de_uso', '=', 'c.id_caso_de_uso')
            ->paginate($limit);
    }
}