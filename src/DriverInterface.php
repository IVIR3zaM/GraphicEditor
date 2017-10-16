<?php
namespace IVIR3aM\GraphicEditor;

use IVIR3aM\GraphicEditor\Pixels\PixelListInterface;
use IVIR3aM\GraphicEditor\Responses\Factory as ResponseFactory;

interface DriverInterface
{
    /**
     * @param PixelListInterface $pixels
     * @param ResponseFactory $factory
     * @return ResponseInterface
     */
    public function draw(PixelListInterface $pixels, ResponseFactory $factory);
}