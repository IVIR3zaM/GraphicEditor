<?php
namespace IVIR3aM\GraphicEditor;

class Response implements ResponseInterface
{
    protected $statusCode;
    protected $statusMessage;
    protected $headers = [];
    protected $body;

    public function __construct($body = '', $statusCode = 200, $message = '')
    {
        $this->setBody($body);
        $this->setStatus($statusCode, $message);
    }

    public function setStatus($code, $message = '')
    {
        $this->statusCode = intval($code);
        $this->statusMessage = strval($message);
        return $this;
    }

    public function getStatus()
    {
        return $this->getStatusCode() . ' ' . $this->getStatusMessage();
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    public static function sanitizeHeaderKey($key)
    {
        $key = preg_replace('/[^a-z0-9\-]+/', '-', strtolower(trim($key)));
        $key = explode('-', $key);
        $key = array_map('ucfirst', $key);
        return implode('-', $key);
    }

    public function setHeader($key, $value)
    {
        $key = static::sanitizeHeaderKey($key);
        $this->headers[$key] = strval($value);
        return $this;
    }

    public function unsetHeader($key)
    {
        $key = static::sanitizeHeaderKey($key);
        if(isset($this->headers[$key])) {
            unset($this->headers[$key]);
        }
        return $this;
    }

    public function getHeader($key)
    {
        $key = static::sanitizeHeaderKey($key);
        if(isset($this->headers[$key])) {
            return $this->headers[$key];
        }
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    public function setBody($content)
    {
        $this->body = strval($content);
        $this->setHeader('Content-Length', strlen($this->body));
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }
}