<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Vehicle\AccessoryService;

class AccessoryController extends Controller
{
    private AccessoryService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(AccessoryService::class);
    }

    public function index()
    {
        $accessories = $this->service->getAllAccessories();
        echo json_encode($accessories);
    }

    public function show($id)
    {
        $accessory = $this->service->getAccessory($id);
        echo json_encode($accessory);
    }

    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->createNewAccessory($data);
        echo json_encode($result);
    }

    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->updateAccessory(data: $data, accessoryId: $id);
        echo json_encode($result);
    }

    public function destroy($id)
    {
        $result = $this->service->deleteAccessory($id);
        echo json_encode($result);
    }
}
