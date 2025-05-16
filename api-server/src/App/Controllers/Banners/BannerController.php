<?php

namespace Moises\AutoCms\App\Controllers\Banners;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Image\ImageService;

class BannerController extends Controller
{
    protected ImageService $imageService;
    public function __construct()
    {
        parent::__construct();
        $this->imageService = App::container()->get(ImageService::class);
    }

    public function index(){
        $banners = $this->imageService->getByCategory('banners');
        $newImages = [];
        foreach ($banners as $index => $image) {
            $newImages[$index]["id"] = $image->getId();
            $newImages[$index]["name"] = $image->getName();
            $newImages[$index]["extension"] = $image->getExtension();
            $newImages[$index]["height"] = $image->getHeight();
            $newImages[$index]["width"] = $image->getWidth();
            $newImages[$index]["category"] = $image->getCategory();
            $newImages[$index]["url"] = "/images/".$image->getName().".".$image->getExtension();
        }

        header('Content-type: application/json');
        echo json_encode($newImages);
    }
    public function store(){
        $filesArray = $this->request->files;
        error_log("Files in inputBag: " . count($filesArray));
        $imageIds = [];
        foreach ($filesArray as $item) {
            $filepath = $item->getRealPath();
            $name = uniqid();
            $extension = $item->guessExtension();

            error_log($name.'.'.$extension);

            $file = file_get_contents($filepath);
            $image = $this->imageService->uploadFromFile($file, $name, $extension, 'banners');

            $imageIds[] = [
                'id' => $image->getId(),
            ];
        }
        echo json_encode($imageIds);
        error_log(json_encode($imageIds));
    }
}