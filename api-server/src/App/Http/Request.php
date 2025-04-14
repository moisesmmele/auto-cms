<?php

namespace Moises\AutoCms\App\Http;

class Request
{
    protected $method;
    protected $uri;
    protected $query;
    protected $body;
    protected $headers;
    protected $queryParams;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->headers = getallheaders();
        $this->queryParams = $_GET ?? [];
        $this->body = $_POST;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getQueryParam(string $key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    public function getPostParam(string $key, $default = null)
    {
        return $this->postParams[$key] ?? $default;
    }

    public function getPost()
    {
        return $this->postParams;
    }

    public function getHeader(string $name, $default = null)
    {
        return $this->headers[$name] ?? $default;
    }

    public function getHeaders()
    {
        $headers = "\n";
        foreach ($this->headers as $name => $value) {
            $headers .= "$name: $value\r\n";
        }
        return $headers;
    }

    public function __toString(): string
    {
        return "\nMETHOD: {$this->getMethod()} \nURI: {$this->getUri()} \n\nHEADERS: {$this->getHeaders()}";
    }
}