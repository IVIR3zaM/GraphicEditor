<?php
namespace IVIR3aM\GraphicEditor;

interface ColorInterface
{
    public function setRed($number);
    public function getRed();
    public function setGreen($number);
    public function getGreen();
    public function setBlue($number);
    public function getBlue();
}