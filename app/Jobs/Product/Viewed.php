<?php

namespace App\Jobs\Product;

use App\Jobs\Job;
use Illuminate\Database\Eloquent\Model;

class Viewed extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle()
    {
        $data = [
            'id' => $this->entity->id,
            'name' => $this->entity->name,
            'slug' => $this->entity->slug,
            'image' => $this->entity->image
        ];
        $viewed = (\Cookie::get('itemViewed')) ? \Cookie::get('itemViewed') : [];
        if ($this->checkExistValue($viewed, $data['id'])) {
            return null;
        } else {
            array_push($viewed, $data);
            $viewed = $this->getArray($viewed);
            $cookie = cookie()->forever('itemViewed', $viewed);
            return $cookie;
        }
    }

    public function checkExistValue($array, $value)
    {
        foreach ($array as $key) {
            if (isset($key['id']) && $key['id'] == $value) {
                return true;
            }
        }
        return false;
    }

    public function getArray($array)
    {
        if (count($array) > 8) {
            array_shift($array);
        }
        return $array;
    }

}
