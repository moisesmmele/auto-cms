<?php

namespace Moises\AutoCms\App\Dtos;

class ImageDto
{
    public string $name;
    public string $extension;
    public string $image;
    public static function fromJson($json)
    {
        $image = new ImageDto();
        $data = json_decode($json, associative: true);
        $image->image = base64_decode($json['image']);
        $image->name = $data['name'];
        $image->extension = $data['extension'];
        return $image;
    },
    public static function fromArray($data)
    {
        $image = new ImageDto();
        $image->name = $data['name'];
        $image->extension = $data['extension'];
        $image->image = base64_decode($data['image']);
        return $image;
    }
}