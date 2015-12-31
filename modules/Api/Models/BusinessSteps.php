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

    /**
     * @param int $id
     * @return array
     */
    public function findByUseCase($id)
    {
        $data =  $this->select('f.id_fluxo', 'f.tipo', 'p.id_passos',
            'p.identificador', 'p.descricao', 'rn.identificador',
            'rn.descricao')
            ->from('fluxo AS f')
            ->join('revisao AS r', 'f.id_revisao', '=', 'r.id_revisao')
            ->join('passos AS p', 'f.id_fluxo', '=', 'p.id_fluxo')

            ->join('relacionamento_regra_de_negocio AS rrn', 'rrn.id_passos', '=', 'p.id_passos')
            ->join('regra_de_negocio AS rn', 'rn.id_regra_de_negocio', '=', 'rrn.id_regra_de_negocio')

            ->where('r.id_caso_de_uso', $id)
            ->get();

        $result = [];

        foreach ($data->toArray() as $array) {
            $result[$array['tipo']][] =  [
                'identifier' => $array['identificador'],
                'description' => $array['descricao']
            ];
        }

        return $result;
    }
}