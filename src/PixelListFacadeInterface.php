<?php
namespace IVIR3aM\GraphicEditor;

interface PixelListFacadeInterface
{
    public function __construct(PixelListInterface $list, PixelFactoryInterface $factory);
    public function setPixelList(PixelListInterface $list);

    /**
     * @return PixelListInterface
     */
    public function getPixelList();
    public function setPixelFactory(PixelFactoryInterface $factory);

    /**
     * @return PixelFactoryInterface
     */
    public function getPixelFactory();
    public function addPixelByPoints(ColorInterface $color, $x = 0, $y = 0);
}