<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Models\Actor;
use Modules\Api\Models\RevisionActors;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;

class ActorController extends Controller {

    /**
     * @var Modules\Api\Models\Actor
     */
    private $actor;

    /**
     * @var Modules\Api\Models\RevisionActors
     */
    private $revisionActor;
    
    /**
     * @param Modules\Api\Models\Actor $actor
     */
    public function __construct(Actor $actor, RevisionActors $revisionActors)
    {
        $this->actor = $actor;
        $this->revisionActor = $revisionActors;
    }

    /**
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteIndex($id)
    {
        try {
            $count = $this->revisionActor->findByActor($id)->count();
            if ($count > 0) {
                throw new \Exception('COULD_NOT_DELETE_ACTOR');
            }
            
            $actor = $this->actor->find($id);

            if ($actor) {
                $actor->delete();
            }

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
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function getIndex(Request $request)
    {
        $limit = $request->input('limit', \Modules\Api\Models\Base::DEFAULT_LIMIT);

        return $this->getJsonResponse(
            $this->actor->fetchAll($limit),
            false
        );
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function postIndex(Request $request)
    {
        $application = new Actor();

        $application->nome = $request->input('name');
        $application->descricao = $request->input('description');
        $application->save();

        return $this->getJsonResponse(
            $application->id_ator
        );
    }

    /**
     * @param int $id
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function putIndex($id, Request $request)
    {
        $actor = $this->actor->find($id);

        if ($actor) {
            foreach ($request->input() as $key => $value) {
                $actor->$key = $value;
            }

            $actor->save();
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
            $this->actor->get(),
            false
        );
    }
}