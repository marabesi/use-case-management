<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

use Api\Http\ApplicationRequest;
use Api\Http\UseCaseRequest;

class ApplicationControllerTest extends \Tests\TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;
    use ApplicationRequest;
    use UseCaseRequest;
    
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

    public function testAccessApplicationViaRoute()
    {
        $response = $this->call('GET', 'api/application');
        $this->assertEquals(200, $response->status());
    }

    public function testFetchAllFromApplication()
    {
        $response = $this->call('GET', 'api/application/fetch');
        $this->assertEquals(200, $response->status());

        $this->get('api/application/fetch')
            ->dontSeeJson([
                'error' => true
            ]);
    }

    public function testCreateNewApplication()
    {
        $this->post('api/application', [
            'name' => 'Test Application'
        ])->seeJson([
            'error' => false
        ]);
    }

    public function testUpdateApplication()
    {
        $response = $this->postApplication();

        $this->assertFalse($response->error);

        $this->put('api/application/' . $response->data, [
            'nome' => 'Updated title'
        ])->seeJson([
            'data' => (string) $response->data,
            'error' => false
        ]);
    }

    public function testUpdateApplicationWhenItNotExists()
    {
        $this->put('api/application/99918', [
            'nome' => 'Updated title'
        ])->seeJson([
            'data' => (string) 'COULD_NOT_FIND_APPLICATION',
            'error' => true
        ]);
    }

    public function testDeleteApplication()
    {
        $response = $this->postApplication();

        $this->assertFalse($response->error);

        $this->delete('api/application/' . $response->data)
            ->seeJson([
            'data' => (string) $response->data,
            'error' => false
        ]);
    }

    public function testShouldNotAllowDeleteWhenItHasRelations()
    {
//        $responseUseCase = $this->postUseCase();
//
//        $this->assertFalse($responseUseCase->error);

//        $this->delete('api/application/' . $response->data)
//            ->seeJson([
//                'data' => (string) $response->data,
//                'error' => true
//            ]);
    }
}