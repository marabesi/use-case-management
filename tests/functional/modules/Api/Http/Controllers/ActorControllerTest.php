<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

class ActorControllerTest extends \Tests\TestCase
{
    
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

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

    public function testAccessActorsViaRoute()
    {
        $response = $this->call('GET', 'api/actor');
        $this->assertEquals(200, $response->status());
    }

    public function testFetchAllFromActors()
    {
        $response = $this->call('GET', 'api/actor/fetch');
        $this->assertEquals(200, $response->status());

        $this->get('api/actor/fetch')
            ->dontSeeJson([
                'error' => true
            ]);
    }

    public function testCreateNewActor()
    {
        $this->post('api/actor', [
            'name' => 'Test actor',
            'description' => 'Test description'
        ])->seeJson([
            'error' => false
        ]);
    }

    public function testUpdateActor()
    {
        $response = $this->postActor();
        
        $this->assertFalse($response->error);

        $this->put('api/actor/' . $response->data, [
            'nome' => 'new name actor',
            'descricao' => 'new description actor'
        ])->seeJson([
            'data' => (string) $response->data,
            'error' => false
        ]);
    }

    public function testDeleteActor()
    {
        $response = $this->postActor();

        $this->assertFalse($response->error);

        $this->delete('api/actor/' . $response->data)
            ->seeJson([
            'data' => (string) $response->data,
            'error' => false
        ]);
    }

    public function testShouldNotDeleteWhenActorhasRelationWithAnotherTable()
    {
//        $requestActor = $this->call('POST', 'api/actor', [
//            'name' => 'Test delete actor',
//            'description' => 'Test delete actor'
//        ]);
//
//        $responseActor = json_decode($requestActor->getContent());
//
//        $idActor = $responseActor = $responseActor->data;
//
//        $requestActor = $this->call('POST', 'api/use-case', [
//            'name' => 'Test delete actor',
//            'description' => 'Test delete actor'
//        ]);
    }

    public function postActor()
    {
        $request = $this->call('POST', 'api/actor', [
            'name' => 'Test delete actor',
            'description' => 'Test delete actor'
        ]);

        return json_decode($request->getContent());
    }
}