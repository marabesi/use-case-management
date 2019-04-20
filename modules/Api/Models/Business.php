<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{

    /**
     * @var string
     */
    protected $table = 'regra_de_negocio';

    /**
     * @var string
     */
    protected $primaryKey = 'id_regra_de_negocio';

    /**
     * @var boolean
     */
    public $timestamps = false;


    /**
     * @param array $request
     * @param int $id_passos
     * @param int $id_sistema
     */
    public function newSave($request, $id_passos, $id_sistema)
    {
        if (count($request) > 0) {
            foreach ($request as $value) {
                $business = new Business();
                $pieces = explode('|', $value);

                $business->identificador = $pieces[0];
                $business->descricao     = $pieces[1];
                $business->id_sistema    = $id_sistema;
                $business->save();

                $business->id_regra_de_negocio;

                $steps = new BusinessSteps();
                $steps->id_regra_de_negocio = $business->id_regra_de_negocio;
                $steps->id_passos = $id_passos;
                $steps->save();
            }
        }
    }
}
