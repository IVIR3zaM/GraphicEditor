<?php
namespace IVIR3aM\GraphicEditor\Colors;

use IVIR3aM\GraphicEditor\ColorInterface;

interface FlyweightFactoryInterface
{
    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return ColorInterface
     */
    public function getColor($red = 0, $green = 0, $blue = 0);
}