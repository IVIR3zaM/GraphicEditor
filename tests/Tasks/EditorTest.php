<?php
namespace IVIR3aM\GraphicEditor\Tests\Tasks;

use IVIR3aM\GraphicEditor\ResponseInterface;
use IVIR3aM\GraphicEditor\Tasks\Editor;
use PHPUnit\Framework\TestCase;

class EditorTest extends TestCase
{
    /**
     * @var Editor
     */
    private $editor;

    public function setUp()
    {
        $this->editor = new Editor();
    }

    public function testJsonFunctionality()
    {
        $response = $this->editor->JsonAction(['{"circle":{"cx":20,"cy":20,"radius":2,"color":"#ff0000"}}']);
        $this->assertTrue($response instanceof ResponseInterface);

        $data = '[{"x":22,"y":20,"color":"#ff0000"},{"x":21,"y":21,"color":"#ff0000"},{"x":20,"y":22,"color":"#ff0000"},{"x":19,"y":21,"color":"#ff0000"},{"x":18,"y":21,"color":"#ff0000"},{"x":18,"y":20,"color":"#ff0000"},{"x":18,"y":19,"color":"#ff0000"},{"x":19,"y":18,"color":"#ff0000"},{"x":20,"y":18,"color":"#ff0000"},{"x":21,"y":18,"color":"#ff0000"},{"x":21,"y":19,"color":"#ff0000"}]';
        $this->assertEquals($data, $response->getBody());
    }

    public function testImageFunctionality()
    {
        $response = $this->editor->ImageAction(['{"circle":{"cx":20,"cy":20,"radius":2,"color":"#ff0000"}}']);
        $this->assertTrue($response instanceof ResponseInterface);

        $image = tempnam(sys_get_temp_dir(), 'GraphicEditorTest');
        file_put_contents($image, $response->getBody());
        list($width, $height) = getimagesize($image);

        $this->assertGreaterThanOrEqual(22, $width);
        $this->assertGreaterThanOrEqual(22, $height);
        unlink($image);
    }

    public function testImageExtraParamsFunctionality()
    {
        $response = $this->editor->ImageAction(['{"circle":{"cx":20,"cy":20,"radius":2,"color":"#ff0000"}}', 'png', 0]);
        $this->assertTrue($response instanceof ResponseInterface);

        $image = tempnam(sys_get_temp_dir(), 'GraphicEditorTest');
        file_put_contents($image, $response->getBody());
        list($width, $height) = getimagesize($image);

        $this->assertEquals(23, $width);
        $this->assertEquals(23, $height);
        unlink($image);
    }
}