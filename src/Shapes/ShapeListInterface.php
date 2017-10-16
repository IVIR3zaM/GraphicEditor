<?php
namespace IVIR3aM\GraphicEditor\Shapes;

use IVIR3aM\GraphicEditor\ShapeAbstract;

interface ShapeListInterface extends \Iterator, \Countable
{
    public function addShape(ShapeAbstract $shape);

    /**
     * @param int $index
     * @return ShapeAbstract|null
     */
    public function getShape($index);

    public function removeShape(ShapeAbstract $shape);

    /**
     * @param int $index
     */
    public function removeShapeByIndex($index);
}