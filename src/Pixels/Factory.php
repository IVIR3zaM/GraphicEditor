<?php
namespace IVIR3aM\GraphicEditor\Pixels;

use IVIR3aM\GraphicEditor\ColorInterface;
use IVIR3aM\GraphicEditor\Pixel;
use IVIR3aM\GraphicEditor\PixelInterface;

class Factory implements FactoryInterface
{
    /**
     * @param ColorInterface $color
     * @param int $x
     * @param int $y
     * @return PixelInterface
     */
    public function makePixel(ColorInterface $color, $x = 0, $y = 0)
    {
        return new Pixel($x, $y, $color);
    }
}