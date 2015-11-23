<?php namespace Modules\Api\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

abstract class RestBaseController extends Controller {

    abstract public function getIndex(Request $request);

    abstract public function postIndex(Request $request);

    abstract public function deleteIndex($id);

    abstract public function putIndex($id, Request $request);

    /**
     * @param mixed $data
     * @param bool $default
     * @return JsonResponse
     */
    public function getJsonResponse($data, $default = true)
    {
        if (!$default) {
            return new JsonResponse($data);
        }

        $baseContent = [
            'data' => $data,
            'error' => false,
        ];

        return new JsonResponse($baseContent);
    }
}