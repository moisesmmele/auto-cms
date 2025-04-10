<?php

namespace Moises\AutoCms\Core\Entities\Lead;

use Moises\AutoCms\Core\Entities\Listing\Listing;

class Lead
{
    readonly int $id;
    readonly int $listing_id;
    private Listing $listing;
    readonly string $customerName;
    readonly string $email;
    readonly string $phone;
    readonly string $message;

    public function __construct(
        int $id,
        int $listingId,
        string $customerName,
        string $email,
        string $phone,
        string $message
    )
    {
        $this->id = $id;
        $this->listingId = $listingId;
        $this->customerName = $customerName;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getListingId(): int
    {
        return $this->listingId;
    }
    public function getListing(): Listing
    {
        return $this->listing;
    }
    public function getCustomerName(): string
    {
        return $this->customerName;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function getMessage(): string
    {
        return $this->message;
    }

    public function assignListing(Listing $listing): self
    {
        $this->listing = $listing;
        return $this;
    }
}