<?php

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UserDataApiComponent;
use App\Test\TestCase\ApplicationTest;
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class UserDataApiComponentTest extends ApplicationTest
{
    /**
     * @var UserDataApiComponent
     */
    protected $component;

    /**
     * @var Controller|MockObject
     */
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();

        $request = new ServerRequest();

        $response = new Response();

        $this->controller = $this->getMockBuilder(Controller::class)
            ->setConstructorArgs([$request, $response])
            ->setMethods(null)
            ->getMock();

        $registry = new ComponentRegistry($this->controller);
        $this->component = new UserDataApiComponent($registry);
    }

    public function testGetAllUserData()
    {
        //$results = $this->component->getAllUserData();

        //$this->assertIsIterable($results);

        //$usersData = iterator_to_array($results);


    }
}
