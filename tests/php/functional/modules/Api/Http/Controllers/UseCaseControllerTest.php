<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

class UseCaseControllerTest extends \Tests\TestCase
{
    
    use \Illuminate\Foundation\Testing\DatabaseTransactions;
    use \Api\Http\UseCaseRequest;

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
}