<?php

namespace Tests\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Api\Http\Controllers\ApplicationController;

class ApplicationControllerTest extends \Tests\TestCase
{

    protected $baseUrl;
    private $application;

    public function setUp()
    {
        parent::setUp();

        $this->baseUrl = url();
        $this->application = $this->getMock('Modules\Api\Models\Application');
    }

    public function tearDown()
    {
        $this->application = null;
    }

    public function testAccessApplicationViaRoute()
    {
        $response = $this->call('GET', 'api/application');
        $this->assertEquals(200, $response->status());
    }

    public function testShouldCallModelWithDefaultPaginationLimit()
    {
        $this->application->expects($this->once())
            ->method('fetchAll')
            ->with(\Modules\Api\Models\Base::DEFAULT_LIMIT);
        
        $controller = new ApplicationController($this->application);

        $response = $controller->getIndex(new Request());

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
        $this->assertEquals('{}', $response->getContent());
    }

    public function testShouldPaginateWithParamFromRequestObject()
    {
    }

}