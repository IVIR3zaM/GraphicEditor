<?php
namespace IVIR3aM\GraphicEditor\Tests;

use IVIR3aM\GraphicEditor\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @var Response
     */
    private $response;

    public function setUp()
    {
        $this->response = new Response();
    }

    public function testStatus()
    {
        $this->response->setStatus(404, 'Not Found');
        $this->assertSame(404, $this->response->getStatusCode());
        $this->assertSame('Not Found', $this->response->getStatusMessage());
        $this->assertSame('404 Not Found', $this->response->getStatus());
    }

    public function testSetUnsetHeaders()
    {
        $headers = $this->response->getHeaders();
        $headers['Accept'] = 'text/html';
        $this->response->setHeader('accept', 'text/html');
        $this->assertSame('text/html', $this->response->getHeader('Accept'));
        $this->assertSame($headers, $this->response->getHeaders());

        unset($headers['Accept']);
        $this->response->unsetHeader('accept');
        $this->assertNull($this->response->getHeader('accept'));
        $this->assertSame($headers, $this->response->getHeaders());
    }

    public function testBody()
    {
        $this->response->setBody('Lorem Ipsum');
        $this->assertSame('Lorem Ipsum', $this->response->getBody());
        $this->assertEquals(strlen('Lorem Ipsum'), $this->response->getHeader('Content-Length'));
    }
}