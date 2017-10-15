<?php
namespace IVIR3aM\GraphicEditor\Tests;

use IVIR3aM\GraphicEditor\Color;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{
    /**
     * @var Color
     */
    private $color;

    public function setUp()
    {
        $this->color = new Color();
    }

    public function testNumberSanitize()
    {
        $this->assertSame(15, Color::numberSanitize(15));
        $this->assertSame(12, Color::numberSanitize(-12));
        $this->assertSame(0, Color::numberSanitize(false));
        $this->assertSame(255, Color::numberSanitize(256));
        $this->assertSame(255, Color::numberSanitize('-1230'));
    }

    public function testRed()
    {
        $this->color->setRed(1);
        $this->assertSame(1, $this->color->getRed());

        $this->color->setRed(-2);
        $this->assertSame(2, $this->color->getRed());

        $this->color->setRed('237 3');
        $this->assertSame(237, $this->color->getRed());

        $this->color->setRed(false);
        $this->assertSame(0, $this->color->getRed());

        $this->color->setRed(true);
        $this->assertSame(1, $this->color->getRed());

        $this->color->setRed(512);
        $this->assertSame(255, $this->color->getRed());
    }

    public function testGreen()
    {
        $this->color->setGreen(1);
        $this->assertSame(1, $this->color->getGreen());

        $this->color->setGreen(-2);
        $this->assertSame(2, $this->color->getGreen());

        $this->color->setGreen('237 3');
        $this->assertSame(237, $this->color->getGreen());

        $this->color->setGreen(false);
        $this->assertSame(0, $this->color->getGreen());

        $this->color->setGreen(true);
        $this->assertSame(1, $this->color->getGreen());

        $this->color->setGreen(512);
        $this->assertSame(255, $this->color->getGreen());
    }

    public function testBlue()
    {
        $this->color->setBlue(1);
        $this->assertSame(1, $this->color->getBlue());

        $this->color->setBlue(-2);
        $this->assertSame(2, $this->color->getBlue());

        $this->color->setBlue('237 3');
        $this->assertSame(237, $this->color->getBlue());

        $this->color->setBlue(false);
        $this->assertSame(0, $this->color->getBlue());

        $this->color->setBlue(true);
        $this->assertSame(1, $this->color->getBlue());

        $this->color->setBlue(512);
        $this->assertSame(255, $this->color->getBlue());
    }

    public function testConstructor()
    {
        $this->assertSame(0, $this->color->getRed());
        $this->assertSame(0, $this->color->getGreen());
        $this->assertSame(0, $this->color->getBlue());

        $this->color = new Color(120, 36, 215);

        $this->assertSame(120, $this->color->getRed());
        $this->assertSame(36, $this->color->getGreen());
        $this->assertSame(215, $this->color->getBlue());
    }
}