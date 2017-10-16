<?php
namespace IVIR3aM\GraphicEditor\Drivers;

use IVIR3aM\GraphicEditor\DriverInterface;
use IVIR3aM\GraphicEditor\Pixels\PixelListInterface;
use IVIR3aM\GraphicEditor\ResponseInterface;
use IVIR3aM\GraphicEditor\Responses\FactoryInterface as ResponseFactoryInterface;

class JsonArrayPoints implements DriverInterface
{
    /**
     * @param PixelListInterface $pixels
     * @param ResponseFactoryInterface $factory
     * @return ResponseInterface
     */
    public function draw(PixelListInterface $pixels, ResponseFactoryInterface $factory)
    {
        $array = [];
        foreach ($pixels as $pixel) {
            $array[] = [
                'x' => $pixel->getX(),
                'y' => $pixel->getY(),
                'color' => $pixel->getColor()->getHexColorCode(),
            ];
        }
        $response = $factory->makeResponse(json_encode($array), 200, 'OK');
        $response->setHeader('Content-Type', 'application/json');
        return $response;
    }
}