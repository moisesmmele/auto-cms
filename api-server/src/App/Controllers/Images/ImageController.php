<?php

namespace Moises\AutoCms\App\Controllers\Images;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Dtos\ImageDto;
use Moises\AutoCms\App\Repositories\Pdo\Image\PdoImageRepository;

class ImageController extends Controller
{
    public function index()
    {
        $images = (new PdoImageRepository())->all();
        $newImages = [];
        foreach ($images as $index => $image) {
            $newImages[$index]["id"] = $image["id"];
            $newImages[$index]["url"] = "http://localhost:8083/images/".$image["name"].".".$image["extension"];
        }

//        foreach ($images as $image => $index) {
//            $newImages[$index]["id"] = $image["id"];
//            $newImages[$index]["url"] = $image["url"];
//        }
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
        //receives data as associative array
        $data = json_decode($this->request->getContent(), true);
        //saves metadata to database
        (new PdoImageRepository())->insert(
            name: $data['name'],
            extension: $data['extension'],
            width: $data['width'],
            height: $data['height']);
        // converts decoded image to string
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, base64_decode($data['image']));
        rewind($stream);
        //saves image to filesystem
        App::storage()->writeStream($data['name'].'.'.$data['extension'], $stream);
        http_response_code(200);
    }
}