<?php

namespace App\Jobs\Product;

use App\Jobs\Job;
use App\Repositories\Contracts\ProductRepository;

class Store extends Job
{
    protected $attributes;

    protected $dataSync = [];

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(ProductRepository $repository)
    {
        $this->attributes['user_id'] = \Auth::user()->id;
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        $item = $repository->create($this->attributes);
        if (isset($this->attributes['cate_id'])) {
            $item->categories()->sync($this->attributes['cate_id']);
        }
        if (isset($this->attributes['color_id'])) {
            foreach ($this->attributes['color_id'] as $value) {
                $this->dataSync[$value] = [
                    'price' => !empty($this->attributes['color_price'][$value]) ? $this->attributes['color_price'][$value] : 0,
                    ];
            }
            $item->properties()->sync($this->dataSync);
        }
        if (isset($this->attributes['property_id'])) {
            foreach ($this->attributes['property_id'] as $property) {
                $this->dataSync[$property] = [
                    'price' => !empty($this->attributes['property_price'][$property]) ? $this->attributes['property_price'][$property] : 0,
                    ];
            }
            $item->properties()->sync($this->dataSync);
        }
        if (isset($this->attributes['images'])) {
            $images = app(\App\Eloquent\ProductImage::class)->whereIn('id',$this->attributes['images'])->get();
            $item->images()->saveMany($images);
        }

        if (isset($this->attributes['albumRotate'])) {
            $images = app(\App\Eloquent\ProductImage::class)->whereIn('id',$this->attributes['albumRotate'])->get();
            $item->images()->saveMany($images);
        }
    }
}
