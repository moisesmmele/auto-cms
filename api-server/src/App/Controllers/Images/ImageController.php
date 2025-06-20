<?php

namespace Moises\AutoCms\App\Controllers\Images;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Repositories\Pdo\Image\PdoImageRepository;
use Moises\AutoCms\App\Services\Image\ImageService;
use Moises\AutoCms\Core\Repositories\ImageRepository;

class ImageController extends Controller
{
    protected ImageService $imageService;
    protected ImageRepository $imageRepository;
    public function __construct()
    {
        parent::__construct();
        $this->imageService = App::container()->get(ImageService::class);
        $this->imageRepository = App::container()->get(ImageRepository::class);
    }

    public function index($category)
    {
        $images = $this->imageService->getByCategory($category);
        $newImages = [];
        foreach ($images as $index => $image) {
            $newImages[$index]["id"] = $image->getId();
            $newImages[$index]["name"] = $image->getName();
            $newImages[$index]["extension"] = $image->getExtension();
            $newImages[$index]["height"] = $image->getHeight();
            $newImages[$index]["width"] = $image->getWidth();
            $newImages[$index]["category"] = $image->getCategory();
            $newImages[$index]["url"] = "/images/".$image->getName().".".$image->getExtension();
        }

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
        $data = json_decode($this->request->getContent(), true);
        $this->imageService->upload($data);
        http_response_code(200);
    }

    public function destroy($id)
    {
        $this->imageService->delete($id);
    }

    public function createTest()
    {
        error_log("=== START createTest ===");
        error_log("Memory limit: " . ini_get('memory_limit'));
        error_log("Max execution time: " . ini_get('max_execution_time'));
        error_log("Current memory usage: " . memory_get_usage(true) . " bytes");

        try {
            $filesArray = $this->request->files;
            error_log("Files in inputBag: " . count($filesArray));
            error_log("Memory after getting files: " . memory_get_usage(true) . " bytes");

            $imageIds = [];

            foreach ($filesArray as $index => $item) {
                error_log("=== Processing file #$index ===");
                error_log("Memory at start of loop: " . memory_get_usage(true) . " bytes");

                // Get file path
                error_log("Getting file path...");
                $filepath = $item->getRealPath();
                error_log("File path: " . $filepath);
                error_log("File exists: " . (file_exists($filepath) ? 'YES' : 'NO'));

                if (file_exists($filepath)) {
                    error_log("File size on disk: " . filesize($filepath) . " bytes");
                }

                // Generate name and extension
                error_log("Generating unique name...");
                $name = uniqid();
                error_log("Generated name: " . $name);

                error_log("Guessing extension...");
                $extension = $item->guessExtension();
                error_log("Extension: " . $extension);
                error_log("Full filename will be: " . $name.'.'.$extension);

                // Read file contents
                error_log("About to read file contents from: " . $filepath);
                error_log("Memory before file_get_contents: " . memory_get_usage(true) . " bytes");

                $file = file_get_contents($filepath);

                if ($file === false) {
                    error_log("ERROR: file_get_contents returned false!");
                    continue;
                }

                error_log("File contents read successfully");
                error_log("File content size: " . strlen($file) . " bytes");
                error_log("Memory after file_get_contents: " . memory_get_usage(true) . " bytes");

                // INLINE UPLOAD LOGIC (replacing service call)
                error_log("=== Starting inline upload logic ===");

                // Prepare data array
                error_log("Preparing data array...");
                $data = [
                    'name' => $name,
                    'extension' => $extension,
                    'category' => 'NULL',
                    'width' => 0,
                    'height' => 0,
                ];
                error_log("Data array prepared: " . json_encode($data));
                error_log("Memory after data prep: " . memory_get_usage(true) . " bytes");

                // Create repository record
                error_log("About to call repository->create...");
                error_log("Repository object exists: " . (isset($this->repository) ? 'YES' : 'NO'));

                if (isset($this->repository)) {
                    error_log("Repository class: " . get_class($this->repository));
                }

                error_log("Memory before repository->create: " . memory_get_usage(true) . " bytes");

                $image = $this->repository->create($data);

                error_log("Repository->create completed");
                error_log("Image object created: " . (is_object($image) ? 'YES' : 'NO'));

                if (is_object($image)) {
                    error_log("Image class: " . get_class($image));
                    error_log("Image ID: " . $image->getId());
                }

                error_log("Memory after repository->create: " . memory_get_usage(true) . " bytes");

                // Write to storage
                error_log("About to write to storage...");
                error_log("Storage filename: " . $name.'.'.$extension);
                error_log("File size to write: " . strlen($file) . " bytes");
                error_log("App::storage() exists: " . (class_exists('App') ? 'YES' : 'NO'));

                error_log("Memory before storage write: " . memory_get_usage(true) . " bytes");

                try {
                    $writeResult = App::storage()->write($name.'.'.$extension, $file);
                    error_log("Storage write completed");
                    error_log("Write result: " . var_export($writeResult, true));
                } catch (\Exception $storageException) {
                    error_log("STORAGE EXCEPTION: " . $storageException->getMessage());
                    error_log("Storage exception trace: " . $storageException->getTraceAsString());
                    throw $storageException;
                }

                error_log("Memory after storage write: " . memory_get_usage(true) . " bytes");

                // Add to results array
                error_log("Adding image to results array...");
                $imageIds[] = [
                    'id' => $image->getId(),
                ];
                error_log("Added image ID: " . $image->getId());
                error_log("Total images processed so far: " . count($imageIds));
                error_log("Memory after adding to array: " . memory_get_usage(true) . " bytes");

                error_log("=== File #$index processing completed ===");
            }

            error_log("=== All files processed ===");
            error_log("Total images: " . count($imageIds));
            error_log("Memory before JSON encoding: " . memory_get_usage(true) . " bytes");

            // Encode JSON response
            error_log("About to encode JSON...");
            $jsonResponse = json_encode($imageIds);

            if ($jsonResponse === false) {
                error_log("ERROR: json_encode failed!");
                error_log("JSON last error: " . json_last_error_msg());
                $jsonResponse = json_encode(['error' => 'JSON encoding failed']);
            }

            error_log("JSON encoded successfully");
            error_log("JSON length: " . strlen($jsonResponse) . " characters");
            error_log("JSON content: " . $jsonResponse);
            error_log("Memory after JSON encoding: " . memory_get_usage(true) . " bytes");

            // Output JSON
            error_log("About to echo JSON response...");
            echo $jsonResponse;
            error_log("JSON response echoed successfully");

            error_log("Memory at end: " . memory_get_usage(true) . " bytes");
            error_log("=== END createTest SUCCESS ===");

        } catch (Exception $e) {
            error_log("=== EXCEPTION CAUGHT ===");
            error_log("Exception message: " . $e->getMessage());
            error_log("Exception file: " . $e->getFile() . " line " . $e->getLine());
            error_log("Exception trace: " . $e->getTraceAsString());
            error_log("Memory when exception occurred: " . memory_get_usage(true) . " bytes");

            // Send error response
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
            error_log("Error response sent");
            error_log("=== END createTest ERROR ===");
        } catch (Error $e) {
            error_log("=== FATAL ERROR CAUGHT ===");
            error_log("Error message: " . $e->getMessage());
            error_log("Error file: " . $e->getFile() . " line " . $e->getLine());
            error_log("Error trace: " . $e->getTraceAsString());
            error_log("Memory when error occurred: " . memory_get_usage(true) . " bytes");

            // Send error response
            http_response_code(500);
            echo json_encode(['error' => 'Fatal error: ' . $e->getMessage()]);
            error_log("Fatal error response sent");
            error_log("=== END createTest FATAL ===");
        }
    }
}