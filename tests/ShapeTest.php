<?php
namespace IVIR3aM\GraphicEditor\Tests;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Pixels\Factory as PixelFactory;
use IVIR3aM\GraphicEditor\Pixels\PixelList;
use IVIR3aM\GraphicEditor\Pixels\ListFacade as PixelListFacade;
use IVIR3aM\GraphicEditor\Tests\Shapes\FakeShape;
use TypeError;
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

    public function testGetPixels()
    {
        $color = new Color();
        $this->shape->setColor($color);

        $pixels = new PixelListFacade(new PixelList(), new PixelFactory());
        $pixels->addPixelByPoints($color, 0, 0);

        $list = new PixelListFacade(new PixelList(), new PixelFactory());
        $this->assertEquals($pixels, $this->shape->getPixels($list));
    }

    /**
     * @expectedException TypeError
     */
    public function testExceptionOnNoColor()
    {
        $this->shape->getPixels(new PixelListFacade(new PixelList(), new PixelFactory()));
    }
}