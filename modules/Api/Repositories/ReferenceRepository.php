<?php

namespace Modules\Api\Repositories;

class ReferenceRepository extends Repository
{

    /**
     * {@inheritdoc}
     */
    public function model()
    {
        return '\Modules\Api\Models\Reference';
    }
}
