<?php
namespace IVIR3aM\GraphicEditor;

interface ResponseInterface
{
    public function setStatus($code, $message = '');

    public function getStatus();

    public function getStatusCode();

    public function getStatusMessage();

    public function setHeader($key, $value);

    public function unsetHeader($key);

    public function getHeader($key);

    /**
     * @return array
     */
    public function getHeaders();

    public function setBody($content);

    public function getBody();
}