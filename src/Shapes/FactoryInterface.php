<?php
namespace IVIR3aM\GraphicEditor\Shapes;

use IVIR3aM\GraphicEditor\ShapeAbstract;
use IVIR3aM\GraphicEditor\Colors\FlyweightFactoryInterface as ColorFactoryInterface;

interface FactoryInterface
{
    /**
     * @param $type
     * @param array $params
     * @return ShapeAbstract
     */
    public function makeShape($type, $params = []);

    public function setColorFactory(ColorFactoryInterface $factory);

    public function getColorFactory();
}
