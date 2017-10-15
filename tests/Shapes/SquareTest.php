<?php
namespace IVIR3aM\GraphicEditor\Tests\Shapes;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Pixels\Factory as PixelFactory;
use IVIR3aM\GraphicEditor\Pixels\PixelList;
use IVIR3aM\GraphicEditor\Pixels\ListFacade as PixelListFacade;
use IVIR3aM\GraphicEditor\Shapes\Square;
use PHPUnit\Framework\TestCase;

class SquareTest extends TestCase
{
    /**
     * @var Square
     */
    private $shape;

    public function setUp()
    {
        $this->shape = new Square();
    }

    public function testWidthHeight()
    {
        $this->shape->setWidth(1);
        $this->assertSame(1, $this->shape->getWidth());
        $this->assertSame($this->shape->getWidth(), $this->shape->getHeight());

        $this->shape->setHeight(-1);
        $this->assertSame(1, $this->shape->getWidth());
        $this->assertSame($this->shape->getWidth(), $this->shape->getHeight());

        $this->shape->setWidth('-2');
        $this->assertSame(2, $this->shape->getWidth());
        $this->assertSame($this->shape->getWidth(), $this->shape->getHeight());

        $this->shape->setWidth(true);
        $this->assertSame(1, $this->shape->getWidth());
        $this->assertSame($this->shape->getWidth(), $this->shape->getHeight());

        $this->shape->setWidth(false);
        $this->assertSame(0, $this->shape->getWidth());
        $this->assertSame($this->shape->getWidth(), $this->shape->getHeight());

        $this->shape->setWidth(' 123');
        $this->assertSame(123, $this->shape->getWidth());
        $this->assertSame($this->shape->getWidth(), $this->shape->getHeight());

        $this->shape->setWidth('5 123');
        $this->assertSame(5, $this->shape->getWidth());
        $this->assertSame($this->shape->getWidth(), $this->shape->getHeight());

        $this->shape->setWidth('test 123');
        $this->assertSame(0, $this->shape->getWidth());
        $this->assertSame($this->shape->getWidth(), $this->shape->getHeight());
    }

    public function testX()
    {
        $this->shape->setX(1);
        $this->assertSame(1, $this->shape->getX());

        $this->shape->setX(-1);
        $this->assertSame(-1, $this->shape->getX());

        $this->shape->setX('-2');
        $this->assertSame(-2, $this->shape->getX());

        $this->shape->setX(true);
        $this->assertSame(1, $this->shape->getX());

        $this->shape->setX(false);
        $this->assertSame(0, $this->shape->getX());

        $this->shape->setX(' 123');
        $this->assertSame(123, $this->shape->getX());

        $this->shape->setX('-5 123');
        $this->assertSame(-5, $this->shape->getX());

        $this->shape->setX('test 123');
        $this->assertSame(0, $this->shape->getX());
    }

    public function testY()
    {
        $this->shape->setY(1);
        $this->assertSame(1, $this->shape->getY());

        $this->shape->setY(-1);
        $this->assertSame(-1, $this->shape->getY());

        $this->shape->setY('-2');
        $this->assertSame(-2, $this->shape->getY());

        $this->shape->setY(true);
        $this->assertSame(1, $this->shape->getY());

        $this->shape->setY(false);
        $this->assertSame(0, $this->shape->getY());

        $this->shape->setY(' 123');
        $this->assertSame(123, $this->shape->getY());

        $this->shape->setY('-5 123');
        $this->assertSame(-5, $this->shape->getY());

        $this->shape->setY('test 123');
        $this->assertSame(0, $this->shape->getY());
    }

    public function testGetPixels()
    {
        $color = new Color();
        $this->shape->setX(10);
        $this->shape->setY(10);
        $this->shape->setWidth(2);
        $this->shape->setColor($color);

        $pixels = new PixelListFacade(new PixelList(), new PixelFactory());
        foreach (array(
                     [10,10],
                     [11,10],
                     [12,10],
                     [12,11],
                     [12,12],
                     [11,12],
                     [10,12],
                     [10,11],
                 ) as $point) {
            $pixels->addPixelByPoints($color, $point[0], $point[1]);
        }

        $list = new PixelListFacade(new PixelList(), new PixelFactory());
        $this->assertEquals($pixels, $this->shape->getPixels($list));
    }
}