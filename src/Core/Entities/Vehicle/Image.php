<?php

namespace Moises\AutoCms\Core\Entities\Vehicle;

class Image
{
    readonly int $id;
    readonly string $label;
    readonly string $uri;

    public function __construct(int $id, string $label, string $uri)
    {
        $this->id = $id;
        $this->label = $label;
        $this->uri = $uri;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getLabel(): string
    {
        return $this->label;
    }
    public function getUri(): string
    {
        return $this->uri;
    }
}