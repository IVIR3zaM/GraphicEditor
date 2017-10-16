<?php
namespace IVIR3aM\GraphicEditor\Shapes;

use IVIR3aM\GraphicEditor\ObjectListIteratorTrait;
use IVIR3aM\GraphicEditor\ShapeAbstract;

class ShapeList implements ShapeListInterface
{
    use ObjectListIteratorTrait;

    public function addShape(ShapeAbstract $shape)
    {
        return $this->addObject($shape);
    }

    /**
     * @param int $index
     * @return ShapeAbstract|null
     */
    public function getShape($index)
    {
        return $this->getObject($index);
    }

    public function removeShape(ShapeAbstract $shape)
    {
        return $this->removeObject($shape);
    }

    /**
     * @param int $index
     * @return ShapeListInterface
     */
    public function removeShapeByIndex($index)
    {
        return $this->removeObjectByIndex($index);
    }
}