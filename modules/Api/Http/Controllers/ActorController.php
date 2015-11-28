<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Models\Actor;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;

class ActorController extends Controller {

    /**
     * @var Modules\Api\Models\Actor
     */
    private $actor;

    /**
     * @param Modules\Api\Models\Actor $actor
     */
    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }

    public function deleteIndex($id)
    {
        $actor = $this->actor->find($id);

        if ($actor) {
            $actor->delete();
        }

        return $this->getJsonResponse(
            $id
        );
    }

    public function getIndex(Request $request)
    {
        $limit = $request->input('limit', \Modules\Api\Models\Base::DEFAULT_LIMIT);

        return $this->getJsonResponse(
            $this->actor->fetchAll($limit),
            false
        );
    }

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