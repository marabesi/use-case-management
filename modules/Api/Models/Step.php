<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Api\Models\ComplementarySteps;
use Modules\Api\Models\BusinessSteps;
use Modules\Api\Models\ReferenceSteps;
use Modules\Api\Models\Flow;

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

    /**
     * @param int $id_passos
     * @param array $fields
     */
    public function updateComplementaryRows($id_passos, $fields = [])
    {
        $complementarySteps = new ComplementarySteps();
        $complementarySteps->find($id_passos)->delete();

        $complementary = new Complementary();
        $complementary->newSave($fields, $id_passos);
    }

    /**
     * @param int $id_passos
     * @param array $fields
     */
    public function updateBusinessRows($id_passos, $fields = [])
    {
        $businessSteps = new BusinessSteps();
        $businessSteps->find($id_passos)->delete();

        $business = new Business();
        $business->newSave($fields, $id_passos);
    }

    /**
     * @param int $id_passos
     * @param array $fields
     */
    public function updateReferenceRows($id_passos, $fields = [])
    {
        $referenceSteps = new ReferenceSteps();
        $referenceSteps->find($id_passos)->delete();

        $reference = new Reference();
        $reference->newSave($fields, $id_passos);
    }

    /**
     * @param int $id_passos
     * @param int $id_fluxo
     */
    public function deleteAll($id_passos, $id_fluxo)
    {
        $passos = $this->find($id_passos);

        if ($passos) {
            
            $complementary = new \Modules\Api\Models\ComplementarySteps();
            
            if ($rows = $complementary->find($id_passos)) {
                $rows->delete();
            }

            $business = new \Modules\Api\Models\BusinessSteps();
            if ($rows = $business->find($id_passos)) {
                $rows->delete();
            }

            $reference = new \Modules\Api\Models\ReferenceSteps();
            if ($rows = $reference->find($id_passos)) {
                $rows->delete();
            }

            $passos->delete();

            $flow = new Flow();
            if ($rows = $flow->find($id_fluxo)) {
                $rows->delete();
            }
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function preview($id)
    {
        $data = $this->select(
            's.id_sistema',
            's.nome AS sistema',
            'cu.id_caso_de_uso',
            'cu.descricao AS caso_de_uso',
            'cu.status AS caso_de_uso_status',
            'dr.descricao AS revisao_descricao',
            'dr.versao',
            'a.id_ator',
            'a.nome as ator',
            'a.descricao as ator_descricao',

            'icc.id_informacao_complementar',
            'icc.identificador as info_comple_identificador',
            'icc.descricao as info_compl_descricao',

            'rn.id_regra_de_negocio',
            'rn.descricao as rn_descricao',
            'rn.identificador as rn_identificador',
            
            'refe.id_referencia',
            'refe.identificador as referencia_identificador',
            'refe.descricao as referencia',
            'p.id_passos'
        )->from('passos AS p')
        ->join('fluxo as f', 'p.id_fluxo', '=', 'f.id_fluxo')
        ->join('relacionamento_informacao_complementar as ric', 'p.id_passos', '=', 'ric.id_passos')
        ->join('informacao_complementar as icc', 'ric.id_informacao_complementar', '=', 'icc.id_informacao_complementar')

        ->join('relacionamento_regra_de_negocio as rrr', 'p.id_passos', '=', 'rrr.id_passos')
        ->join('regra_de_negocio as rn', 'rrr.id_regra_de_negocio', '=', 'rn.id_regra_de_negocio')

        ->join('relacionamento_referencia as re', 'p.id_passos', '=', 're.id_passos')
        ->join('referencia as refe', 're.id_referencia', '=', 'refe.id_referencia')

        ->join('revisao as r', 'f.id_revisao', '=', 'r.id_revisao')

        ->join('caso_de_uso as cu', 'r.id_caso_de_uso', '=', 'cu.id_caso_de_uso')
        ->join('revisao as rev', 'cu.id_caso_de_uso', '=', 'rev.id_caso_de_uso')
        ->join('dados_revisao as dr', 'rev.id_dados_revisao', '=', 'dr.id_dados_revisao')

        ->join('relacionamento_dados_revisao as rdr', 'rev.id_revisao', '=', 'rdr.id_revisao')
        ->join('ator as a', 'rdr.id_ator', '=', 'a.id_ator')

        ->join('sistema as s', 'cu.id_sistema', '=', 's.id_sistema')
        ->where('p.id_passos', $id)
        ->get();

        $hidrate = [];
        foreach ($data as $array) {
            $hidrate[$array['id_sistema']] = [
                'sistema' => $array['sistema']
            ];
            $hidrate[$array['id_sistema']]['caso_de_uso'][$array['id_caso_de_uso']] = [
                'caso_de_uso' => $array['caso_de_uso'],
                'caso_de_uso_status' => $array['caso_de_uso_status'],
                'versao' => $array['versao'],
            ];
            $hidrate[$array['id_sistema']]['atores'][$array['id_caso_de_uso']][$array['id_ator']] = [
                'nome' => $array['ator'],
                'descricao' => $array['ator_descricao']
            ];
            $hidrate[$array['id_sistema']]['complementar'][$array['id_caso_de_uso']][$array['id_informacao_complementar']] = [
                'identificador' => $array['info_comple_identificador'],
                'descricao' => $array['info_compl_descricao'],
            ];
            
            $hidrate[$array['id_sistema']]['regra_de_negocio'][$array['id_caso_de_uso']][$array['id_regra_de_negocio']] = [
                'identificador' => $array['rn_identificador'],
                'descricao' => $array['rn_descricao'],
            ];
            
            $hidrate[$array['id_sistema']]['referencia'][$array['id_caso_de_uso']][$array['id_referencia']] = [
                'identificador' => $array['referencia_identificador'],
                'descricao' => $array['referencia'],
            ];
        }

        return $hidrate;
    }
}