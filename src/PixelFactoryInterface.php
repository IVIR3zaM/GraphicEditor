<?php
namespace IVIR3aM\GraphicEditor;

interface PixelFactoryInterface
{
    /**
     * @param ColorInterface $color
     * @param int $x
     * @param int $y
     * @return PixelInterface
     */
    public function makePixel(ColorInterface $color, $x = 0, $y = 0);
}