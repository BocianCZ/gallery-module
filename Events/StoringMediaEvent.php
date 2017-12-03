<?php

namespace Modules\Gallery\Events;

use Modules\Media\Contracts\StoringMedia;

class StoringMediaEvent implements StoringMedia
{
    /**
     * @var array
     */
    private $data;

    private $entity;

    public function __construct($entity, array $data)
    {
        $this->data = $data;
        $this->entity = $entity;
    }

    public function getSubmissionData()
    {
        return $this->data;
    }

    public function getEntity()
    {
        return $this->entity;
    }
}
