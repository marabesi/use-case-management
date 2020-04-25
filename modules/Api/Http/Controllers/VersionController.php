<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Models\Version;
use Modules\Api\Http\Controllers\RestBaseController as Controller;
use Illuminate\Http\Request;
use Modules\Api\Models\Revision;

class VersionController extends Controller
{

    /**
     * @var Modules\Api\Models\Version
     */
    private $version;

    /**
     * @var Modules\Api\Models\Revision
     */
    private $revision;

    /**
     * @param Modules\Api\Models\Version $version
     * @param Modules\Api\Models\Revision
     */
    public function __construct(Version $version, Revision $revision)
    {
        $this->version = $version;
        $this->revision = $revision;
    }

    /**
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteIndex($id)
    {
        try {
            $count = $this->revision->findByRevision($id)->count();
            
            if ($count > 0) {
                throw new \Exception('COULD_NOT_DELETE_REVISION');
            }

            $version = $this->version->find($id);
            
            if ($version) {
                $version->delete();
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
            $this->version->fetchAll($limit),
            false
        );
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
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

    /**
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
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
