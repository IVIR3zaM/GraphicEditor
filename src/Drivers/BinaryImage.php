<?php
namespace IVIR3aM\GraphicEditor\Drivers;

use IVIR3aM\GraphicEditor\ColorInterface;
use IVIR3aM\GraphicEditor\DriverInterface;
use IVIR3aM\GraphicEditor\Pixels\PixelListInterface;
use IVIR3aM\GraphicEditor\ResponseInterface;
use IVIR3aM\GraphicEditor\Responses\Factory as ResponseFactory;
use Exception;

class BinaryImage implements DriverInterface
{
    protected $padding;
    protected $type;
    protected $types = [];

    public function __construct($type = 'jpg', $padding = 10)
    {
        $this->defineTypes();
        $this->setType($type);
        $this->setPadding($padding);
    }

    protected function defineTypes()
    {
        $types = imagetypes();
        if (function_exists('imagepng') && $types & IMG_PNG) {
            $this->types['png'] = 'imagepng';
        }
        if (function_exists('imagejpeg') && $types & IMG_JPG) {
            $this->types['jpg'] = 'imagejpeg';
            $this->types['jpeg'] = 'imagejpeg';
        }
        if (function_exists('imagegif') && $types & IMG_GIF) {
            $this->types['gif'] = 'imagegif';
        }
        if (defined('IMG_BMP') && function_exists('imagebmp') && $types & IMG_BMP) {
            $this->types['bmp'] = 'imagebmp';
        }
    }

    public function setType($type)
    {
        $type = strtolower(trim($type));
        if (!isset($this->types[$type])) {
            throw new Exception("There is no driver for type '{$type}'");
        }
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setPadding($percent)
    {
        $this->padding = abs(floatval($percent));
        return $this;
    }

    public function getPadding()
    {
        return $this->padding;
    }

    protected function fixDimension($number)
    {
        return ++$number;
    }

    protected function getCanvasSize(PixelListInterface $pixels)
    {
        $width = $height = 0;
        foreach ($pixels as $pixel) {
            $x = $this->fixDimension($pixel->getX());
            if ($x > $width) {
                $width = $x;
            }
            $y = $this->fixDimension($pixel->getY());
            if ($y > $height) {
                $height = $y;
            }
        }
        $width += ($width * $this->getPadding()) / 100;
        $height += ($height * $this->getPadding()) / 100;
        return [round($width), round($height)];
    }

    protected function getColor(ColorInterface $color, $img, &$colors)
    {
        $code = $color->getHexColorCode();
        if (!isset($colors[$code])) {
            $colors[$code] = imagecolorallocate($img, $color->getRed(), $color->getGreen(), $color->getBlue());
        }
        return $colors[$code];
    }

    protected function fetchOutput($img)
    {
        ob_start();
        call_user_func($this->types[$this->getType()], $img);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @param PixelListInterface $pixels
     * @param ResponseFactory $factory
     * @return ResponseInterface
     */
    public function draw(PixelListInterface $pixels, ResponseFactory $factory)
    {
        $canvas = $this->getCanvasSize($pixels);
        $img = imagecreatetruecolor($canvas[0], $canvas[1]);
        $colors = [];
        foreach ($pixels as $pixel) {
            $color = $this->getColor($pixel->getColor(), $img, $colors);
            imagesetpixel($img, $pixel->getX(), $pixel->getY(), $color);
        }
        $response = $factory->makeResponse($this->fetchOutput($img), 200, 'OK');
        imagedestroy($img);
        $response->setHeader('Content-Type', 'image/' . $this->getType());
        return $response;
    }
}