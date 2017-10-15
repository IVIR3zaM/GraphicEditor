<?php
namespace IVIR3aM\GraphicEditor\Shapes;

use IVIR3aM\GraphicEditor\ShapeAbstract;

class Square extends ShapeAbstract
{
    protected $x = 0;
    protected $y = 0;
    protected $width = 0;

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

    public function setWidth($number)
    {
        $this->width = abs(intval($number));
        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setHeight($number)
    {
        return $this->setWidth($number);
    }

    public function getHeight()
    {
        return $this->width;
    }

    /**
     * @todo Take into account the border size
     */
    public function getPixels()
    {
        $list = [];
        $y = $this->getY();
        $x = $this->getX();
        for (; $x < $this->getX() + $this->getWidth(); $x++) {
            $list[] = [$x, $y];
        }
        for (; $y < $this->getY() + $this->getHeight(); $y++) {
            $list[] = [$x, $y];
        }
        for (; $x > $this->getX(); $x--) {
            $list[] = [$x, $y];
        }
        for (; $y > $this->getY(); $y--) {
            $list[] = [$x, $y];
        }
        return $list;
    }
}