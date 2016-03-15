<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;
use Modules\Api\Models\Flow;
use Modules\Api\Models\Step;
use Modules\Api\Models\Complementary;
use Modules\Api\Models\Business;
use Modules\Api\Models\Reference;
use Modules\Api\Models\Application;
use Modules\Api\Repositories\ComplementaryRepository;
use Modules\Api\Repositories\StepRepository;
use Modules\Api\Repositories\UseCaseRepository;
use Modules\Api\Models\Revision;
use Modules\Api\Models\RevisionActors;

class StepController extends Controller
{
    const BASIC       = 1;
    const ALTERNATIVE = 2;
    const EXCEPTION   = 3;

    /**
     * @var \Modules\Api\Models\Flow
     */
    private $flow;

    /**
     * @var \Modules\Api\Models\Step
     */
    private $step;

    /**
     * @var StepRepository
     */
    private $stepRepository;

    /**
     * @param \Modules\Api\Models\Flow $flow
     * @param \Modules\Api\Models\Step
     */
    public function __construct(Flow $flow, Step $step, StepRepository $stepRepository)
    {
        $this->flow = $flow;
        $this->step = $step;
        $this->stepRepository = $stepRepository;
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteIndex($id)
    {
        try {
            list($id_passos, $id_fluxo) = explode(',', $id);

            $this->step->deleteAll($id_passos, $id_fluxo);

            return $this->getJsonResponse($id);
        } catch (\Exception $exception) {
            return $this->getJsonResponse([
                'data' => $exception->getMessage(),
                'error' => true
            ], false);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndex(Request $request)
    {
        $limit = $request->input('limit', \Modules\Api\Models\Base::DEFAULT_LIMIT);
        $filter = json_decode($request->input('filter', '{}'), true);

        return $this->getJsonResponse(
            $this->step->fetchAll($limit, $filter),
            false
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postIndex(Request $request)
    {
        try {
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

            $id_passos = $step->id_passos;

            $id_sistema = $request->input('application');

            $complementary = new Complementary();
            $complementary->newSave($request->input('complementary', []), $id_passos, $id_sistema);

            $business = new Business();
            $business->newSave($request->input('business', []), $id_passos, $id_sistema);

            $reference = new Reference();
            $reference->newSave($request->input('reference', []), $id_passos, $id_sistema);

            return $this->getJsonResponse(
                $id_passos . ',' . $id_fluxo
            );
        } catch (\Exception $exception) {
            return $this->getJsonResponse([
                'data' => $exception->getMessage(),
                'error' => true
            ], false);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFetch($id)
    {
        return $this->getJsonResponse(
            $this->stepRepository->getDataToAngular($id),
            false
        );
    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function putIndex($id, \Illuminate\Http\Request $request)
    {
        try {
            list($id_passos, $id_fluxo) = explode(',', $id);

            if (!is_numeric($id_passos) || !is_numeric($id_fluxo)) {
                throw new \InvalidArgumentException('Invalid argument');
            }

            $this->updateFlow($id_fluxo, $request);
            $this->updateStep($id_passos, $request);

            $this->step->updateComplementaryRows(
                $id_passos,
                $request->input('complementary', [])
            );

            $this->step->updateBusinessRows(
                $id_passos,
                $request->input('business', [])
            );

            $this->step->updateReferenceRows(
                $id_passos,
                $request->input('reference', [])
            );

            return $this->getJsonResponse(
                sprintf('%d,%d', $id_passos, $id_fluxo)
            );
        } catch (\Exception $exception) {
            \Log::error($exception->getTraceAsString());

            return $this->getJsonResponse([
                'data' => $exception->getMessage(),
                'error' => true
            ], false);
        }
    }
    
    /**
     * @param int $id_fluxo
     * @param Request $request
     */
    protected function updateFlow($id_fluxo, Request $request)
    {
        $fluxo = $this->flow->find($id_fluxo);
        $fluxo->tipo = $request->input('type');
        $fluxo->id_revisao = $request->input('useCase');
        $fluxo->save();
    }

    /**
     * @param int $id_passos
     * @param Request $request
     */
    protected function updateStep($id_passos, Request $request)
    {
        $passos = $this->step->find($id_passos);
        $passos->identificador = $request->input('identifier');
        $passos->descricao = $request->input('description');
        $passos->save();
    }

    protected function updateApplication($id_fluxo) {
        $fluxo = $this->flow->find($id_fluxo);

        $revisao = (new Revision())->find($fluxo->id_revisao);
    }

    /**
     * @param $id
     * @param ComplementaryRepository $repository
     * @return mixed
     */
    public function getComplementary($id, ComplementaryRepository $repository)
    {
        return $repository->findBy('id_sistema', $id);
    }

}