<?php
namespace IVIR3aM\GraphicEditor\Responses;

use IVIR3aM\GraphicEditor\ResponseInterface;
use IVIR3aM\GraphicEditor\Response;

class Factory implements FactoryInterface
{
    /**
     * @param string $body
     * @param int $code
     * @param string $message
     * @return ResponseInterface
     */
    public function makeResponse($body = '', $code = 200, $message = 'OK') {
        return new Response($body, $code, $message);
    }
}