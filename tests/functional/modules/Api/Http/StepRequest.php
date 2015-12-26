<?php

namespace Api\Http;

use \Modules\Api\Http\Controllers\StepController;

trait StepRequest
{

    protected function postStep()
    {
        $responseUseCase = $this->postUseCase();
        
        $requestStep = $this->call('POST', 'api/step', [
            'type' => StepController::BASIC,
            'useCase' => $responseUseCase['useCase']->data,
            'identifier' => 'STEP 1',
            'description' => 'STEP 1',
            'reference' => [
                'REF IDENT|REF DESCRIPT',
            ],
            'business' => [
                'REF BUSI|REF BUSI',
            ],
            'complementary' => [
                'REF COMP|REF COMP',
            ],
        ]);

        $response = $requestStep->getContent();

        $responseUseCase['step'] = json_decode($response);

         return $responseUseCase;
    }
}