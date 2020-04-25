<?php

namespace Modules\Api\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

abstract class RestBaseController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     */
    abstract public function getIndex(Request $request);

    /**
     * @param \Illuminate\Http\Request $request
     */
    abstract public function postIndex(Request $request);

    /**
     * @param int $id
     */
    abstract public function deleteIndex($id);

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     */
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
