<?php
namespace IVIR3aM\GraphicEditor\Drivers;

use IVIR3aM\GraphicEditor\DriverInterface;
use IVIR3aM\GraphicEditor\Pixels\PixelListInterface;
use IVIR3aM\GraphicEditor\ResponseInterface;
use IVIR3aM\GraphicEditor\Responses\Factory as ResponseFactory;

class JsonArrayPoints implements DriverInterface
{
    /**
     * @param PixelListInterface $pixels
     * @param ResponseFactory $factory
     * @return ResponseInterface
     */
    public function draw(PixelListInterface $pixels, ResponseFactory $factory)
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