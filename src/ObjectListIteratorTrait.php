<?php
namespace IVIR3aM\GraphicEditor;

trait ObjectListIteratorTrait
{
    protected $list = [];
    protected $pointer = 0;

    protected function addObject($object)
    {
        $this->list[] = $object;
        return $this;
    }

    /**
     * @param int $index
     * @return Object|null
     */
    protected function getObject($index)
    {
        if (isset($this->list[$index])) {
            return $this->list[$index];
        }
    }

    protected function removeObject($object)
    {
        foreach($this->list as $index => $value) {
            if ($value == $object) {
                $this->removeObjectByIndex($index);
            }
        }
        return $this;
    }

    /**
     * @param int $index
     * @return self
     */
    protected function removeObjectByIndex($index)
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
        return $this->getObject($this->pointer);
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