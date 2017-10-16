<?php
namespace IVIR3aM\GraphicEditor\Tests\Drivers;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Drivers\JsonArrayPoints;
use IVIR3aM\GraphicEditor\Pixel;
use IVIR3aM\GraphicEditor\Pixels\PixelList;
use IVIR3aM\GraphicEditor\Responses\Factory;
use PHPUnit\Framework\TestCase;

class JsonArrayPointsTest extends TestCase
{
    /**
     * @var JsonArrayPoints
     */
    private $driver;

    public function setUp()
    {
        $this->driver = new JsonArrayPoints();
    }

    public function testDraw()
    {
        $array = json_encode([
            [
                'x' => 0,
                'y' => 0,
                'color' => '#80ff0f',
            ],
            [
                'x' => 100,
                'y' => 50,
                'color' => '#ff0000',
            ],
            [
                'x' => 123,
                'y' => 250,
                'color' => '#007fff',
            ],
        ]);

        $list = new PixelList();
        $list->addPixel(new Pixel(0, 0, new Color(128, 255, 15)));
        $list->addPixel(new Pixel(100, 50, new Color(255, 0, 0)));
        $list->addPixel(new Pixel(123, 250, new Color(0, 127, 255)));

        $response = $this->driver->draw($list, new Factory());

        $this->assertSame($array, $response->getBody());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals(strlen($array), $response->getHeader('Content-Length'));
    }
}