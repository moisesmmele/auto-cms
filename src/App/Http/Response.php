<?php

namespace Moises\AutoCms\App\Http;

class Response
{
    public function __construct()
    {
        $this->statusCode = 200; // Default status code is 200 OK
        $this->body = '';
        $this->headers = [];
#        $this->request = App::container()->get(Request::class);
    }

    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function addHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }
        echo $this->body;
    }
}