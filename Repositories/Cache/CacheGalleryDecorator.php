<?php

namespace Modules\Gallery\Repositories\Cache;

use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Modules\Gallery\Repositories\GalleryRepository;

class CacheGalleryDecorator extends BaseCacheDecorator implements GalleryRepository
{
    public function __construct(GalleryRepository $galleryRepository)
    {
        parent::__construct();
        $this->entityName = 'gallery.galleries';
        $this->repository = $galleryRepository;
    }
}
