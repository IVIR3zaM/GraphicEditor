<?php
namespace IVIR3aM\GraphicEditor\Tests;

use Exception;
use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Drivers\JsonArrayPoints;
use IVIR3aM\GraphicEditor\Editor;
use IVIR3aM\GraphicEditor\Pixels\Factory as PixelFactory;
use IVIR3aM\GraphicEditor\Pixels\ListFacade as PixelListFacade;
use IVIR3aM\GraphicEditor\Pixels\PixelList;
use IVIR3aM\GraphicEditor\ResponseInterface;
use IVIR3aM\GraphicEditor\Responses\Factory as ResponseFactory;
use IVIR3aM\GraphicEditor\Shapes\Circle;
use IVIR3aM\GraphicEditor\Shapes\ShapeList;
use PHPUnit\Framework\TestCase;

class EditorTest extends TestCase
{
    /**
     * @var Editor
     */
    private $editor;

    public function setUp()
    {
        $this->editor = new Editor();
    }

    public function testSetterGetters()
    {
        $shapeList = new ShapeList();
        $this->editor->setShapeList($shapeList);
        $this->assertSame($shapeList, $this->editor->getShapeList());

        $driver = new JsonArrayPoints();
        $this->editor->setDriver($driver);
        $this->assertSame($driver, $this->editor->getDriver());

        $response = new ResponseFactory();
        $this->editor->setResponseFactory($response);
        $this->assertSame($response, $this->editor->getResponseFactory());

        $pixelList = new PixelListFacade(new PixelList(), new PixelFactory());
        $this->editor->setPixelListFacade($pixelList);
        $this->assertSame($pixelList, $this->editor->getPixelListFacade());
    }

    public function testResponse()
    {
        $this->editor->setShapeList(new ShapeList());
        $this->editor->setDriver(new JsonArrayPoints());
        $this->editor->setResponseFactory(new ResponseFactory());
        $this->editor->setPixelListFacade(new PixelListFacade(new PixelList(), new PixelFactory()));
        $shape = new Circle();
        $shape->setCx(100)->setCy(100)->setRadius(2)->setColor(new Color());
        $this->editor->getShapeList()->addShape($shape);

        $response = $this->editor->getResponse();
        $this->assertTrue($response instanceof ResponseInterface);
        $sample = [
            ['x' => 102, 'y' => 100, 'color' => '#000000'],
            ['x' => 101, 'y' => 101, 'color' => '#000000'],
            ['x' => 100, 'y' => 102, 'color' => '#000000'],
            ['x' => 99, 'y' => 101, 'color' => '#000000'],
            ['x' => 98, 'y' => 101, 'color' => '#000000'],
            ['x' => 98, 'y' => 100, 'color' => '#000000'],
            ['x' => 98, 'y' => 99, 'color' => '#000000'],
            ['x' => 99, 'y' => 98, 'color' => '#000000'],
            ['x' => 100, 'y' => 98, 'color' => '#000000'],
            ['x' => 101, 'y' => 98, 'color' => '#000000'],
            ['x' => 101, 'y' => 99, 'color' => '#000000'],
        ];
        $this->assertEquals(json_encode($sample), $response->getBody());
    }

    /**
     * @expectedException Exception
     */
    public function testNotDefinedShapeList()
    {
        $this->editor->getShapeList();
    }

    /**
     * @expectedException Exception
     */
    public function testNotDefinedDriver()
    {
        $this->editor->getDriver();
    }

    /**
     * @expectedException Exception
     */
    public function testNotDefinedResponseFactory()
    {
        $this->editor->getResponseFactory();
    }

    /**
     * @expectedException Exception
     */
    public function testNotDefinedPixelListFacade()
    {
        $this->editor->getPixelListFacade();
    }
}