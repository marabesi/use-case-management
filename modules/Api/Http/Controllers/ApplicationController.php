<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Repositories\ApplicationRepository;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller {

    /**
     * @var Modules\Api\Repositories\ApplicationRepository
     */
    private $application;

    /**
     * @param Modules\Api\Repositories\ApplicationRepository
     */
    public function __construct(ApplicationRepository $application)
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

        $sorting = json_decode($request->input('sorting', '[]'), true);

        return $this->getJsonResponse(
            $this->application->fetchAll($limit, $sorting),
            false
        );
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function postIndex(Request $request)
    {
        $application = $this->application->create([
            'nome' => $request->input('name')
        ]);

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
        try {
            $application = $this->application->find($id);

            if(!$application) {
                throw new \Exception('COULD_NOT_FIND_APPLICATION');
            }

            foreach ($request->input() as $key => $value) {
                $application->$key = $value;
            }

            $application->save();

            return $this->getJsonResponse(
                $id
            );
        } catch (\Exception $exception) {
            return $this->getJsonResponse([
                'data' => $exception->getMessage(),
                'error' => true
            ], false);
        }
    }

    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function getFetch()
    {
        return $this->getJsonResponse(
            $this->application->fetchAllWithOutPagination(),
            false
        );
    }
}