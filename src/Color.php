<?php
namespace IVIR3aM\GraphicEditor;

class Color implements ColorInterface
{
    protected $red = 0;
    protected $green = 0;
    protected $blue = 0;

    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->setRed($red);
        $this->setGreen($green);
        $this->setBlue($blue);
    }

    public static function numberSanitize($number)
    {
        $number = abs(intval($number));
        if ($number > 255) {
            $number = 255;
        }
        return $number;
    }

    public function setRed($number)
    {
        $this->red = static::numberSanitize($number);
        return $this;
    }

    public function getRed()
    {
        return $this->red;
    }

    public function setGreen($number)
    {
        $this->green = static::numberSanitize($number);
        return $this;
    }

    public function getGreen()
    {
        return $this->green;
    }

    public function setBlue($number)
    {
        $this->blue = static::numberSanitize($number);
        return $this;
    }

    public function getBlue()
    {
        return $this->blue;
    }

    public static function convertToFixedSizeHex($number, $size = 2)
    {
        $number = dechex($number);
        while (strlen($number) < $size) {
            $number = '0' . $number;
        }
        return $number;
    }

    public function getHexColorCode()
    {
        $red = static::convertToFixedSizeHex($this->getRed());
        $green = static::convertToFixedSizeHex($this->getGreen());
        $blue = static::convertToFixedSizeHex($this->getBlue());
        return "#{$red}{$green}{$blue}";
    }

    public function getRgbColorCode()
    {
        return 'rgb(' . $this->getRed() . ', ' . $this->getGreen() . ', ' . $this->getBlue() . ')';
    }
}