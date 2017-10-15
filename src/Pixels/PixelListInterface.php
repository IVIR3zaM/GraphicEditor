<?php
namespace IVIR3aM\GraphicEditor\Pixels;

use IVIR3aM\GraphicEditor\PixelInterface;

interface PixelListInterface extends \Iterator, \Countable
{
    public function addPixel(PixelInterface $pixel);

    /**
     * @param int $index
     * @return PixelInterface|null
     */
    public function getPixel($index);

    public function removePixel(PixelInterface $pixel);

    /**
     * @param int $index
     */
    public function removePixelByIndex($index);
}