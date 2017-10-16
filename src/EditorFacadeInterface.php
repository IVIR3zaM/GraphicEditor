<?php
namespace IVIR3aM\GraphicEditor;

use IVIR3aM\GraphicEditor\Colors\FlyweightFactoryInterface as ColorFactoryInterface;
use IVIR3aM\GraphicEditor\Shapes\FactoryInterface as ShapeFactoryInterface;

interface EditorFacadeInterface
{
    public function __construct($shapes = [], $settings = []);

    public function setUp($settings = []);

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return ColorInterface
     */
    public function getColor($red = 0, $green = 0, $blue = 0);

    public function addShape(ShapeAbstract $shape);

    public function addShapeByArray($type, $params = []);

    /**
     * @return ResponseInterface
     */
    public function getResponse();

    public function setColorFactory(ColorFactoryInterface $factory);

    public function getColorFactory();

    public function setEditor(EditorInterface $editor);

    public function getEditor();

    public function setShapeFactory(ShapeFactoryInterface $factory);

    public function getShapeFactory();
}