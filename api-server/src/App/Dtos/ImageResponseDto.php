<?php

namespace Moises\AutoCms\App\Dtos;

use Moises\AutoCms\Core\Entities\Image\Image;

class ImageResponseDto
{
    public static function fromEntity(Image $image)
    {
        return [
            'id' => $image->getId(),
            'name' => $image->getName(),
            'extension' => $image->getExtension(),
            'height' => $image->getHeight(),
            'width' => $image->getWidth(),
            'url' => "/images/".$image->getName().".".$image->getExtension()
        ];
    }
}