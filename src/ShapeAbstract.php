<?php
namespace IVIR3aM\GraphicEditor;

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

    abstract public function getPixels();
}