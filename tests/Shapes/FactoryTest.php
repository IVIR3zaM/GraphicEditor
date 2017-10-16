<?php
namespace IVIR3aM\GraphicEditor\Tests\Shapes;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Colors\FlyweightFactory;
use IVIR3aM\GraphicEditor\Shapes\Circle;
use IVIR3aM\GraphicEditor\Shapes\Factory;
use Exception;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    /**
     * @var Factory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new Factory();
    }

    public function testFactory()
    {
        $color = new Color(123, 6, 2);
        $circle = new Circle();
        $circle->setCx(1)->setCy(2)->setRadius(3)->setColor($color);
        $this->factory->setColorFactory(new FlyweightFactory());
        $this->assertEquals($circle, $this->factory->makeShape('circle', [
            'cx' => 1,
            'cy' => 2,
            'radius' => 3,
            'unknown' => 25,
            'color' => $color,
        ]));

        $this->assertEquals($circle, $this->factory->makeShape('circle', [
            'cx' => 1,
            'cy' => 2,
            'radius' => 3,
            'color' => '#7b0602',
        ]));

        $this->assertEquals($circle, $this->factory->makeShape('circle', [
            'cx' => 1,
            'cy' => 2,
            'radius' => 3,
            'color' => [123, 6, 2],
        ]));
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidShape()
    {
        $this->factory->makeShape('undefined');
    }
}