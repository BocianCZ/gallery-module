<?php

namespace Modules\Gallery\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class GalleryIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}
