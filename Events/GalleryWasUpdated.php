<?php

namespace Modules\Gallery\Events;

use Modules\Media\Contracts\StoringMedia;

class GalleryWasUpdated extends StoringMediaEvent implements StoringMedia
{
}
