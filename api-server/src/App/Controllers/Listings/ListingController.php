<?php

namespace Moises\AutoCms\App\Controllers\Listings;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Dtos\ListingResponseDto;
use Moises\AutoCms\App\Dtos\VehicleResponseDto;
use Moises\AutoCms\App\Services\Listing\ListingService;

class ListingController extends Controller
{
    private ListingService $service;
    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(ListingService::class);
    }

    public function index()
    {
        $listings = $this->service->getAllListings();
        $response = [
            'listings' => []
        ];
        foreach ($listings as $listing) {
            $response['listings'][] = ListingResponseDto::fromEntity($listing);
        }


        http_response_code(200);
        header('Content-type: application/json');
        echo json_encode($response);
    }
    public function show($id)
    {
        $listing = $this->service->getListing($id);
        http_response_code(200);
        header('Content-type: application/json');
        echo json_encode(ListingResponseDto::fromEntity($listing));
    }
    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $listing = $this->service->createListing($data);
        http_response_code(200);
        header('Content-type: application/json');
        echo json_encode(ListingResponseDto::fromEntity($listing));

    }
    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $listing = $this->service->updateListing($id, $data);
        http_response_code(200);
        header('Content-type: application/json');
        echo json_encode(ListingResponseDto::fromEntity($listing));
    }
    public function destroy($id)
    {
        $result = $this->service->deleteListing($id);
        return json_encode($result);
    }
}