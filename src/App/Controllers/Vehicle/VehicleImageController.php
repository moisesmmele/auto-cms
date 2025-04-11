<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Vehicle\VehicleImageService;

class VehicleImageController extends Controller
{
    private VehicleImageService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(VehicleImageService::class);
    }

    public function index()
    {
        $images = $this->service->getAllImages();
        echo json_encode($images);
    }

    public function show($id)
    {
        $image = $this->service->getImage($id);
        echo json_encode($image);
    }

    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->upload($data);
        echo json_encode($result);
    }

    public function destroy($id)
    {
        $result = $this->service->deleteImage($id);
        echo json_encode($result);
    }
}
