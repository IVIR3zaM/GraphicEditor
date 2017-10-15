<?php
namespace IVIR3aM\GraphicEditor\Shapes;

use IVIR3aM\GraphicEditor\PixelListFacadeInterface;
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
     * @param PixelListFacadeInterface $list
     * @return PixelListFacadeInterface
     */
    public function getPixels(PixelListFacadeInterface $list)
    {
        $count = intval($this->getRadius() * 2 * pi());
        $points = [];
        $slice = (2 * pi()) / $count;
        for ($i = 0; $i < $count; $i++) {
            $angle = $slice * $i;
            $x = intval($this->getCx() + ($this->getRadius() * cos($angle)));
            $y = intval($this->getCy() + ($this->getRadius() * sin($angle)));
            $points["$x-$y"] = [$x, $y];
        }
        foreach($points as $point) {
            $list->addPixelByPoints($this->getColor(), $point[0], $point[1]);
        }
        return $list;
    }
}