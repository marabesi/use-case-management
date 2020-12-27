<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

use Tests\TestCase;
use Api\Http\UseCaseRequest;

class ActorControllerTest extends TestCase
{
    protected $baseUrl = 'api/actor?';

    use UseCaseRequest;

    public function testAccessActorsViaRoute()
    {
        $response = $this->call('GET', $this->baseUrl);
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
        $this->post($this->baseUrl, [
            'name' => 'Test actor',
            'description' => 'Test description'
        ])->seeJson([
            'error' => false
        ]);
    }

//    public function testUpdateActor()
//    {
//        $response = $this->postActor();
//        $this->assertFalse($response->error);
//        $this->put('api/actor/' . $response->data, [
//            'nome' => 'new name actor',
//            'descricao' => 'new description actor'
//        ])->seeJson([
//            'data' => (string) $response->data,
//            'error' => false
//        ]);
//    }
//
//    public function testDeleteActor()
//    {
//        $response = $this->postActor();
//
//        $this->assertFalse($response->error);
//
//        $this->delete('api/actor/' . $response->data)
//            ->seeJson([
//                'data' => (string) $response->data,
//                'error' => false
//            ]);
//    }
//
//    public function testShouldNotDeleteWhenActorHasRelationWithAnotherTable()
//    {
//        $useCaseResponse = $this->postUseCase();
//
//        $this->assertFalse($useCaseResponse['useCase']->error);
//
//        $deleteActor = $this->call('DELETE', 'api/actor/' . $useCaseResponse['actor']->data);
//        $deleteResponse = json_decode($deleteActor->getContent());
//
//        $this->assertTrue($deleteResponse->error);
//        $this->assertEquals('COULD_NOT_DELETE_ACTOR', $deleteResponse->data);
//    }

    public function postActor()
    {
        $request = $this->call('POST', $this->baseUrl, [
            'name' => 'Test delete actor',
            'description' => 'Test delete actor'
        ]);

        return json_decode($request->getContent());
    }
}
