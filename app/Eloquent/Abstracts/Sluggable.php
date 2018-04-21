<?php

namespace App\Eloquent\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

abstract class Sluggable extends Model implements SluggableInterface
{
    use SluggableTrait;
}
