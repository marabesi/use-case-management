<?php

namespace Modules\Api\Repositories;

use Modules\Api\Models\ComplementarySteps;
use Modules\Api\Models\BusinessSteps;
use Modules\Api\Models\ReferenceSteps;

class StepRepository extends Repository
{

    /**
     * {@inheritdoc}
     */
    public function model()
    {
        return 'Modules\Api\Models\Step';
    }

    /**
     * Normalize the array to present in the view
     * @param int $idStep
     * @return array
     */
    public function getDataToAngular($idStep)
    {
        $complementary = (new ComplementarySteps())->fetchAll($idStep);
        $business = (new BusinessSteps())->fetchAll($idStep);
        $reference = (new ReferenceSteps())->fetchAll($idStep);

        $max = 0;

        if (($complementary->count() > $business->count()) || $complementary->count() > $reference->count()) {
            $max = $complementary->count();
        } elseif (($business->count() > $reference->count()) || $business->count() > $complementary->count()) {
            $max = $business->count();
        } else {
            $max = $reference->count();
        }

        for ($i = 0; $i < $max; $i++) {
            $obj = new \stdClass();
            $obj->identifier = '';
            $obj->description = '';

            if (!isset($complementary[$i])) {
                $complementary->put($i, $obj);
            }

            if (!isset($business[$i])) {
                $business->put($i, $obj);
            }

            if (!isset($reference[$i])) {
                $reference->put($i, $obj);
            }
        }

        return [
            'complementary' => $complementary,
            'business' => $business,
            'reference' => $reference
        ];
    }
}
