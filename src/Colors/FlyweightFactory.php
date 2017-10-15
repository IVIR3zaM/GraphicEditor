<?php
namespace IVIR3aM\GraphicEditor\Colors;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\ColorInterface;

class FlyweightFactory implements FlyweightFactoryInterface
{
    /**
     * @var ColorInterface[]
     */
    protected $colors = [];

    protected function makeHash($red = 0, $green = 0, $blue = 0)
    {
        $red = Color::numberSanitize($red);
        $green = Color::numberSanitize($green);
        $blue = Color::numberSanitize($blue);
        return md5($red . '-' . $green . '-' . $blue);
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return ColorInterface
     */
    public function getColor($red = 0, $green = 0, $blue = 0)
    {
        $hash = $this->makeHash($red, $green, $blue);
        if (!isset($this->colors[$hash])) {
            $this->colors[$hash] = new Color($red, $green, $blue);
        }
        return $this->colors[$hash];
    }
}