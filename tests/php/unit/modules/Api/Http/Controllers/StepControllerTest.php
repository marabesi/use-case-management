<?php

namespace Tests\Modules\Api\Http\Controllers;

use Illuminate\Support\Collection;
use Modules\Api\Http\Controllers\StepController;
use Illuminate\Http\Request;
use Tests\TestCase;

class StepControllerTest extends TestCase
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

        $response = $controller->putIndex($id, $request);

        $decodeResponse = $response->getData();
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

    /**
     * @dataProvider models
     */
    public function testShouldHydrateComplementaryInformation($repository, $method, $collection)
    {
        $controller = new StepController($this->flow, $this->steps, $this->stepRepository);

        $model = $this->getMockBuilder('\Illuminate\Database\Eloquent\Builder')
            ->disableOriginalConstructor()
            ->getMock();

        $model->expects($this->at(0))
            ->method('where')
            ->with('id_sistema', 11)
            ->will($this->returnSelf());
        $model->expects($this->at(1))
            ->method('get')
            ->will($this->returnValue($collection));

        $repository = $this->getMockRepostiory($repository);
        $repository->expects($this->once())
            ->method('getModel')
            ->will($this->returnValue($model));

        $response =  $controller->$method(11, $repository);

        $collection = $response->get(0);

        $this->assertInstanceOf('Illuminate\Support\Collection', $response);

        $this->assertEquals(1, $response->count());
        $this->assertEquals(1, $collection->id);
        $this->assertEquals('RF1', $collection->identifier);
        $this->assertEquals('Unit test', $collection->description);
    }

    public function models()
    {
        return [
            [\Modules\Api\Repositories\ComplementaryRepository::class, 'getComplementary', new Collection([
                [
                    'id_informacao_complementar' => 1,
                    'identificador' => 'RF1',
                    'descricao' => 'Unit test',
                ]
            ])],
            [\Modules\Api\Repositories\BusinessRuleRepository::class, 'getBusiness', new Collection([
                [
                    'id_regra_de_negocio' => 1,
                    'identificador' => 'RF1',
                    'descricao' => 'Unit test',
                ]
            ])],
            [\Modules\Api\Repositories\ReferenceRepository::class, 'getReference', new Collection([
                [
                    'id_referencia' => 1,
                    'identificador' => 'RF1',
                    'descricao' => 'Unit test',
                ]
            ])],
        ];
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
