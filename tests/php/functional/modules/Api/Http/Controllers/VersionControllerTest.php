<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

class VersionControllerTest extends \Tests\TestCase
{
    
    protected $baseUrl;

    public function testAccessVersionViaRoute()
    {
        $response = $this->call('GET', 'api/version');
        $this->assertEquals(200, $response->status());
    }

    public function testFetchAllFromVersion()
    {
        $response = $this->call('GET', 'api/version/fetch');
        $this->assertEquals(200, $response->status());

        $this->get('api/version/fetch')
            ->dontSeeJson([
                'error' => true
            ]);
    }

    public function testCreateNewVersion()
    {
        $this->post('api/version', [
            'description' => 'Test new version',
            'version' => '1.0.0'
        ])->seeJson([
            'error' => false
        ]);
    }

    public function testUpdateVersion()
    {
        $response = $this->postVersion();

        $this->assertFalse($response->error);

        $this->put('api/version/' . $response->data, [
            'descricao' => 'Test update version',
            'versao' => '2.0.0',
        ])->seeJson([
            'data' => (string) $response->data,
            'error' => false
        ]);
    }

    public function testDeleteVersion()
    {
        $response = $this->postVersion();

        $this->assertFalse($response->error);

        $this->delete('api/version/' . $response->data)
            ->seeJson([
            'data' => (string) $response->data,
            'error' => false
        ]);
    }

    protected function postVersion()
    {
        $request = $this->call('POST', 'api/version', [
            'description' => 'Test delete version',
            'version' => '2.0.0'
        ]);

        return json_decode($request->getContent());
    }
}