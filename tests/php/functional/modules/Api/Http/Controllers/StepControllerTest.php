<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

use \Modules\Api\Http\Controllers\StepController;

class StepControllerTest extends \Tests\TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;
    use \Api\Http\UseCaseRequest;
    use \Api\Http\StepRequest;
    use \Api\Http\ApplicationRequest;

    protected $baseUrl;

    public function setUp()
    {
        parent::setUp();

        $this->baseUrl = url();
    }

    public function tearDown()
    {
        $this->baseUrl = null;
    }

    public function testAccessStepViaRoute()
    {
        $response = $this->call('GET', 'api/step');
        $this->assertEquals(200, $response->status());
    }

    public function testShouldSeeJsonWithPagination()
    {
        $this->get('api/step')
            ->seeJson([
                'current_page' => 1,
                'prev_page_url' => null,
                'from' => 1,
            ]);
    }

    public function testShouldPostAstep()
    {
        $responseUseCase = $this->postUseCase();

        $responseApplication = $this->postApplication();

        $this->post('api/step', [
            'application' => $responseApplication['data'],
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
        ])->seeJson([
            'error' => false
        ]);
    }

    public function testShouldUpdateAstep()
    {
        $decodedResponse = $this->postStep();

        $this->assertFalse($decodedResponse['step']->error);

        $this->put('api/step/' . $decodedResponse['step']->data, [
            'type' => StepController::EXCEPTION,
            'useCase' => $decodedResponse['useCase']->data,
            'identifier' => 'STEP 1 UPDATE',
            'description' => 'STEP 1 UPDATE',
            'reference' => [
                'REF IDENT UPDATE|REF DESCRIPT UPDATE',
            ],
            'business' => [
                'REF BUSI UPDATE|REF BUSI UPDATE',
            ],
            'complementary' => [
                'REF COMP UPDATE|REF COMP UPDATE',
            ],
        ])->seeJson([
            'data' => $decodedResponse['step']->data,
            'error' => false
        ]);
    }

    public function testShouldDeleteAstep()
    {
        $decodedResponse = $this->postStep();

        $this->delete('api/step/' . $decodedResponse['step']->data)
            ->seeJson([
                'data' => $decodedResponse['step']->data,
                'error' => false
            ]);
    }

    public function testShouldFetchAllStepsRelationships()
    {
        $decodedResponse = $this->postStep();

        list($id_passos) = explode(',', $decodedResponse['step']->data);
       
        $this->get('api/step/fetch/' . $id_passos)
            ->dontSeejson([
                'error' => true
            ]);
    }

    public function testShouldSaveJustComplementaryInformation()
    {
        $responseUseCase = $this->postUseCase();

        $this->post('api/step', [
            'type' => StepController::BASIC,
            'useCase' => $responseUseCase['useCase']->data,
            'identifier' => 'STEP 1',
            'description' => 'STEP 1',
            'complementary' => [
                'REF COMP|REF COMP',
            ],
        ])->seeJson([
            'error' => false
        ]);
    }
}