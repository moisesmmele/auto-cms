<?php

namespace Moises\AutoCms\App\Controllers\Images;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Repositories\Pdo\Image\PdoImageRepository;
use Moises\AutoCms\App\Services\Image\ImageService;
use Moises\AutoCms\Core\Repositories\ImageRepository;

class ImageController extends Controller
{
    protected ImageService $imageService;
    public function __construct()
    {
        parent::__construct();
        $this->imageService = App::container()->get(ImageService::class);
    }

    public function index($category)
    {
        $images = $this->imageService->getByCategory($category);
        $newImages = [];
        foreach ($images as $index => $image) {
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
    public function show($url)
    {
        header('Content-type: image/jpeg');
        $image = App::storage()->read($url);
        echo $image;

    }
    public function create()
    {
        $data = json_decode($this->request->getContent(), true);
        $this->imageService->upload($data);
        http_response_code(200);
    }

    public function destroy($id)
    {
        $this->imageService->delete($id);
    }

    public function createTest()
    {
        $filesArray = $this->request->files;
        error_log("Files in inputBag: " . count($filesArray));
        $imageIds = [];

        foreach ($filesArray as $item) {
            error_log("=== Processing file ===");

            $filepath = $item->getRealPath();
            error_log("File path: " . $filepath);

            $name = uniqid();
            $extension = $item->guessExtension();
            error_log("Generated name: " . $name.'.'.$extension);

            error_log("About to read file contents");
            $file = file_get_contents($filepath);
            error_log("File contents read, size: " . strlen($file));

            error_log("About to call imageService->uploadFromFile");
            $image = $this->imageService->uploadFromFile($file, $name, $extension, 'NULL');
            error_log("uploadFromFile returned, image ID: " . $image->getId());

            $imageIds[] = [
                'id' => $image->getId(),
            ];
            error_log("Added to imageIds array");
        }

        error_log("About to encode JSON");
        $jsonResponse = json_encode($imageIds);
        error_log("JSON encoded: " . $jsonResponse);

        error_log("About to echo JSON");
        echo $jsonResponse;
        error_log("JSON echoed");
    }
}