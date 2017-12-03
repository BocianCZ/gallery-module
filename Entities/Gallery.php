<?php

namespace Modules\Gallery\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Gallery extends Model
{
    use MediaRelation;

    protected $table = 'gallery__galleries';

    protected $fillable = [
        'name',
        'system_name',
        'description',
    ];
}
