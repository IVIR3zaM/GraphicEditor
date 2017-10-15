<?php
namespace IVIR3aM\GraphicEditor\Tests\Colors;

use IVIR3aM\GraphicEditor\ColorInterface;
use IVIR3aM\GraphicEditor\Colors\FlyweightFactory;
use PHPUnit\Framework\TestCase;

class FlyweightFactoryTest extends TestCase
{
    /**
     * @var FlyweightFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new FlyweightFactory();
    }

    public function testFactory()
    {
        $color = $this->factory->getColor(255, 512, 120);
        $this->assertInstanceOf(ColorInterface::class, $color);
        $this->assertSame($color, $this->factory->getColor(255, 255, 120));
        $this->assertSame($color->getRed(), 255);
        $this->assertSame($color->getGreen(), 255);
        $this->assertSame($color->getBlue(), 120);
    }
}