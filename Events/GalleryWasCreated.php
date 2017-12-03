<?php

namespace Modules\Gallery\Events;

use Modules\Media\Contracts\StoringMedia;

class GalleryWasCreated extends StoringMediaEvent implements StoringMedia
{
}
