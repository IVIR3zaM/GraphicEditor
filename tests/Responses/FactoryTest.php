<?php
namespace IVIR3aM\GraphicEditor\Tests\Responses;

use IVIR3aM\GraphicEditor\ResponseInterface;
use IVIR3aM\GraphicEditor\Responses\Factory as ResponseFactory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    /**
     * @var ResponseFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ResponseFactory();
    }

    public function testFactory()
    {
        $response = $this->factory->makeResponse('test', 403, 'Forbidden');
        $this->assertTrue($response instanceof ResponseInterface);
        $this->assertSame('test', $response->getBody());
        $this->assertSame(403, $response->getStatusCode());
        $this->assertSame('Forbidden', $response->getStatusMessage());
        $this->assertEquals(4, $response->getHeader('Content-Length'));
    }
}