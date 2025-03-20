<?php

namespace Moises\AutoCms\Core\Entities\Lead;

use Moises\AutoCms\Core\Entities\Listing\Listing;

class Lead
{
    public int $id;
    public Listing $listing;
    public string $customerName;
    public string $email;
    public string $phone;
    public string $message;
}