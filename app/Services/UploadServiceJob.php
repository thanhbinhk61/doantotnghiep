<?php

namespace App\Services;

use App\Services\Contracts\UploadService;
use App\Jobs\Upload\Image;

class UploadServiceJob extends AbstractServiceJob implements UploadService
{
	public function image(array $attributes)
	{
		return $this->dispatch(new Image($attributes));
	}
}
