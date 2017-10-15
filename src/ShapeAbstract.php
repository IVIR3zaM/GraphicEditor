<?php
namespace IVIR3aM\GraphicEditor;

use IVIR3aM\GraphicEditor\Pixels\ListFacadeInterface as PixelListFacadeInterface;

abstract class ShapeAbstract
{
    protected $color;

    protected $borderSize = 1;

    public function setColor(ColorInterface $color)
    {
        $this->color = $color;
        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setBorderSize($size)
    {
        $this->borderSize = abs(intval($size));
        return $this;
    }

    public function getBorderSize()
    {
        return $this->borderSize;
    }

    /**
     * @param PixelListFacadeInterface $list
     * @return PixelListFacadeInterface
     */
    abstract public function getPixels(PixelListFacadeInterface $list);
}