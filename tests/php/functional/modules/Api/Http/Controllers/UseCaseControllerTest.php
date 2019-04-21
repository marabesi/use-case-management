<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

use Api\Http\UseCaseRequest;
use Tests\TestCase;

class UseCaseControllerTest extends TestCase
{
    use UseCaseRequest;

    protected $baseUrl;

    public function testAccessUseCaseViaRoute()
    {
        $response = $this->call('GET', 'api/use-case');
        $this->assertEquals(200, $response->status());
    }

    public function testShouldPostNewUseCase()
    {
        $useCaseResponse = $this->postUseCase();
        
        $this->assertFalse($useCaseResponse['useCase']->error);
    }

    public function testShouldDeleteUseCase()
    {
        $useCaseResponse = $this->postUseCase();

        $id = $useCaseResponse['useCase']->data . ',' . $useCaseResponse['actor']->data;

        $this->delete('api/use-case/' . $id)->seeJson([
            'data' => $id,
            'error' => false
        ]);
    }

    public function testShouldReturnUseCasesNotDeleted()
    {
        $this->get('api/use-case/total-not-deleted')->seeJson([
            'error' => false
        ]);
    }

    public function testShouldReturnUseCasesDeleted()
    {
        $this->get('api/use-case/total-deleted')->seeJson([
            'error' => false
        ]);
    }
}
