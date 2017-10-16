<?php
namespace IVIR3aM\GraphicEditor;

use IVIR3aM\GraphicEditor\Pixels\ListFacadeInterface as PixelListFacadeInterface;
use IVIR3aM\GraphicEditor\Responses\FactoryInterface as ResponseFactoryInterface;
use IVIR3aM\GraphicEditor\Shapes\ShapeListInterface;

interface EditorInterface
{
    /**
     * @return ResponseInterface
     */
    public function getResponse();

    public function setDriver(DriverInterface $driver);

    public function getDriver();

    public function setPixelListFacade(PixelListFacadeInterface $list);

    public function getPixelListFacade();

    public function setResponseFactory(ResponseFactoryInterface $factory);

    public function getResponseFactory();

    public function setShapeList(ShapeListInterface $list);

    public function getShapeList();


}