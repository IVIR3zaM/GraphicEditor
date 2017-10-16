<?php
namespace IVIR3aM\GraphicEditor;

use IVIR3aM\GraphicEditor\Pixels\PixelListInterface;
use IVIR3aM\GraphicEditor\Responses\FactoryInterface as ResponseFactoryInterface;

interface DriverInterface
{
    /**
     * @param PixelListInterface $pixels
     * @param ResponseFactoryInterface $factory
     * @return ResponseInterface
     */
    public function draw(PixelListInterface $pixels, ResponseFactoryInterface $factory);
}