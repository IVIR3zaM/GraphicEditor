<?php
namespace IVIR3aM\GraphicEditor\Tests\Shapes;

use IVIR3aM\GraphicEditor\Pixels\ListFacadeInterface as PixelListFacadeInterface;
use IVIR3aM\GraphicEditor\ShapeAbstract;

class FakeShape extends ShapeAbstract
{
    public function getPixels(PixelListFacadeInterface $list)
    {
        $list->addPixelByPoints($this->getColor(), 0, 0);
        return $list;
    }
}