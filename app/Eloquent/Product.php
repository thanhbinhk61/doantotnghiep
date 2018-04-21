<?php

namespace App\Eloquent;

class Product extends Abstracts\Sluggable
{
    protected $fillable = [
    	'code','name','slug','image','intro','content','tags','title','keywords','description',
    	'price','sale','price_sale','video','user_id','status','section','quantity',
    	'brand_id','provider_id','discount_price','discount_type'
    	];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    public function categories()
	{
		return $this->belongsToMany(Category::class);
	}

	public function categoryRoot()
	{
		return $this->categories()->where('parent_id','0')->take(1);
	}

	public function categoryChildren()
	{
		return $this->categories()->where('parent_id','>','0')->take(1);
	}
	
	public function images()
	{
		return $this->hasMany(ProductImage::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class)->orderBy('id','DESC');
	}

	public function getRating()
	{
		return $this->comments()->select(\DB::raw('Floor(SUM(vote) / COUNT(vote)) as rating'))->take(1);
	}

	public function commentActive()
	{
		return $this->comments()->where('status',1);
	}

	public function galleryImages()
	{
		return $this->images()->where('type','1')->orderBy('name');
	}

	public function rotateImages()
	{
		return $this->images()->where('type','2')->orderBy('name','DESC');
	}

	public function user()
	{
		return $this->belongsTo(user::class);
	}

	public function brand()
	{
		return $this->belongsTo(Property::class,'brand_id');
	}

	public function provider()
	{
		return $this->belongsTo(Provider::class);
	}

	public function properties()
	{
		return $this->belongsToMany(Property::class)->withPivot('price');
	}

	public function colors()
	{
		return $this->properties()->where('type','color');
	}

	public function others()
	{
		return $this->properties()->where('type','other');
	}

	public function groupProperty()
	{
		return $this->others()->groupBy('category_id')->with('category');
	}

	public function orders()
	{
		return $this->belongsToMany(Order::class)->withPivot('quantity','color','other','price','provider_id','discount');
	}

	public function orderStatistic($startday, $endday, $group)
	{
		if ($group == 'date') {
			$startday = date('Y-m-d',strtotime($startday));
			$endday = date('Y-m-d',strtotime($endday));
			return $this->orders()->where('orders.status',88)
				->where(\DB::raw('DATE(orders.updated_at)'),'>=', $startday)
				->where(\DB::raw('DATE(orders.updated_at)'),'<=', $endday);
		}

		if ($group == 'month') {
			$startday = date('Y-m',strtotime($startday));
			$endday = date('Y-m',strtotime($endday));
			return $this->orders()->where('orders.status',88)
				->where(\DB::raw('DATE_FORMAT(orders.updated_at, "%Y-%m")'),'>=', $startday)
				->where(\DB::raw('DATE_FORMAT(orders.updated_at, "%Y-%m")'),'<=', $endday);
		}

		if ($group == 'year') {
			$startday = date('Y',strtotime($startday));
			$endday = date('Y',strtotime($endday));
			return $this->orders()->where('orders.status',88)
				->where(\DB::raw('DATE_FORMAT(orders.updated_at, "%Y")'),'>=', $startday)
				->where(\DB::raw('DATE_FORMAT(orders.updated_at, "%Y")'),'<=', $endday);
		}
	}
}
