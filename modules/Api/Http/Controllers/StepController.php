<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Modules\Api\Models\Flow;
use Modules\Api\Models\Step;

class StepController extends Controller {
	
    /**
     * @var Modules\Api\Models\Flow
     */
    private $flow;

    /**
     * @param Modules\Api\Models\Flow $flow
     */
    public function __construct(Flow $flow)
    {
        $this->flow = $flow;
    }

    public function deleteIndex($id)
    {
        
    }

    public function getIndex(\Illuminate\Http\Request $request)
    {
        return $this->getJsonResponse([]);
    }

    public function postIndex(\Illuminate\Http\Request $request)
    {
        $flow = new Flow();
        $flow->tipo = $request->input('type');
        $flow->id_revisao = $request->input('useCase');
        $flow->save();

        $id_fluxo = $flow->id_fluxo;

        $step = new Step();
        $step->id_fluxo = $id_fluxo;
        $step->identificador = $request->input('identifier');
        $step->descricao = $request->input('description');
        $step->save();

        $this->getJsonResponse([]);
    }

    public function putIndex($id, \Illuminate\Http\Request $request)
    {

    }
}