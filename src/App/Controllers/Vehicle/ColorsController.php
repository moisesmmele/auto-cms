<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Repositories\Vehicle\ColorsRepository;

class ColorsController
{
    public ColorsRepository $colorsRepository;
    public function __construct()
    {
        $this->colorsRepository = App::container()->get(ColorsRepository::class);
    }
    public function index()
    {
        $colors = json_encode($this->colorsRepository->all());
        echo $colors;
    }

    public function show($id)
    {
        $color = json_encode($this->colorsRepository->find($id));
        echo $color;
    }
}