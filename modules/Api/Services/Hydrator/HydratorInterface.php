<?php

namespace Modules\Api\Services\Hydrator;

use Illuminate\Support\Collection;

interface HydratorInterface
{
    public function hydrate(Collection $collection);
}
