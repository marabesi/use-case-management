<?php namespace Modules\Api\Http\Controllers;

use Modules\Api\Models\Version;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;

class VersionController extends Controller {

    /**
     * @var Modules\Api\Models\Version
     */
    private $version;

    /**
     * @param Modules\Api\Models\Version $version
     */
    public function __construct(Version $version)
    {
        $this->version = $version;
    }
    
    public function deleteIndex($id)
    {
        $version = $this->version->find($id);

        if ($version) {
            $version->delete();
        }

        return $this->getJsonResponse(
            $id
        );
    }

    public function getIndex(Request $request)
    {
        $limit = $request->input('limit', \Modules\Api\Models\Base::DEFAULT_LIMIT);

        return $this->getJsonResponse(
            $this->version->fetchAll($limit),
            false
        );
    }

    public function postIndex(Request $request)
    {
        $version = new Version();

        $version->descricao = $request->input('description');
        $version->versao = $request->input('version');
        $version->save();

        return $this->getJsonResponse(
            $version->id_dados_revisao
        );
    }

    public function putIndex($id, Request $request)
    {
        $version = $this->version->find($id);

        if ($version) {
            foreach ($request->input() as $key => $value) {
                $version->$key = $value;
            }

            $version->save();
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
            $this->version->get(),
            false
        );
    }
}