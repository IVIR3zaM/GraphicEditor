<?php
namespace IVIR3aM\GraphicEditor\Shapes;

use IVIR3aM\GraphicEditor\ShapeAbstract;

class Circle extends ShapeAbstract
{
    protected $cx = 0;
    protected $cy = 0;
    protected $radius = 0;

    public function setCx($number)
    {
        $this->cx = intval($number);
        return $this;
    }

    public function getCx()
    {
        return $this->cx;
    }

    public function setCy($number)
    {
        $this->cy = intval($number);
        return $this;
    }

    public function getCy()
    {
        return $this->cy;
    }

    public function setRadius($number)
    {
        $this->radius = abs(intval($number));
        return $this;
    }

    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @todo Take into account the border size
     */
    public function getPixels()
    {
        $points = intval($this->getRadius() * 2 * pi());
        $list = [];
        $slice = (2 * pi()) / $points;
        for ($i = 0; $i < $points; $i++) {
            $angle = $slice * $i;
            $x = intval($this->getCx() + ($this->getRadius() * cos($angle)));
            $y = intval($this->getCy() + ($this->getRadius() * sin($angle)));
            $list["$x-$y"] = [$x, $y];
        }
        return array_values($list);
    }
}