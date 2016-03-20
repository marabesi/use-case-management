<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Repositories\ApplicationRepository;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;
use Modules\Api\Repositories\UseCaseRepository;

class ApplicationController extends Controller {

    /**
     * @var \Modules\Api\Repositories\ApplicationRepository
     */
    private $application;

    /**
     * @var \Modules\Api\Repositories\UseCaseRepository
     */
    private $useCaseRepository;

    /**
     * @param \Modules\Api\Repositories\ApplicationRepository
     * @param \Modules\Api\Repositories\UseCaseRepository
     */
    public function __construct(ApplicationRepository $application, UseCaseRepository $useCaseRepository)
    {
        $this->application = $application;
        $this->useCaseRepository = $useCaseRepository;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteIndex($id)
    {
        $find = $this->useCaseRepository->getModel()->where('id_sistema', $id);

        if ($find->count() > 0) {
            throw new \Exception('COULD_NOT_DELETE');
        }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFetch()
    {
        return $this->getJsonResponse(
            $this->application->fetchAllWithOutPagination(),
            false
        );
    }
}