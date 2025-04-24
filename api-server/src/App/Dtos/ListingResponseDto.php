<?php

namespace Moises\AutoCms\App\Dtos;

use Moises\AutoCms\Core\Entities\Listing\Listing;

class ListingResponseDto
{
    public static function fromEntity(Listing $listing)
    {
        return [
            'id' => $listing->getId(),
            'price' => $listing->getPrice(),
            'vehicle' => VehicleResponseDto::fromEntity($listing->getVehicle())
        ];
    }
}