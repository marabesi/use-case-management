<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Models\UseCase;
use Modules\Api\Models\Revision;
use Modules\Api\Models\RevisionActors;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;
use Modules\Api\Services\ObjectToArray;

class UseCaseController extends Controller
{
    use ObjectToArray;

    const FINISHED    = 1;
    const DELETED     = 2;
    const DEVELOPMENT = 3;
    const PENDENT     = 4;

    /**
     * @var \Modules\Api\Models\UseCase
     */
    private $useCase;

    /**
     * @var \Modules\Api\Models\Revision
     */
    private $revision;

    /**
     * @var \Modules\Api\Models\RevisionActors
     */
    private $revisionActors;

    /**
     * @param \Modules\Api\Models\UseCase $useCase
     * @param \Modules\Api\Models\Revision $revision
     * @param \Modules\Api\Models\RevisionActors $revisionActors
     */
    public function __construct(
        UseCase $useCase,
        Revision $revision,
        RevisionActors $revisionActors
    ) {
        $this->useCase        = $useCase;
        $this->revision       = $revision;
        $this->revisionActors = $revisionActors;
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteIndex($id)
    {
        list($idUseCase, $actor) = explode(',', $id);

        $revision = $this->useCase->find($idUseCase)->revision();

        if ($revision) {
            $actors = $this->revisionActors->findByRevision($actor);
//             $actors = $this->revisionActors->find($actor)->revision();
            $actors->delete();

            $revision->delete();

            $useCase = $this->useCase->find($idUseCase);
            $useCase->delete();
        }

        return $this->getJsonResponse(
            $id
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndex(Request $request)
    {
        $limit = $request->input('limit', \Modules\Api\Models\Base::DEFAULT_LIMIT);

        // ensures what we get from json_decode is an array
        $filter = $this->checkJsonDecode(
            json_decode($request->input('filter', '{}'), true)
        );

        return $this->getJsonResponse(
            $this->useCase->fetchAll($limit, $filter),
            false
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postIndex(Request $request)
    {
        $useCase = new UseCase();

        $useCase->id_sistema = $request->input('application');
        $useCase->descricao = $request->input('description');
        $useCase->status = $request->input('status');
        $useCase->pre_condicao = $request->input('preCondition');
        $useCase->pos_condicao = $request->input('posCondition');
        $useCase->save();

        $idUseCase = $useCase->id_caso_de_uso;

        $revision = new Revision();
        $revision->id_dados_revisao = $request->input('version');
        $revision->id_caso_de_uso = $idUseCase;
        $revision->save();

        $id_revisao = $revision->id_revisao;

        foreach ($request->input('actor', []) as $actor) {
            $revisionActors = new RevisionActors();
            $revisionActors->id_revisao = $id_revisao;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function putIndex($id, Request $request)
    {
        $useCase = $this->useCase->find($id);

        if ($useCase) {
            $useCase->id_sistema = $request->input('id_sistema');
            $useCase->descricao = $request->input('descricao');
            $useCase->status = $request->input('status');
            $useCase->pre_condicao = $request->input('pre_condicao');
            $useCase->pos_condicao = $request->input('pos_condicao');
            $useCase->save();

            $id_revisao = $request->input('id_revisao');
            $findRevision = $this->revision->find($id_revisao);
            
            $findRevision->id_dados_revisao = $request->input('id_dados_revisao');
            $findRevision->id_caso_de_uso = $id;
            $findRevision->save();

            $findActor = $this->revisionActors->findByRevision($request->input('id_revisao'));
            $findActor->delete();
            
            foreach ($request->input('id_ator', []) as $id) {
                $r = new RevisionActors();
                $r->id_dados_revisao = $request->input('id_dados_revisao');
                $r->id_ator = $id;
                $r->id_revisao = $id_revisao;
                $r->save();
            }
        }

        return $this->getJsonResponse(
            $id
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFetch($id)
    {
        return $this->getJsonResponse(
            $this->useCase->getByRevision($id)->get(),
            false
        );
    }
    
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFetchUseCase($id, $revision)
    {
        return $this->getJsonResponse(
            $this->useCase->fetchUseCase($id, $revision),
            false
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFetchAllUseCase()
    {
        return $this->getJsonResponse(
            $this->useCase->getAllUseCases()->get(),
            false
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTotalNotDeleted()
    {
        return $this->getJsonResponse(
            $this->useCase->where('status', '!=', self::DELETED)->count()
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTotalDeleted()
    {
        return $this->getJsonResponse(
            $this->useCase->where('status', '=', self::DELETED)->count()
        );
    }
}
