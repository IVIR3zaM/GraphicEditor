<?php
namespace IVIR3aM\GraphicEditor\Responses;

use IVIR3aM\GraphicEditor\ResponseInterface;

interface FactoryInterface
{
    /**
     * @param string $body
     * @param int $code
     * @param string $message
     * @return ResponseInterface
     */
    public function makeResponse($body = '', $code = 200, $message = 'OK');
}