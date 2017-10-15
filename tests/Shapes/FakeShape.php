<?php
namespace IVIR3aM\GraphicEditor\Tests\Shapes;

use IVIR3aM\GraphicEditor\PixelListFacadeInterface;
use IVIR3aM\GraphicEditor\ShapeAbstract;

class FakeShape extends ShapeAbstract
{
    public function getPixels(PixelListFacadeInterface $list)
    {
        return $list;
    }
}