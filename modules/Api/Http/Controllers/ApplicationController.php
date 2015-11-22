<?php namespace Modules\Api\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Api\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApplicationController extends Controller {

    /**
     * @var Modules\Api\Models\Application
     */
    private $application;

    /**
     * @param Modules\Api\Models\Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function getIndex(Request $request)
    {
        $limit = $request->input('limit', Application::DEFAULT_LIMIT);

        return new JsonResponse(
            $this->application->fetchAll($limit)
        );
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function postIndex(Request $request)
    {
        $application = new Application();

        $application->nome = $request->input('name');
        $application->save();

        return new JsonResponse(
            $application->id_sistema
        );
    }

    /**
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteIndex($id)
    {
        $model = $this->application->find($id);

        if ($model) {
            $model->delete();
        }

        return new JsonResponse(
            $id
        );
    }

    /**
     * @param int $id
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function putIndex($id, Request $request) {
        $application = $this->application->find($id);

        if ($application) {
            foreach ($request->input() as $key => $value) {
                $application->$key = $value;
            }

            $application->save();
        }

        return new JsonResponse(
            $id
        );
    }
}