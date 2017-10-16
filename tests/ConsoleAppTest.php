<?php
namespace IVIR3aM\GraphicEditor\Tests;

use Exception;
use IVIR3aM\GraphicEditor\ConsoleApp;
use PHPUnit\Framework\TestCase;

class ConsoleAppTest extends TestCase
{
    /**
     * @var ConsoleApp
     */
    private $app;

    public function setUp()
    {
        $this->app = new ConsoleApp();
    }

    public function testFunctionality()
    {
        ob_start();
        $this->app->handle([
            'task' => 'editor',
            'action' => 'json',
            'params' => [
                '{"circle":{"cx":20,"cy":20,"radius":2,"color":"#ff0000"}}'
            ],
        ]);
        $content = ob_get_contents();
        ob_end_clean();

        $data = '[{"x":22,"y":20,"color":"#ff0000"},{"x":21,"y":21,"color":"#ff0000"},{"x":20,"y":22,"color":"#ff0000"},{"x":19,"y":21,"color":"#ff0000"},{"x":18,"y":21,"color":"#ff0000"},{"x":18,"y":20,"color":"#ff0000"},{"x":18,"y":19,"color":"#ff0000"},{"x":19,"y":18,"color":"#ff0000"},{"x":20,"y":18,"color":"#ff0000"},{"x":21,"y":18,"color":"#ff0000"},{"x":21,"y":19,"color":"#ff0000"}]';
        $this->assertEquals($data, $content);
    }

    /**
     * @expectedException Exception
     */
    public function testNoTask()
    {
        $this->app->handle();
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidTask()
    {
        $this->app->handle(['task' => 'test']);
    }

    /**
     * @expectedException Exception
     */
    public function testNoAction()
    {
        $this->app->handle(['task' => 'editor']);
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidAction()
    {
        $this->app->handle(['task' => 'editor', 'action' => 'unknown']);
    }
}