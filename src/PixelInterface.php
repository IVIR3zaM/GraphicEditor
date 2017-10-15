<?php
namespace IVIR3aM\GraphicEditor;

interface PixelInterface
{
    public function setX($number);
    public function getX();
    public function setY($number);
    public function getY();
    public function setColor(ColorInterface $color);

    /**
     * @return ColorInterface
     */
    public function getColor();
}