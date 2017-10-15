<?php
namespace IVIR3aM\GraphicEditor;

use IVIR3aM\GraphicEditor\Pixels\ListFacadeInterface as PixelListFacadeInterface;
use Exception;

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
        if (!($this->color instanceof ColorInterface)) {
            throw new Exception('Color attribute is not defined yet');
        }
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