<?php

namespace Moises\AutoCms\App\Services\Image;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Repositories\Pdo\Image\PdoImageRepository;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoVehicleImageRepository;
use Moises\AutoCms\Core\Repositories\ImageRepository;

class ImageService
{
    private ImageRepository $repository;
    public function __construct()
    {
        $this->repository = App::container()->get(ImageRepository::class);
    }

    public function upload($data)
    {
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, base64_decode($data['image']));
        rewind($stream);
        $name = str_replace(' ', '-', $data['name']);
        $data['name'] = $name;
        $img = $this->repository->create($data);
        App::storage()->writeStream($data['name'].'.'.$data['extension'], $stream);
        return $img;
    }
    public function getByCategory($category)
    {
        return $this->repository->findByCategory($category);
    }
    public function list()
    {

    }
    public function delete($id){
        $image = $this->repository->findById($id);
        App::storage()->delete($image->getId());
        $result = $this->repository->delete($id);
        if ($result) {
            return true;
        }
        return false;
    }
}