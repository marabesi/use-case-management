<?php

namespace Tests\Modules\Api\Http\Controllers;

use Modules\Api\Http\Controllers\StepController;
use Illuminate\Http\Request;

class StepControllerTest extends \Tests\TestCase
{

    private $flow;
    private $steps;
    private $stepRepository;

    public function setUp()
    {
        $this->flow = $this->getMockBuilder('Modules\Api\Models\Flow')
            ->disableOriginalConstructor()
            ->setMethods(['find', 'save'])
            ->getMock();

        $this->steps = $this->getMockBuilder('Modules\Api\Models\Step')
            ->disableOriginalConstructor()
            ->setMethods([
                'find', 'save', 'updateComplementaryRows',
                'updateBusinessRows', 'updateReferenceRows', 'deleteAll'
            ])
            ->getMock();

        $this->stepRepository = $this->getMockRepostiory('Modules\Api\Repositories\StepRepository');
    }

    public function tearDown()
    {
        $this->flow = null;
        $this->steps = null;
    }

    public function testShouldUpdateStepsWhenTheArgumentsAreValid()
    {
        $id = '666,666';

        $this->flow->expects($this->at(0))
            ->method('find')
            ->will($this->returnSelf());

        $this->steps->expects($this->at(0))
            ->method('find')
            ->with(666)
            ->will($this->returnSelf());
        $this->steps->expects($this->at(1))
            ->method('save');

        $this->steps->expects($this->once())
            ->method('updateComplementaryRows')
            ->will($this->returnSelf());

        $controller = new StepController($this->flow, $this->steps, $this->stepRepository);

        $request = $this->getMock('Illuminate\Http\Request');

//        $request->expects($this->at(0))
//            ->method('input')
//            ->with('application')
//            ->will($this->returnValue(111));
//
//        $request->expects($this->at(2))
//            ->method('input')
//            ->with('identifier');
//        $request->expects($this->at(3))
//            ->method('input')
//            ->with('description');

        $response = $controller->putIndex($id, $request);

        $decodeResponse = $response->getData();
//        var_dump($decodeResponse);
//exit();
        $this->assertFalse($decodeResponse->error);
    }

    public function testShouldUpdateFlowWhenTheArgumentsAreValid()
    {
        $id = '666,666';

        $this->flow->expects($this->at(0))
            ->method('find')
            ->will($this->returnSelf());
        $this->flow->expects($this->at(1))
            ->method('save');

        $this->steps->expects($this->at(0))
            ->method('find')
            ->with(666)
            ->will($this->returnSelf());

        $this->steps->expects($this->once())
            ->method('updateComplementaryRows')
            ->will($this->returnSelf());

        $controller = new StepController($this->flow, $this->steps, $this->stepRepository);

        $request = $this->getMock('Illuminate\Http\Request');
//        $request->expects($this->at(0))
//            ->method('input')
//            ->with('type');
//        $request->expects($this->at(1))
//            ->method('input')
//            ->with('useCase');

        $response = $controller->putIndex($id, $request);

        $decodeResponse = $response->getData();

        $this->assertFalse($decodeResponse->error);
    }

    public function testShouldUpdateManyToManyRelationships()
    {
        $id = '666,666';

        $this->flow->expects($this->at(0))
            ->method('find')
            ->will($this->returnSelf());
        $this->flow->expects($this->at(1))
            ->method('save');

        $this->steps->expects($this->at(0))
            ->method('find')
            ->with(666)
            ->will($this->returnSelf());

        $this->steps->expects($this->once())
            ->method('updateComplementaryRows')
            ->will($this->returnSelf());

        $this->steps->expects($this->once())
            ->method('updateBusinessRows')
            ->will($this->returnSelf());

        $this->steps->expects($this->once())
            ->method('updateReferenceRows')
            ->will($this->returnSelf());

        $controller = new StepController($this->flow, $this->steps, $this->stepRepository);

        $request = $this->getMock('Illuminate\Http\Request');
//        $request->expects($this->at(4))
//            ->method('input')
//            ->with('complementary', [])
//            ->will($this->returnValue([]));
//        $request->expects($this->at(5))
//            ->method('input')
//            ->with('business', [])
//            ->will($this->returnValue([]));
//        $request->expects($this->at(6))
//            ->method('input')
//            ->with('reference', [])
//            ->will($this->returnValue([]));

        $response = $controller->putIndex($id, $request);

        $decodeResponse = $response->getData();

        $this->assertFalse($decodeResponse->error);
    }

    /**
     * @dataProvider invalidArguments
     */
    public function testShouldValidateIncorrectArgumentWhenTryingUpdate($invalidArgument)
    {
        \Log::shouldReceive('error')->once();

        $controller = new StepController($this->flow, $this->steps, $this->stepRepository);

        $request = new Request();
        $response = $controller->putIndex($invalidArgument, $request);

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $decodeResponse = $response->getData();

        $this->assertTrue($decodeResponse->error);
        $this->assertEquals('Invalid argument', $decodeResponse->data);
    }

    public function testShouldDelete()
    {
        $id = '666,666';

        $this->steps->expects($this->once())
            ->method('deleteAll');

        $controller = new StepController($this->flow, $this->steps, $this->stepRepository);
        $response = $controller->deleteIndex($id);

        $decodeResponse = $response->getData();
        $this->assertFalse($decodeResponse->error);
    }

    public function invalidArguments()
    {
        return [
            [','],
            ['123,'],
            [',123'],
            ['test,test'],
        ];
    }
}