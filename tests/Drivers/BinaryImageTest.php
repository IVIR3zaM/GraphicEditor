<?php
namespace IVIR3aM\GraphicEditor\Tests\Drivers;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Drivers\BinaryImage;
use IVIR3aM\GraphicEditor\Pixel;
use IVIR3aM\GraphicEditor\Pixels\PixelList;
use IVIR3aM\GraphicEditor\Responses\Factory;
use Exception;
use PHPUnit\Framework\TestCase;

class BinaryImageTest extends TestCase
{
    /**
     * @var BinaryImage
     */
    private $driver;

    public function setUp()
    {
        $this->driver = new BinaryImage('jpg');
    }

    public function testDraw()
    {
        $list = new PixelList();
        $list->addPixel(new Pixel(0, 0, new Color(128, 255, 15)));
        $list->addPixel(new Pixel(100, 50, new Color(255, 0, 0)));
        $list->addPixel(new Pixel(123, 250, new Color(0, 127, 255)));

        $response = $this->driver->draw($list, new Factory());

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('image/jpg', $response->getHeader('Content-Type'));
        $this->assertGreaterThan(1, $response->getHeader('Content-Length'));

        $image = tempnam(sys_get_temp_dir(), 'GraphicEditorTest');
        file_put_contents($image, $response->getBody());
        list($width, $height) = getimagesize($image);

        $this->assertGreaterThanOrEqual(123, $width);
        $this->assertGreaterThanOrEqual(250, $height);
        unlink($image);
    }

    public function testPadding()
    {
        $this->driver->setPadding(0);
        $this->assertEquals(0, $this->driver->getPadding());

        $this->driver->setPadding(10.23);
        $this->assertEquals(10.23, $this->driver->getPadding());

        $this->driver->setPadding(-2);
        $this->assertEquals(2, $this->driver->getPadding());

        $this->driver->setPadding(110);
        $this->assertEquals(110, $this->driver->getPadding());

        $this->driver->setPadding('-36.25');
        $this->assertEquals(36.25, $this->driver->getPadding());

        $this->driver->setPadding(10);
        $this->assertEquals(10, $this->driver->getPadding());

        $list = new PixelList();
        $list->addPixel(new Pixel(99, 99, new Color()));

        $response = $this->driver->draw($list, new Factory());

        $image = tempnam(sys_get_temp_dir(), 'GraphicEditorTest');
        file_put_contents($image, $response->getBody());
        list($width, $height) = getimagesize($image);

        $this->assertEquals(110, $width);
        $this->assertEquals(110, $height);
        unlink($image);
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidImageType()
    {
        $this->driver->setType('test');
    }
}