<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Models\UseCase;
use Modules\Api\Models\Revision;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;

class UseCaseController extends Controller {

    private $useCase;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function deleteIndex($id)
    {
        $useCase = $this->useCase->find($id);

        if ($useCase) {
            $useCase->delete();
        }

        return $this->getJsonResponse(
            $id
        );
    }

    public function getIndex(Request $request)
    {
        $limit = $request->input('limit', \Modules\Api\Models\Base::DEFAULT_LIMIT);

        return $this->getJsonResponse(
            $this->useCase->fetchAll($limit),
            false
        );
    }

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

        return $this->getJsonResponse(
            $idUseCase
        );
    }

    public function putIndex($id, Request $request)
    {
        $useCase = $this->useCase->find($id);
        
        if ($useCase) {
            $useCase->id_sistema = $request->input('application');
            $useCase->descricao = $request->input('description');
            $useCase->status = $request->input('status');
            $useCase->save();

            $id_dados_revisao = $request->input('version');

            $revision = new Revision();
            $revision->find($id_dados_revisao);
            
            $revision->id_dados_revisao = $request->input('version');
            $revision->id_caso_de_uso = $id;
            $revision->save();
        }

        return $this->getJsonResponse(
            $id
        );
    }
}