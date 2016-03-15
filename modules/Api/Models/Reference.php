<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    
    /**
     * @var string
     */
    protected $table = 'referencia';

    /**
     * @var string
     */
    protected $primaryKey = 'id_referencia';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @param array $request
     * @param int $id_passos
     */
    public function newSave($request, $id_passos, $id_sistema)
    {
        if (count($request) > 0) {

            foreach ($request as $value) {
                $reference = new Reference();
                $pieces = explode('|', $value);

                $reference->identificador = $pieces[0];
                $reference->descricao     = $pieces[1];
                $reference->id_sistema    = $id_sistema;
                $reference->save();

                $reference->id_referencia;

                $steps = new ReferenceSteps();
                $steps->id_referencia = $reference->id_referencia;
                $steps->id_passos = $id_passos;
                $steps->save();
            }
        }
    }
}