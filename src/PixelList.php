<?php
namespace IVIR3aM\GraphicEditor;

class PixelList implements PixelListInterface
{
    protected $list = [];
    protected $pointer = 0;

    public function addPixel(PixelInterface $pixel)
    {
        $this->list[] = $pixel;
        return $this;
    }

    /**
     * @param int $index
     * @return PixelInterface|null
     */
    public function getPixel($index)
    {
        if (isset($this->list[$index])) {
            return $this->list[$index];
        }
    }

    public function removePixel(PixelInterface $pixel)
    {
        foreach($this->list as $index => $value) {
            if ($value == $pixel) {
                $this->removePixelByIndex($index);
            }
        }
        return $this;
    }

    /**
     * @param int $index
     * @return PixelListInterface
     */
    public function removePixelByIndex($index)
    {
        if (isset($this->list[$index])) {
            unset($this->list[$index]);
            $this->list = array_values($this->list);
        }
        return $this;
    }

    public function count()
    {
        return count($this->list);
    }

    public function current()
    {
        return $this->getPixel($this->pointer);
    }

    public function key()
    {
        return $this->pointer;
    }

    public function next()
    {
        $this->pointer++;
    }

    public function rewind()
    {
        $this->pointer = 0;
    }

    public function valid()
    {
        return isset($this->list[$this->pointer]);
    }
}