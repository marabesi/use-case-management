<?php

namespace Api\Http;

use Modules\Api\Http\Controllers\UseCaseController;

trait UseCaseRequest
{

    protected function postUseCase()
    {
        $requestApplication = $this->call('POST', 'api/application', [
            'name' => 'App use case',
        ]);

        $responseApp = json_decode($requestApplication->getContent());

        $versionRequest = $this->call('POST', 'api/version', [
            'description' => 'Use case version',
            'version' => '1.0.0'
        ]);

        $responseVersion = json_decode($versionRequest->getContent());

        $requestActor = $this->call('POST', 'api/actor', [
            'name' => 'Use case actor',
            'description' => 'Use case actor',
        ]);

        $responseActor = json_decode($requestActor->getContent());

        $useCaseRequest = $this->call('POST', 'api/use-case', [
            'application' => $responseApp->data,
            'description' => 'Use Case Actor',
            'status' => UseCaseController::FINISHED,
            'version' => $responseVersion->data,
            'actor' => [
                $responseActor->data
            ],
        ]);

        $responseUseCase = json_decode($useCaseRequest->getContent());

        return [
            'actor' => $responseApp,
            'version' => $responseVersion,
            'actor' => $responseActor,
            'useCase' => $responseUseCase,
        ];
    }
}