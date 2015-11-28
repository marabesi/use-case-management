<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Models\UseCase;
use Modules\Api\Models\Revision;
use Modules\Api\Models\RevisionActors;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;

class UseCaseController extends Controller {

    /**
     * @var Modules\Api\Models\UseCase
     */
    private $useCase;

    /**
     * @var Modules\Api\Models\Revision
     */
    private $revision;

    /**
     * @var Modules\Api\Models\RevisionActors
     */
    private $revisionActors;

    /**
     * @param Modules\Api\Models\UseCase $useCase
     * @param Modules\Api\Models\Revision $revision
     */
    public function __construct(
        UseCase $useCase,
        Revision $revision,
        RevisionActors $revisionActors)
    {
        $this->useCase        = $useCase;
        $this->revision       = $revision;
        $this->revisionActors = $revisionActors;
    }

    /**
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteIndex($id)
    {
        list($idUseCase, $actor) = explode(',', $id);

        $revision = $this->revision->findByUseCase($idUseCase);

        if ($revision) {
            $actors = $this->revisionActors->find($actor);
            $actors->delete();

            $revision->delete();

            $useCase = $this->useCase->find($id);
            $useCase->delete();
        }

        return $this->getJsonResponse(
            $id
        );
    }

    /**
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function getIndex(Request $request)
    {
        $limit = $request->input('limit', \Modules\Api\Models\Base::DEFAULT_LIMIT);

        return $this->getJsonResponse(
            $this->useCase->fetchAll($limit),
            false
        );
    }

    /**
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function postIndex(Request $request)
    {
        $useCase = new UseCase();

        $useCase->id_sistema = $request->input('application');
        $useCase->descricao = $request->input('description');
        $useCase->status = $request->input('status');
        $useCase->save();

        $idUseCase = $useCase->id_caso_de_uso;

        $revision = new Revision();
        $revision->id_dados_revisao = $request->input('version');
        $revision->id_caso_de_uso = $idUseCase;
        $revision->save();

        foreach ($request->input('actor', []) as $actor) {
            $revisionActors = new RevisionActors();
            $revisionActors->id_ator = $actor;
            $revisionActors->id_dados_revisao = $request->input('version');
            $revisionActors->save();
        }
        
        return $this->getJsonResponse(
            $idUseCase
        );
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function putIndex($id, Request $request)
    {
        $useCase = $this->useCase->find($id);

        if ($useCase) {
            $useCase->id_sistema = $request->input('id_sistema');
            $useCase->descricao = $request->input('descricao');
            $useCase->status = $request->input('status');
            $useCase->save();

            $id_revisao = $request->input('id_revisao');
            $findRevision = $this->revision->find($id_revisao);
            
            $findRevision->id_dados_revisao = $request->input('id_dados_revisao');
            $findRevision->id_caso_de_uso = $id;
            $findRevision->save();

            $id_relacionamento_dados_revisao = $request->input('id_relacionamento_dados_revisao');
            $findActor = $this->revisionActors->find($id_relacionamento_dados_revisao);
            $findActor->id_ator = $request->input('id_ator');
            $findActor->save();
        }

        return $this->getJsonResponse(
            $id
        );
    }
}