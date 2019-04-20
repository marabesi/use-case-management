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
            'ci.descricao AS description'
        )
            ->from('relacionamento_informacao_complementar AS r')
            ->join('informacao_complementar AS ci', 'r.id_informacao_complementar', '=', 'ci.id_informacao_complementar')
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
            'ic.identificador AS identificador_nome',
            'ic.descricao AS complementar_descricao'
        )
            ->from('fluxo AS f')
            ->join('revisao AS r', 'f.id_revisao', '=', 'r.id_revisao')
            ->join('passos AS p', 'f.id_fluxo', '=', 'p.id_fluxo')

            ->join('relacionamento_informacao_complementar AS ric', 'p.id_passos', '=', 'ric.id_passos')
            ->join('informacao_complementar AS ic', 'ric.id_informacao_complementar', '=', 'ic.id_informacao_complementar')

            ->where('r.id_caso_de_uso', $id)
            ->get();

        $result = [];

        foreach ($data->toArray() as $array) {
            $result[$array['tipo']][] =  [
                'identifier' => $array['identificador_nome'],
                'description' => $array['descricao']
            ];
        }

        return $result;
    }
}
