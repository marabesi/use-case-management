<?php

namespace Modules\Api\Repositories;

class ReferenceRepository extends Repository
{

    /**
     * {@inheritdoc}
     */
    function model()
    {
        return '\Modules\Api\Models\Reference';
    }
}