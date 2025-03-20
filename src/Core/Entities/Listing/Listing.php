<?php

namespace Moises\AutoCms\Core\Entities\Listing;

use Moises\AutoCms\Core\Entities\Vehicle\Vehicle;

class Listing
{
    public int $id;
    public Vehicle $vehicle;
    public float $price;

}