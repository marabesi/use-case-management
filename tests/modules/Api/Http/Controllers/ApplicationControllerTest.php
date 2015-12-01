<?php

namespace Tests\Modules\Api\Http\Controllers;

class ApplicationControllerTest extends \Tests\TestCase
{

    protected $baseUrl;

    public function setUp()
    {
        parent::setUp();

        $this->baseUrl = url();
    }

    public function testAccessApplication()
    {
        $response = $this->call('GET', 'api/application');
        $this->assertResponseStatus($response->status());
    }

    public function testShouldCreateAnewApplication()
    {
        $this->post('/api/application', ['name' => 'hello'])
            ->seeJson([
                'error' => false,
            ]);
    }
}