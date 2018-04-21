<?php

namespace App\Jobs\Upload;

use App\Jobs\Job;

class Image extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle()
    {
        if (isset($this->attributes['image'])) {
            return $this->setImage($this->attributes['image'],'summernote');
        }
    }
}
