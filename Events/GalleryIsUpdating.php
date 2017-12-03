<?php

namespace Modules\Gallery\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;
use Modules\Gallery\Entities\Gallery;

class GalleryIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Gallery
     */
    private $gallery;

    public function __construct(Gallery $gallery, $attributes)
    {
        $this->gallery = $gallery;
        parent::__construct($attributes);
    }

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
