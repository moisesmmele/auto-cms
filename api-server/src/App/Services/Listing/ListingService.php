<?php

namespace Moises\AutoCms\App\Services\Listing;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Services\Vehicle\VehicleService;
use Moises\AutoCms\Core\Repositories\Listing\ListingRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleRepository;

class ListingService
{
    protected ListingRepository $listingRepository;
    protected VehicleService $vehicleService;

    public function __construct()
    {
        $this->listingRepository = App::container()->get(ListingRepository::class);
        $this->vehicleService = App::container()->get(VehicleService::class);
    }
    public function getAllListings()
    {
        $newListings = [];
        $listings = $this->listingRepository->all();

        foreach ($listings as $listing) {
            $vehicle = $this->vehicleService->getVehicle($listing->getVehicleId());
            $listing->assignVehicle($vehicle);
            $newListings[] = $listing;
        }
        return $newListings;
    }
    public function getListing($id)
    {
        $listing = $this->listingRepository->find($id);
        $vehicle = $this->vehicleService->getVehicle($listing->getVehicleId());
        $listing->assignVehicle($vehicle);
        return $listing;
    }

    public function createListing($data)
    {
        $listing = $this->listingRepository->create($data);
        $vehicle = $this->vehicleService->getVehicle($listing->getVehicleId());
        $listing->assignVehicle($vehicle);
        return $listing;
    }
    public function updateListing($id, $data)
    {
        $listing = $this->listingRepository->update($id, $data);
        $vehicle = $this->vehicleService->getVehicle($listing->getVehicleId());
        $listing->assignVehicle($vehicle);
        return $listing;
    }

    public function deleteListing($id)
    {
        return $this->listingRepository->delete($id);
    }
}