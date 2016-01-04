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
        $find = $complementarySteps->find($id_passos);

        if ($find) {
            $find->delete();
        }

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
        $find = $businessSteps->find($id_passos);

        if ($find) {
            $find->delete();
        }

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
        $find = $referenceSteps->find($id_passos);

        if ($find) {
            $find->delete();
        }

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
}