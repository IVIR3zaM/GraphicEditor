<?php
namespace IVIR3aM\GraphicEditor;

class PixelListFacade implements PixelListFacadeInterface
{
    /**
     * @var PixelListInterface
     */
    protected $pixelList;

    /**
     * @var PixelFactoryInterface
     */
    protected $pixelFactory;

    public function __construct(PixelListInterface $list, PixelFactoryInterface $factory)
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

    public function setPixelFactory(PixelFactoryInterface $factory)
    {
        $this->pixelFactory = $factory;
        return $this;
    }

    /**
     * @return PixelFactoryInterface
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