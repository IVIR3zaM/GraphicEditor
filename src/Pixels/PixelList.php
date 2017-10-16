<?php
namespace IVIR3aM\GraphicEditor\Pixels;

use IVIR3aM\GraphicEditor\ObjectListIteratorTrait;
use IVIR3aM\GraphicEditor\PixelInterface;

class PixelList implements PixelListInterface
{
    use ObjectListIteratorTrait;

    public function addPixel(PixelInterface $pixel)
    {
        return $this->addObject($pixel);
    }

    /**
     * @param int $index
     * @return PixelInterface|null
     */
    public function getPixel($index)
    {
        return $this->getObject($index);
    }

    public function removePixel(PixelInterface $pixel)
    {
        return $this->removeObject($pixel);
    }

    /**
     * @param int $index
     * @return PixelListInterface
     */
    public function removePixelByIndex($index)
    {
        return $this->removeObjectByIndex($index);
    }

    public function resetPixels()
    {
        return $this->resetObjects();
    }
}