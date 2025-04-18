<?php

namespace Moises\AutoCms\Core\Entities\Vehicle;

class Accessory
{
    readonly int $id;
    readonly string $label;
    readonly string $description;
    public function __construct(int $id, string $label, string $description)
    {
        $this->id = $id;
        $this->label = $label;
        $this->description = $description;
    }
    public function getLabel(): string
    {
        return $this->label;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
}
