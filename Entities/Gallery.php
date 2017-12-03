<?php

namespace Modules\Gallery\Entities;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery__galleries';

    protected $fillable = [
        'name',
        'system_name',
        'description',
    ];
}
