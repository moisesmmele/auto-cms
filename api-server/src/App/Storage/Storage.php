<?php

namespace Moises\AutoCms\App\Storage;

use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

class Storage
{
    public static function createLocal()
    {
        // Fix the path - ensure no double slashes
        $storagePath = rtrim(DIR, '/') . "/storage";

        // Ensure directory exists with proper permissions
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0775, true);
            // Set ownership to www-data if running as root during setup
            if (function_exists('posix_getuid') && posix_getuid() === 0) {
                chown($storagePath, 'www-data');
                chgrp($storagePath, 'www-data');
            }
        }

        $adapter = new LocalFilesystemAdapter(
            location: $storagePath,
            visibility: PortableVisibilityConverter::fromArray([
                'file' => [
                    'public' => 0644,   // Standard readable file permissions
                    'private' => 0600,  // Owner read/write only
                ],
                'dir' => [
                    'public' => 0755,   // Standard directory permissions
                    'private' => 0700,  // FIXED: was 7604 (invalid octal)
                ],
            ]),
            writeFlags: LOCK_EX,
            linkHandling: LocalFilesystemAdapter::DISALLOW_LINKS
        );
        return new Filesystem($adapter);
    }
}