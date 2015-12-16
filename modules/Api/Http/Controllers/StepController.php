<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;
use Modules\Api\Models\Flow;
use Modules\Api\Models\Step;
use Modules\Api\Models\Complementary;
use Modules\Api\Models\ComplementarySteps;
use Modules\Api\Models\Business;
use Modules\Api\Models\Reference;

class StepController extends Controller
{
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

    public function getIndex(Request $request)
    {
        return $this->getJsonResponse([]);
    }

    public function postIndex(Request $request)
    {
        try {
            $flow             = new Flow();
            $flow->tipo       = $request->input('type');
            $flow->id_revisao = $request->input('useCase');
            $flow->save();

            $id_fluxo = $flow->id_fluxo;

            $step                = new Step();
            $step->id_fluxo      = $id_fluxo;
            $step->identificador = $request->input('identifier');
            $step->descricao     = $request->input('description');
            $step->save();

            $id_passos = $step->id_passos;

            $complementary = $request->input('complementary', []);
            if (count($complementary) > 0) {
                
                foreach ($complementary as $value) {
                    $complementaryModel = new Complementary();
                    $pieces = explode('|', $value);

                    $complementaryModel->identificador = $pieces[0];
                    $complementaryModel->descricao     = $pieces[1];
                    $complementaryModel->save();

                    $complementaryModel->id_informacao_complementar;

                    $steps = new ComplementarySteps();
                    $steps->id_informacao_complementar = $complementaryModel->id_informacao_complementar;
                    $steps->id_passos = $id_passos;
                    $steps->save();
                }
            }

            return $this->getJsonResponse([1]);
        } catch (\Exception $exception) {
            $this->getJsonResponse([
                'data' => $exception->getMessage(),
                'error' => true,
            ]);
        }
    }

    public function putIndex($id, \Illuminate\Http\Request $request)
    {

    }
}