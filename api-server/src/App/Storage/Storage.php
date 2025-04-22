<?php

namespace Moises\AutoCms\App\Storage;

use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

class Storage
{
    public static function createLocal()
    {
        $adapter = new LocalFilesystemAdapter(
            location: DIR . "/storage",
            visibility: PortableVisibilityConverter::fromArray([
                'file' => [
                    'public' => 0640,
                    'private' => 0604,
                ],
                'dir' => [
                    'public' => 0740,
                    'private' => 7604,
                ],
            ]),
            writeFlags: LOCK_EX,
            linkHandling: LocalFilesystemAdapter::DISALLOW_LINKS
        );
        return new Filesystem($adapter);
    }
}