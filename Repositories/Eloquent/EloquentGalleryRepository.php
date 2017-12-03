<?php

namespace Modules\Gallery\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Gallery\Events\GalleryIsCreating;
use Modules\Gallery\Events\GalleryIsUpdating;
use Modules\Gallery\Events\GalleryWasCreated;
use Modules\Gallery\Events\GalleryWasUpdated;
use Modules\Gallery\Repositories\GalleryRepository;

class EloquentGalleryRepository extends EloquentBaseRepository implements GalleryRepository
{
    public function create($data)
    {
        event($event = new GalleryIsCreating($data));
        $gallery = $this->model->create($event->getAttributes());

        event(new GalleryWasCreated($gallery, $data));

        return $gallery;
    }

    public function update($gallery, $data)
    {
        event($event = new GalleryIsUpdating($gallery, $data));
        $gallery->update($event->getAttributes());

        event(new GalleryWasUpdated($gallery, $data));

        return $gallery;
    }
}
