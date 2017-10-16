<?php
namespace IVIR3aM\GraphicEditor\Tests\Pixels;

use IVIR3aM\GraphicEditor\Pixel;
use IVIR3aM\GraphicEditor\Pixels\PixelList;
use PHPUnit\Framework\TestCase;

class PixelListTest extends TestCase
{
    /**
     * @var PixelList
     */
    private $list;

    public function setUp()
    {
        $this->list = new PixelList();
    }

    public function testAddRemove()
    {
        $this->assertSame(0, $this->list->count());

        $px1 = new Pixel(1, 12);
        $this->list->addPixel($px1);
        $this->assertSame(1, $this->list->count());
        $this->assertSame($px1, $this->list->getPixel(0));

        $px2 = new Pixel(234, 176);
        $this->list->addPixel($px2);
        $this->assertSame(2, $this->list->count());
        $this->assertSame($px2, $this->list->getPixel(1));

        $this->list->removePixelByIndex(0);
        $this->assertSame(1, $this->list->count());
        $this->assertSame($px2, $this->list->getPixel(0));

        $this->list->removePixel($px2);
        $this->assertSame(0, $this->list->count());
        $this->assertNull($this->list->getPixel(0));
    }

    public function testIterator()
    {
        $px1 = new Pixel(1, 12);
        $this->list->addPixel($px1);

        $px2 = new Pixel(234, 176);
        $this->list->addPixel($px2);

        $this->assertSame(0, $this->list->key());
        $this->assertSame($px1, $this->list->current());
        $this->assertTrue($this->list->valid());

        $this->list->next();
        $this->assertTrue($this->list->valid());
        $this->assertSame(1, $this->list->key());
        $this->assertSame($px2, $this->list->current());

        $this->list->next();
        $this->assertFalse($this->list->valid());
        $this->assertSame(2, $this->list->key());
        $this->assertNull($this->list->current());

        $this->list->rewind();
        $this->assertSame(0, $this->list->key());
        $this->assertTrue($this->list->valid());
    }

    public function testResetObjects()
    {
        $this->assertSame(0, $this->list->count());

        $this->list->addPixel(new Pixel(1, 12));
        $this->list->addPixel(new Pixel(234, 176));

        $this->assertSame(2, $this->list->count());

        $this->list->resetPixels();
        $this->assertSame(0, $this->list->count());
    }
}