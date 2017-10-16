<?php
namespace IVIR3aM\GraphicEditor;

use Exception;

class ConsoleApp
{
    protected function sanitizeName($type)
    {
        return ucfirst(strtolower(trim($type)));
    }

    protected function getTaskClass($arguments)
    {
        if (!isset($arguments['task'])) {
            throw new Exception('Task not defined');
        }
        $task = $this->sanitizeName($arguments['task']);
        $class = "IVIR3aM\\GraphicEditor\\Tasks\\{$task}";
        if (!class_exists($class)) {
            throw new Exception("Invalid Task '{$task}'");
        }
        return $class;
    }

    protected function getTaskMethod($task, $arguments)
    {
        if (!isset($arguments['action'])) {
            throw new Exception('Action not defined');
        }
        $method = $this->sanitizeName($arguments['action']) . 'Action';
        if (!method_exists($task, $method)) {
            throw new Exception("Invalid Task Action '{$method}'");
        }
        return $method;
    }

    protected function getParams($arguments)
    {
        if (!isset($arguments['params'])) {
            return [];
        }
        if (!is_array($arguments['params'])) {
            $arguments['params'] = [$arguments['params']];
        }
        return $arguments['params'];
    }

    public function handle($arguments = [])
    {
        $class = $this->getTaskClass($arguments);
        $task = new $class();
        $method = $this->getTaskMethod($task, $arguments);
        $params = $this->getParams($arguments);
        $response = $task->$method($params);
        if (!($response instanceof ResponseInterface)) {
            throw new Exception('Invalid Response');
        }
        echo $response->getBody();
    }
}