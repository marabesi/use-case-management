<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

class UseCaseControllerTest extends \Tests\TestCase
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

    public function testAccessUseCaseViaRoute()
    {
        $response = $this->call('GET', 'api/use-case');
        $this->assertEquals(200, $response->status());
    }
}