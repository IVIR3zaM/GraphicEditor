<?php
namespace IVIR3aM\GraphicEditor\Tests\Shapes;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\PixelFactory;
use IVIR3aM\GraphicEditor\PixelList;
use IVIR3aM\GraphicEditor\PixelListFacade;
use IVIR3aM\GraphicEditor\Shapes\Circle;
use PHPUnit\Framework\TestCase;

class CircleTest extends TestCase
{
    /**
     * @var Circle
     */
    private $shape;

    public function setUp()
    {
        $this->shape = new Circle();
    }

    public function testRadius()
    {
        $this->shape->setRadius(1);
        $this->assertSame(1, $this->shape->getRadius());

        $this->shape->setRadius(-1);
        $this->assertSame(1, $this->shape->getRadius());

        $this->shape->setRadius('-2');
        $this->assertSame(2, $this->shape->getRadius());

        $this->shape->setRadius(true);
        $this->assertSame(1, $this->shape->getRadius());

        $this->shape->setRadius(false);
        $this->assertSame(0, $this->shape->getRadius());

        $this->shape->setRadius(' 123');
        $this->assertSame(123, $this->shape->getRadius());

        $this->shape->setRadius('5 123');
        $this->assertSame(5, $this->shape->getRadius());

        $this->shape->setRadius('test 123');
        $this->assertSame(0, $this->shape->getRadius());
    }

    public function testCx()
    {
        $this->shape->setCx(1);
        $this->assertSame(1, $this->shape->getCx());

        $this->shape->setCx(-1);
        $this->assertSame(-1, $this->shape->getCx());

        $this->shape->setCx('-2');
        $this->assertSame(-2, $this->shape->getCx());

        $this->shape->setCx(true);
        $this->assertSame(1, $this->shape->getCx());

        $this->shape->setCx(false);
        $this->assertSame(0, $this->shape->getCx());

        $this->shape->setCx(' 123');
        $this->assertSame(123, $this->shape->getCx());

        $this->shape->setCx('-5 123');
        $this->assertSame(-5, $this->shape->getCx());

        $this->shape->setCx('test 123');
        $this->assertSame(0, $this->shape->getCx());
    }

    public function testCy()
    {
        $this->shape->setCy(1);
        $this->assertSame(1, $this->shape->getCy());

        $this->shape->setCy(-1);
        $this->assertSame(-1, $this->shape->getCy());

        $this->shape->setCy('-2');
        $this->assertSame(-2, $this->shape->getCy());

        $this->shape->setCy(true);
        $this->assertSame(1, $this->shape->getCy());

        $this->shape->setCy(false);
        $this->assertSame(0, $this->shape->getCy());

        $this->shape->setCy(' 123');
        $this->assertSame(123, $this->shape->getCy());

        $this->shape->setCy('-5 123');
        $this->assertSame(-5, $this->shape->getCy());

        $this->shape->setCy('test 123');
        $this->assertSame(0, $this->shape->getCy());
    }

    public function testGetPixels()
    {
        $color = new Color();
        $this->shape->setCx(100);
        $this->shape->setCy(100);
        $this->shape->setRadius(2);
        $this->shape->setColor($color);

        $pixels = new PixelListFacade(new PixelList(), new PixelFactory());
        foreach (array(
                     [102, 100],
                     [101, 101],
                     [100, 102],
                     [99, 101],
                     [98, 101],
                     [98, 100],
                     [98, 99],
                     [99, 98],
                     [100, 98],
                     [101, 98],
                     [101, 99]
                 ) as $point) {
            $pixels->addPixelByPoints($color, $point[0], $point[1]);
        }

        $list = new PixelListFacade(new PixelList(), new PixelFactory());
        $this->assertEquals($pixels, $this->shape->getPixels($list));
    }
}