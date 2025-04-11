<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Vehicle\ColorService;

class ColorController extends Controller
{
    private ColorService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(ColorService::class);
    }

    public function index()
    {
        $colors = $this->service->getAllColors();
        echo json_encode($colors);
    }

    public function show($id)
    {
        $color = $this->service->getColor($id);
        echo json_encode($color);
    }

    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->createNewColor($data);
        echo json_encode($result);
    }

    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->updateColor(data: $data, colorId: $id);
        echo json_encode($result);
    }

    public function destroy($id)
    {
        $result = $this->service->deleteColor($id);
        echo json_encode($result);
    }
}
