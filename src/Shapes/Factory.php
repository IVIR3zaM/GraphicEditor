<?php
namespace IVIR3aM\GraphicEditor\Shapes;

use IVIR3aM\GraphicEditor\ColorInterface;
use IVIR3aM\GraphicEditor\ShapeAbstract;
use IVIR3aM\GraphicEditor\Colors\FlyweightFactoryInterface as ColorFactoryInterface;
use Exception;

class Factory implements FactoryInterface
{
    protected $colorFactory;

    protected function sanitizeName($type)
    {
        return ucfirst(strtolower(trim($type)));
    }

    protected function getShapeClass($type)
    {
        $type = $this->sanitizeName($type);
        $class = "IVIR3aM\\GraphicEditor\\Shapes\\{$type}";
        if (!class_exists($class) || !is_subclass_of($class, ShapeAbstract::class)) {
            throw new Exception("Invalid Shape type '{$type}'");
        }
        return $class;
    }

    protected function setShapeAttributes(ShapeAbstract $shape, $params = [])
    {
        foreach ($params as $name => $value) {
            $name = $this->sanitizeName($name);
            $method = "set{$name}";
            if (!method_exists($shape, $method)) {
                continue;
            }
            if ($name == 'Color') {
                $value = $this->makeColor($value);
            }
            $shape->$method($value);
        }
    }

    /**
     * @param $type
     * @param array $params
     * @return ShapeAbstract
     */
    public function makeShape($type, $params = [])
    {
        $class = $this->getShapeClass($type);
        $shape = new $class();
        $this->setShapeAttributes($shape, $params);
        return $shape;
    }

    protected function makeColor($value)
    {
        if (!$this->getColorFactory() || $value instanceof ColorInterface) {
            return $value;
        }
        if (is_array($value) && count($value) >= 3) {
            return $this->getColorFactory()->getColor($value[0], $value[1], $value[2]);
        }
        if (is_string($value) && preg_match('/(?P<r>[a-f0-9]{2})(?P<g>[a-f0-9]{2})(?P<b>[a-f0-9]{2})/i', $value, $match)) {
            return $this->getColorFactory()->getColor(hexdec($match['r']), hexdec($match['g']), hexdec($match['b']));
        }
        return $value;
    }

    public function setColorFactory(ColorFactoryInterface $factory)
    {
        $this->colorFactory = $factory;
        return $this;
    }

    public function getColorFactory()
    {
        return $this->colorFactory;
    }
}