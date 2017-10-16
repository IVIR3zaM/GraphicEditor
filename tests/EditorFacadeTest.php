<?php
namespace IVIR3aM\GraphicEditor\Tests;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Colors\FlyweightFactory;
use IVIR3aM\GraphicEditor\Drivers\JsonArrayPoints;
use IVIR3aM\GraphicEditor\Editor;
use IVIR3aM\GraphicEditor\EditorFacade;
use IVIR3aM\GraphicEditor\ResponseInterface;
use IVIR3aM\GraphicEditor\Shapes\Circle;
use PHPUnit\Framework\TestCase;

class EditorFacadeTest extends TestCase
{
    /**
     * @var EditorFacade
     */
    private $editor;

    public function setUp()
    {
        $this->editor = new EditorFacade();
    }

    public function testSetterGetters()
    {
        $colorFactory = new FlyweightFactory();
        $this->editor->setColorFactory($colorFactory);
        $this->assertSame($colorFactory, $this->editor->getColorFactory());

        $editor = new Editor();
        $this->editor->setEditor($editor);
        $this->assertSame($editor, $this->editor->getEditor());
    }

    public function testResponse()
    {
        $this->editor->setUp([
            'Driver' => JsonArrayPoints::class,
        ]);

        $shape = new Circle();
        $shape->setCx(100)->setCy(100)->setRadius(2)->setColor($this->editor->getColor());
        $this->editor->addShape($shape);

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

    public function testAddShapeByArray()
    {
        $this->editor = new EditorFacade([
            'circle' => [
                'cx' => 1,
                'cy' => 2,
                'radius' => 3,
                'color' => [123, 6, 2],
            ]
        ]);
        $this->assertSame(1, $this->editor->getEditor()->getShapeList()->count());

        $shape = new Circle();
        $shape->setCx(1)->setCy(2)->setRadius(3)->setColor(new Color(123, 6, 2));
        $this->assertEquals($shape, $this->editor->getEditor()->getShapeList()->getShape(0));
    }
}