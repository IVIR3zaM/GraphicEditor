<?php
namespace IVIR3aM\GraphicEditor\Tests\Shapes;

use IVIR3aM\GraphicEditor\ShapeAbstract;

class FakeShape extends ShapeAbstract
{
    public function getPixels()
    {
        return [];
    }
}