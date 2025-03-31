<?php

namespace Moises\AutoCms\App\Repositories\Pdo;

use Moises\AutoCms\Core\Repositories\Vehicle\ColorsRepository;

class FakeColorsRepository implements ColorsRepository
{
    public array $colors = [];
    public function __construct()
    {
        $this->colors = [
            ["id" => "1", "label" => "Vermelho"],
            ["id" => "2", "label" => "Preto"],
            ["id" => "3", "label" => "Prata"],
        ];
    }

    public function all()
    {
        return $this->colors;
    }

    public function find(int $id)
    {
        foreach ($this->colors as $color) {
            if ($color["id"] == $id) {
                return $color;
            }
        };
    }

    public function create(array $data)
    {
        $this->colors[] = $data;
        return $this->colors;
    }
}