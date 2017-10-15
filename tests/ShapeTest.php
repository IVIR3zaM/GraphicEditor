<?php
namespace IVIR3aM\GraphicEditor\Tests;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Tests\Shapes\FakeShape;
use PHPUnit\Framework\TestCase;

class ShapeTest extends TestCase
{
    /**
     * @var FakeShape
     */
    private $shape;

    public function setUp()
    {
        $this->shape = new FakeShape();
    }

    public function testColor()
    {
        $color = new Color();
        $this->assertNotSame($color, $this->shape->getColor());

        $this->shape->setColor($color);
        $this->assertSame($color, $this->shape->getColor());
    }

    public function testBorderSize()
    {
        $this->shape->setBorderSize(1);
        $this->assertSame(1, $this->shape->getBorderSize());

        $this->shape->setBorderSize(-1);
        $this->assertSame(1, $this->shape->getBorderSize());

        $this->shape->setBorderSize('-2');
        $this->assertSame(2, $this->shape->getBorderSize());

        $this->shape->setBorderSize(true);
        $this->assertSame(1, $this->shape->getBorderSize());

        $this->shape->setBorderSize(false);
        $this->assertSame(0, $this->shape->getBorderSize());

        $this->shape->setBorderSize(' 123');
        $this->assertSame(123, $this->shape->getBorderSize());

        $this->shape->setBorderSize('5 123');
        $this->assertSame(5, $this->shape->getBorderSize());

        $this->shape->setBorderSize('test 123');
        $this->assertSame(0, $this->shape->getBorderSize());
    }
}