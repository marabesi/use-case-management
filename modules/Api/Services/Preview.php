<?php

namespace Api\Services;

class Preview
{

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPreview($id, UseCaseRepository $useCaseRepository)
    {
        $revision = new Revision();
        $revisionActors = new RevisionActors();

        $complementary = new \Modules\Api\Models\ComplementarySteps();
        $business = new \Modules\Api\Models\BusinessSteps();
        $reference = new \Modules\Api\Models\ReferenceSteps();

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

                        $flow = $this->flow->where('id_revisao', $revisionData['id_revisao'])->get()->toArray();

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

        return $this->getJsonResponse(
            $result,
            false
        );
    }
}
