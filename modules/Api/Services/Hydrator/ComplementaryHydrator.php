<?php

namespace Modules\Api\Services\Hydrator;

use Illuminate\Support\Collection;

class ComplementaryHydrator implements HydratorInterface
{

    public function hydrate(Collection $collection)
    {
        $newCollection = new Collection();

        foreach ($collection as $array) {
            $obj = new \stdClass();
            $obj->id = $array['id_informacao_complementar'];
            $obj->identifier = $array['identificador'];
            $obj->description = $array['descricao'];

            $newCollection->push($obj);
        }

        return $newCollection;
    }
}