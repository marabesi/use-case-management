<?php

namespace Tests\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Api\Http\Controllers\ApplicationController;

class ApplicationControllerTest extends \Tests\TestCase
{

    private $application;

    private $useCaseRepository;

    public function setUp()
    {
        $this->application = $this->getMockRepostiory('Modules\Api\Repositories\ApplicationRepository');
        $this->useCaseRepository = $this->getMockRepostiory('Modules\Api\Repositories\UseCaseRepository');
    }

    public function tearDown()
    {
        $this->application = null;
    }

    public function testShouldCallModelWithDefaultPaginationLimit()
    {
        $this->application->expects($this->once())
            ->method('fetchAll')
            ->with(\Modules\Api\Models\Base::DEFAULT_LIMIT);

        $controller = new ApplicationController($this->application, $this->useCaseRepository);

        $response = $controller->getIndex(new Request());

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
        $this->assertEquals('{}', $response->getContent());
    }

    public function testCreateNewApplication()
    {
        $model = $this->getMock('Modules\Api\Models\Application');

        $this->application->expects($this->once())
            ->method('create')
            ->with([
                'nome' => 'Application testing'
            ])
            ->will($this->returnValue($model));

        $controller = new ApplicationController($this->application, $this->useCaseRepository);
        
        $request = $this->getMock('Illuminate\Http\Request');
        $request->expects($this->once())
            ->method('input')
            ->will($this->returnValue('Application testing'));

        $response = $controller->postIndex($request);

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }
}