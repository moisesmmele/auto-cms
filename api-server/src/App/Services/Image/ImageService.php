<?php

namespace Moises\AutoCms\App\Services\Image;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoVehicleImageRepository;

class ImageService
{
    public PdoVehicleImageRepository $ImageRepository;
    public function upload($image, $metadata)
    {
        App::storage()->write('images/'.$metadata['name'].$metadata['extension'], $image);

    }
    public function retrieve($id)
    {

    }
    public function list()
    {

    }
    public function delete($id){
        //TODO:do
    }
}