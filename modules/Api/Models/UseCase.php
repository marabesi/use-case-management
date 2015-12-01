<?php

namespace Modules\Api\Models;

use Modules\Api\Models\Base;

class UseCase extends Base
{
    protected $table = 'caso_de_uso';
    protected $primaryKey = 'id_caso_de_uso';
    public $timestamps = false;

    public function fetchAll($limit)
    {
        return $this->select(
            'c.id_caso_de_uso', 'c.id_sistema', 'c.descricao',
            'c.status', 'r.id_revisao', 'd.id_dados_revisao',
            'd.versao', 's.nome', 'rdr.id_ator', 'rdr.id_relacionamento_dados_revisao'
        )
        ->from('caso_de_uso AS c')
        ->join('revisao AS r', 'r.id_caso_de_uso', '=', 'c.id_caso_de_uso')
        ->join(
            'dados_revisao AS d', 'd.id_dados_revisao', '=',
            'r.id_dados_revisao'
        )
        ->join('sistema AS s', 'c.id_sistema', '=', 's.id_sistema')
        ->join(
            'relacionamento_dados_revisao AS rdr', 'd.id_dados_revisao',
            '=', 'rdr.id_dados_revisao'
        )
        ->groupBy('c.id_caso_de_uso')
        ->paginate($limit);
    }

    /**
     * @param int $id
     */
    public function fetchUseCase($id)
    {
        $data = $this->select(
            'c.id_caso_de_uso', 'c.id_sistema', 'c.descricao',
            'c.status', 'r.id_revisao', 'd.id_dados_revisao',
            'd.versao', 's.nome', 'rdr.id_ator',
            'rdr.id_relacionamento_dados_revisao'
        )
        ->from('caso_de_uso AS c')
        ->join('revisao AS r', 'r.id_caso_de_uso', '=', 'c.id_caso_de_uso')
        ->join(
            'dados_revisao AS d', 'd.id_dados_revisao', '=',
            'r.id_dados_revisao'
        )
        ->join('sistema AS s', 'c.id_sistema', '=', 's.id_sistema')
        ->join(
            'relacionamento_dados_revisao AS rdr', 'd.id_dados_revisao',
            '=', 'rdr.id_dados_revisao'
        )
        ->where('c.id_caso_de_uso', $id);

        $hydrate = [];
        $atores = [];
        $aux = '';
        foreach ($data->get()->toArray() as $array) {
            if ($aux != $array['id_caso_de_uso']) {
                $hydrate = [
                    'id_caso_de_uso' => $array['id_caso_de_uso'],
                    'id_sistema' => $array['id_sistema'],
                    'descricao' => $array['descricao'],
                    'status' => $array['status'],
                    'id_revisao' => $array['id_revisao'],
                    'id_dados_revisao' => $array['id_dados_revisao'],
                    'versao' => $array['versao'],
                    'nome' => $array['nome'],
                ];
            }
            
            $atores['atores'][] = $array['id_ator'];
        }

        return array_merge($hydrate, $atores);
    }

}
