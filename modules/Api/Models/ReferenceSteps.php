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
            'r.id_referencia AS id',
            'rf.identificador AS identifier',
            'rf.descricao AS description'
        )
            ->from('relacionamento_referencia AS r')
            ->join('referencia AS rf', 'r.id_referencia', '=', 'rf.id_referencia')
            ->where('r.id_passos', $id_passos)
            ->get();
    }

    /**
     * @param int $id
     * @return array
     */
    public function findByUseCase($id)
    {
        $data =  $this->select(
            'f.id_fluxo',
            'f.tipo',
            'p.id_passos',
            'p.identificador',
            'p.descricao',
            'ref.identificador',
            'ref.descricao'
        )
            ->from('fluxo AS f')
            ->join('revisao AS r', 'f.id_revisao', '=', 'r.id_revisao')
            ->join('passos AS p', 'f.id_fluxo', '=', 'p.id_fluxo')

            ->join('relacionamento_referencia AS re', 're.id_passos', '=', 'p.id_passos')
            ->join('referencia AS ref', 're.id_referencia', '=', 'ref.id_referencia')

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
