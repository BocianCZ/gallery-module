<?php

namespace Modules\Gallery\Events;

use Modules\Gallery\Entities\Gallery;

class GalleryWasUpdated
{
    /**
     * @var Gallery
     */
    public $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }
}
