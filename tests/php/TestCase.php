<?php

namespace Tests;

class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        return $app;
    }

    /**
     * @param string $class
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockRepostiory($class)
    {
        return $this->getMock($class, array(), array($this->createApplication()));
    }
}
