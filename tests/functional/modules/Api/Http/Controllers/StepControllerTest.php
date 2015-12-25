<?php

namespace Tests\Functional\Modules\Api\Http\Controllers;

class StepControllerTest extends \Tests\TestCase
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

    public function testAccessStepViaRoute()
    {
        $response = $this->call('GET', 'api/step');
        $this->assertEquals(200, $response->status());
    }
}