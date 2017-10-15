<?php
namespace IVIR3aM\GraphicEditor\Pixels;

use IVIR3aM\GraphicEditor\ColorInterface;

class ListFacade implements ListFacadeInterface
{
    /**
     * @var PixelListInterface
     */
    protected $pixelList;

    /**
     * @var FactoryInterface
     */
    protected $pixelFactory;

    public function __construct(PixelListInterface $list, FactoryInterface $factory)
    {
        $this->setPixelList($list);
        $this->setPixelFactory($factory);
    }

    public function setPixelList(PixelListInterface $list)
    {
        $this->pixelList = $list;
        return $this;
    }

    /**
     * @return PixelListInterface
     */
    public function getPixelList()
    {
        return $this->pixelList;
    }

    public function setPixelFactory(FactoryInterface $factory)
    {
        $this->pixelFactory = $factory;
        return $this;
    }

    /**
     * @return FactoryInterface
     */
    public function getPixelFactory()
    {
        return $this->pixelFactory;
    }

    public function addPixelByPoints(ColorInterface $color, $x = 0, $y = 0)
    {
        $pixel = $this->getPixelFactory()->makePixel($color, $x, $y);
        $this->getPixelList()->addPixel($pixel);
        return $this;
    }
}