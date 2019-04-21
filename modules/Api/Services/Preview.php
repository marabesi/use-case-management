<?php

namespace Modules\Api\Services;

use Modules\Api\Models\Application;
use Modules\Api\Models\BusinessSteps;
use Modules\Api\Models\ComplementarySteps;
use Modules\Api\Models\ReferenceSteps;
use Modules\Api\Models\Revision;
use Modules\Api\Models\RevisionActors;
use Modules\Api\Repositories\UseCaseRepository;

class Preview
{

    /**
     * @param int $id
     * @return array
     */
    public function getPreview($id, UseCaseRepository $useCaseRepository)
    {
        $revision = new Revision();
        $revisionActors = new RevisionActors();

        $complementary = new ComplementarySteps();
        $business = new BusinessSteps();
        $reference = new ReferenceSteps();

        $result = [];

        $app = new Application();
        $array = $app->where('id_sistema', $id)->get();

        foreach ($array as $application) {
            $u = $useCaseRepository->findByIdSistema($application->id_sistema);

            $a = $u->get()->toArray();

            $result['app'] = $application->toArray();

            foreach ($a as $useCaseMaroto) {
                $arrayU = $u->get()->toArray();

                foreach ($arrayU as $key => $singleUseCase) {
                    $result['app']['useCase'][$key] = $singleUseCase;

                    $revisionA = $revision->findByUseCase($singleUseCase['id_caso_de_uso'])->get()->toArray();

                    foreach ($revisionA as $revisionData) {
                        $result['app']['useCase'][$key]['revision'] = $revisionData;

                        $result['app']['useCase'][$key]['revision']['actors'] = $revisionActors->findActorByRevision($revisionData['id_revisao'])->get()->toArray();

                        $compl = $complementary->findByUseCase($singleUseCase['id_caso_de_uso']);
                        $bus = $business->findByUseCase($singleUseCase['id_caso_de_uso']);
                        $ref = $reference->findByUseCase($singleUseCase['id_caso_de_uso']);

                        $result['app']['useCase'][$key]['revision']['flow'][] = [
                            'complementary' => $compl,
                            'business' => $bus,
                            'reference' => $ref
                        ];
                    }
                }
            }
        }

        return $result;
    }
}
