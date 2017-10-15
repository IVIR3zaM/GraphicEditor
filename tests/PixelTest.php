<?php
namespace IVIR3aM\GraphicEditor\Tests;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Pixel;
use PHPUnit\Framework\TestCase;

class PixelTest extends TestCase
{
    /**
     * @var Pixel
     */
    private $pixel;

    public function setUp()
    {
        $this->pixel = new Pixel();
    }

    public function testX()
    {
        $this->pixel->setX(1);
        $this->assertSame(1, $this->pixel->getX());

        $this->pixel->setX(-2);
        $this->assertSame(-2, $this->pixel->getX());

        $this->pixel->setX('237 3');
        $this->assertSame(237, $this->pixel->getX());

        $this->pixel->setX(false);
        $this->assertSame(0, $this->pixel->getX());

        $this->pixel->setX(true);
        $this->assertSame(1, $this->pixel->getX());

        $this->pixel->setX(512);
        $this->assertSame(512, $this->pixel->getX());
    }

    public function testY()
    {
        $this->pixel->setY(1);
        $this->assertSame(1, $this->pixel->getY());

        $this->pixel->setY(-2);
        $this->assertSame(-2, $this->pixel->getY());

        $this->pixel->setY('237 3');
        $this->assertSame(237, $this->pixel->getY());

        $this->pixel->setY(false);
        $this->assertSame(0, $this->pixel->getY());

        $this->pixel->setY(true);
        $this->assertSame(1, $this->pixel->getY());

        $this->pixel->setY(512);
        $this->assertSame(512, $this->pixel->getY());
    }

    public function testColor()
    {
        $color = new Color(120, 36, 215);
        $this->pixel->setColor($color);
        $this->assertSame($color, $this->pixel->getColor());
    }

    public function testConstructor()
    {
        $this->assertSame(0, $this->pixel->getX());
        $this->assertSame(0, $this->pixel->getY());

        $this->pixel = new Pixel(162, 356, new Color(120, 36, 215));

        $this->assertSame(162, $this->pixel->getX());
        $this->assertSame(356, $this->pixel->getY());
        $this->assertSame(120, $this->pixel->getColor()->getRed());
        $this->assertSame(36, $this->pixel->getColor()->getGreen());
        $this->assertSame(215, $this->pixel->getColor()->getBlue());
    }
}