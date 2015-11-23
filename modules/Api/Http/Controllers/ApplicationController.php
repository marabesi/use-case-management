<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Models\Application;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;

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
        $limit = $request->input('limit', \Modules\Api\Models\Base::DEFAULT_LIMIT);

        return $this->getJsonResponse(
            $this->application->fetchAll($limit),
            false
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

        return $this->getJsonResponse(
            $application->id_sistema
        );
    }

    /**
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteIndex($id)
    {
        $application = $this->application->find($id);

        if ($application) {
            $application->delete();
        }

        return $this->getJsonResponse(
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

        return $this->getJsonResponse(
            $id
        );
    }

    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function getFetch()
    {
        return $this->getJsonResponse(
            $this->application->get(),
            false
        );
    }
}