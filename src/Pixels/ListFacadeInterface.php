<?php
namespace IVIR3aM\GraphicEditor\Pixels;

use IVIR3aM\GraphicEditor\ColorInterface;

interface ListFacadeInterface
{
    public function __construct(PixelListInterface $list, FactoryInterface $factory);

    public function setPixelList(PixelListInterface $list);

    /**
     * @return PixelListInterface
     */
    public function getPixelList();

    public function setPixelFactory(FactoryInterface $factory);

    /**
     * @return FactoryInterface
     */
    public function getPixelFactory();

    public function addPixelByPoints(ColorInterface $color, $x = 0, $y = 0);

    public function resetPixels();
}