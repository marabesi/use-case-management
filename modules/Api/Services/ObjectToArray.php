<?php

namespace Modules\Api\Services;

trait ObjectToArray
{

    /**
     * @param $data
     * @return mixed
     */
    public function checkJsonDecode($data)
    {
        if (is_object($data)) {
            return json_decode($data, true);
        }

        return $data;
    }
}
