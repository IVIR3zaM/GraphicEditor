<?php
namespace IVIR3aM\GraphicEditor\Tests;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Pixel;
use IVIR3aM\GraphicEditor\PixelFactory;
use PHPUnit\Framework\TestCase;

class PixelFactoryTest extends TestCase
{
    /**
     * @var PixelFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new PixelFactory();
    }

    public function testFactory()
    {
        $px = new Pixel(12, 14, new Color(123, 6, 2));
        $this->assertEquals($px, $this->factory->makePixel($px->getColor(), $px->getX(), $px->getY()));
    }
}