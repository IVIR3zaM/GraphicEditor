<?php
namespace IVIR3aM\GraphicEditor;

use IVIR3aM\GraphicEditor\Pixels\ListFacadeInterface as PixelListFacadeInterface;
use IVIR3aM\GraphicEditor\Responses\FactoryInterface as ResponseFactoryInterface;
use IVIR3aM\GraphicEditor\Shapes\ShapeListInterface;
use Exception;

class Editor implements EditorInterface
{
    protected $driver;
    protected $pixelListFacade;
    protected $responseFactory;
    protected $shapeList;

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        $this->getPixelListFacade()->resetPixels();
        foreach ($this->getShapeList() as $shape) {
            $shape->getPixels($this->getPixelListFacade());
        }
        $list = $this->getPixelListFacade()->getPixelList();
        $factory = $this->getResponseFactory();
        return $this->getDriver()->draw($list, $factory);
    }

    public function setDriver(DriverInterface $driver)
    {
        $this->driver = $driver;
        return $this;
    }

    public function getDriver()
    {
        if (!($this->driver instanceof DriverInterface)) {
            throw new Exception("Object of Type DriverInterface expected");
        }
        return $this->driver;
    }

    public function setPixelListFacade(PixelListFacadeInterface $list)
    {
        $this->pixelListFacade = $list;
        return $this;
    }

    public function getPixelListFacade()
    {
        if (!($this->pixelListFacade instanceof PixelListFacadeInterface)) {
            throw new Exception("Object of Type PixelListFacadeInterface expected");
        }
        return $this->pixelListFacade;
    }

    public function setResponseFactory(ResponseFactoryInterface $factory)
    {
        $this->responseFactory = $factory;
        return $this;
    }

    public function getResponseFactory()
    {
        if (!($this->responseFactory instanceof ResponseFactoryInterface)) {
            throw new Exception("Object of Type ResponseFactoryInterface expected");
        }
        return $this->responseFactory;
    }

    public function setShapeList(ShapeListInterface $list)
    {
        $this->shapeList = $list;
        return $this;
    }

    public function getShapeList()
    {
        if (!($this->shapeList instanceof ShapeListInterface)) {
            throw new Exception("Object of Type ShapeListInterface expected");
        }
        return $this->shapeList;
    }
}