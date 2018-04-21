<?php

namespace App\Jobs\Product;

use App\Jobs\Job;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Database\Eloquent\Model;

class Update extends Job
{
    protected $attributes;

    protected $entity;

    protected $dataSync = [];

    public function __construct(Model $entity, array $attributes)
    {
        $this->attributes = $attributes;
        $this->entity = $entity;
    }

    public function handle(ProductRepository $repository)
    {
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            if (!empty($this->entity->image)) {
                $this->destroyImage($this->entity->image);
            }
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        $this->attributes['user_id'] = \Auth::user()->id;
        $repository->update($this->entity, $this->attributes);
        if (isset($this->attributes['cate_id'])) {
            $this->entity->categories()->sync($this->attributes['cate_id']);
        }
        if (isset($this->attributes['color_id'])) {
            foreach ($this->attributes['color_id'] as $value) {
                $this->dataSync[$value] = [
                    'price' => !empty($this->attributes['color_price'][$value]) ? $this->attributes['color_price'][$value] : 0,
                    ];
            }
            $this->entity->colors()->sync($this->dataSync);
        }
        if (isset($this->attributes['property_id'])) {
            foreach ($this->attributes['property_id'] as $property) {
                $this->dataSync[$property] = [
                    'price' => !empty($this->attributes['property_price'][$property]) ? $this->attributes['property_price'][$property] : 0,
                    ];
            }
            $this->entity->others()->sync($this->dataSync);
        }
        if (isset($this->attributes['images'])) {
            $images = app(\App\Eloquent\ProductImage::class)->whereIn('id',$this->attributes['images'])->get();
            $this->entity->galleryImages()->whereNotIn('id', $this->attributes['images'])->delete();
            $this->entity->galleryImages()->saveMany($images);
        }
        if (isset($this->attributes['albumRotate'])) {
            $images = app(\App\Eloquent\ProductImage::class)->whereIn('id',$this->attributes['albumRotate'])->get();
            $this->entity->rotateImages()->whereNotIn('id', $this->attributes['albumRotate'])->delete();
            $this->entity->rotateImages()->saveMany($images);
        }
    }
}
