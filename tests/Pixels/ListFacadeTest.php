<?php
namespace IVIR3aM\GraphicEditor\Tests;

use IVIR3aM\GraphicEditor\Color;
use IVIR3aM\GraphicEditor\Pixels\Factory as PixelFactory;
use IVIR3aM\GraphicEditor\Pixels\PixelList;
use IVIR3aM\GraphicEditor\Pixels\ListFacade as PixelListFacade;
use PHPUnit\Framework\TestCase;

class ListFacadeTest extends TestCase
{
    /**
     * @var PixelListFacade
     */
    private $list;

    public function setUp()
    {
        $this->list = new PixelListFacade(new PixelList(), new PixelFactory());
    }

    public function testAddPixels()
    {
        $this->assertSame(0, $this->list->getPixelList()->count());

        $this->list->addPixelByPoints(new Color(), 327, 127);
        $this->assertSame(1, $this->list->getPixelList()->count());

        $pixel = $this->list->getPixelFactory()->makePixel(new Color(), 327, 127);
        $this->assertEquals($pixel, $this->list->getPixelList()->getPixel(0));
    }
}