<?php

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PostalCodeDataApiComponent;
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\Exception\CakeException;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class PostalCodeDataApiComponentTest extends TestCase
{
    /**
     * @var PostalCodeDataApiComponent
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
        $this->component = new PostalCodeDataApiComponent($registry);
    }

    public function testGetDataWithValidPostCode(): void
    {
        $value = 'RG1 4QU';

        $expected = [
            'postcode' => 'RG1 4QU',
            'status' => 'live',
            'usertype' => 'small',
            'easting' => 472006,
            'northing' => 173127,
            'positional_quality_indicator' => 1,
            'country' => 'England',
            'latitude' => '51.452557',
            'longitude' => '-0.965124',
            'postcode_no_space' => 'RG14QU',
            'postcode_fixed_width_seven' => 'RG1 4QU',
            'postcode_fixed_width_eight' => 'RG1  4QU',
            'postcode_area' => 'RG',
            'postcode_district' => 'RG1',
            'postcode_sector' => 'RG1 4',
            'outcode' => 'RG1',
            'incode' => '4QU',
        ];

        $result = $this->component->getData($value);

        $this->assertEquals($expected, $result);
    }

    public function testGetDataWithoutPostCode(): void
    {
        $value = '';

        $this->expectExceptionObject(new CakeException('Postcode must contain a value'));

        $this->component->getData($value);
    }
}
