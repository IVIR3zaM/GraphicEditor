<?php
namespace IVIR3aM\GraphicEditor;

class Pixel implements PixelInterface
{
    protected $x = 0;
    protected $y = 0;
    protected $color;

    public function __construct($x = 0, $y = 0, ColorInterface $color = null)
    {
        $this->setX($x);
        $this->setY($y);
        if (!is_null($color)) {
            $this->setColor($color);
        }
    }

    public function setX($number)
    {
        $this->x = intval($number);
        return $this;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setY($number)
    {
        $this->y = intval($number);
        return $this;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setColor(ColorInterface $color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return ColorInterface
     */
    public function getColor()
    {
        return $this->color;
    }
}