<?php

namespace Moises\AutoCms\App\Services\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\Vehicle\VehicleImage;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleImageRepository;

class VehicleImageService
{
    private VehicleImageRepository $repository;

    public function __construct()
    {
        $this->repository = App::container()->get(VehicleImageRepository::class);
    }

    /**
     * Mock image upload
     */
    public function upload(array $data): VehicleImage
    {
        // For now, we pretend we're uploading
        $vehicleId = $data['vehicle_id'] ?? null;
        $originalFilename = $data['filename'] ?? 'image.jpg';

        $mockPath = '/storage/mock/' . uniqid('vehicle_', true) . '_' . $originalFilename;

        // Store in DB like it's real
        $imageData = [
            'vehicle_id' => $vehicleId,
            'path' => $mockPath,
            'original_filename' => $originalFilename,
            'uploaded_at' => date('Y-m-d H:i:s'),
        ];

        return $this->repository->create($imageData);
    }

    public function getAllImages(): array
    {
        return $this->repository->all();
    }

    public function getImage(int $imageId): VehicleImage
    {
        return $this->repository->find($imageId);
    }

    public function deleteImage(int $imageId): bool
    {
        return $this->repository->delete($imageId);
    }
}
