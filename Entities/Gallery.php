<?php

namespace Modules\Gallery\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;

/**
 * Class Gallery
 * @property string $snippet
 * @property string $name
 * @property string $system_name
 * @property File[] $files
 */
class Gallery extends Model
{
    use MediaRelation;

    protected $table = 'gallery__galleries';

    protected $fillable = [
        'name',
        'system_name',
        'description',
    ];

    public function getSnippetAttribute()
    {
        return sprintf('[[GALLERY(%s)]]', $this->system_name);
    }
}
