<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Api\Models\ComplementarySteps;
use Modules\Api\Models\BusinessSteps;
use Modules\Api\Models\ReferenceSteps;

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
}