<?php
namespace IVIR3aM\GraphicEditor\Tests\Shapes;

use IVIR3aM\GraphicEditor\Shapes\ShapeList;
use PHPUnit\Framework\TestCase;

class ShapeListTest extends TestCase
{
    /**
     * @var ShapeList
     */
    private $list;

    public function setUp()
    {
        $this->list = new ShapeList();
    }

    public function testAddRemove()
    {
        $this->assertSame(0, $this->list->count());

        $shape1 = new FakeShape();
        $this->list->addShape($shape1);
        $this->assertSame(1, $this->list->count());
        $this->assertSame($shape1, $this->list->getShape(0));

        $shape2 = new FakeShape();
        $this->list->addShape($shape2);
        $this->assertSame(2, $this->list->count());
        $this->assertSame($shape2, $this->list->getShape(1));

        $this->list->removeShapeByIndex(0);
        $this->assertSame(1, $this->list->count());
        $this->assertSame($shape2, $this->list->getShape(0));

        $this->list->removeShape($shape2);
        $this->assertSame(0, $this->list->count());
        $this->assertNull($this->list->getShape(0));
    }

    public function testIterator()
    {
        $shape1 = new FakeShape();
        $this->list->addShape($shape1);

        $shape2 = new FakeShape();
        $this->list->addShape($shape2);

        $this->assertSame(0, $this->list->key());
        $this->assertSame($shape1, $this->list->current());
        $this->assertTrue($this->list->valid());

        $this->list->next();
        $this->assertTrue($this->list->valid());
        $this->assertSame(1, $this->list->key());
        $this->assertSame($shape2, $this->list->current());

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

        $this->list->addShape(new FakeShape());
        $this->list->addShape(new FakeShape());

        $this->assertSame(2, $this->list->count());

        $this->list->resetShapes();
        $this->assertSame(0, $this->list->count());
    }
}