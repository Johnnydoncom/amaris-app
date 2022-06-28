<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;

    protected $fillable = [
        'title',
        'subheading',
        'country_id',
        'slug',
        'description',
        'user_id',
        'regular_price',
        'sales_price',
        'stock_quantity',
        'featured',
        'product_attributes',
        'product_type',
        'features',
        'platform_id',
        'category_id',
        'product_type',
        'status'
    ];

    protected $casts = [
        'product_attributes' => 'array',
        'redemption_information' => 'array',
        'featured' => 'array',
        'redemption_country_ids' => 'array'
    ];

//    protected $with = ['variations'];

    public static function boot()
    {
        parent::boot();
        self::observe(new ProductObserver());
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(400)
                    ->height(400)
                    ->sharpen(10)
                    ->format('webp')
                    ->fit(Manipulations::FIT_CROP, 400,400)
                    ->nonQueued();
            });

        $this
            ->addMediaCollection('gallery')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(400)
                    ->height(400)
                    ->sharpen(10)
                    ->format('webp')
                    ->fit(Manipulations::FIT_CROP, 400,400);
            });
    }

    public function getRedemptionInformationAttribute($value){
        return json_decode($value);
    }

    public function getRedemptionCountriesAttribute($value){
        return Country::whereIn('id', [$this->redemption_country_ids])->get(['name','id']);
//        return json_decode($value);
    }

    public function getFeaturedImgUrlAttribute(){
        return $this->getFirstMediaUrl('featured_image');
    }

    public function getFeaturedImgThumbAttribute(){
        return $this->getFirstMediaUrl('featured_image', 'thumb');
    }

    public function getGalleryImagesAttribute(){
        return $this->getMedia('gallery');
    }

    public function getPriceAttribute(){
        return $this->sales_price > 0 ? $this->sales_price : $this->regular_price;
    }

    public function variations(){
        return $this->hasMany(Variation::class);
    }

    /**
     * Get the auctioneer that owns the item.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the platform that owns the item.
     */
    public function platform() {
        return $this->belongsTo(Platform::class);
    }

    /**
     * Get the category that owns the item.
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the platform that owns the item.
     */
    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    /**
     * Get the auctioneer that owns the item.
     */
    public function locations() {
        return $this->hasMany(ProductLocation::class);
    }

    public function getExcerptAttribute(){
        return Str::limit(strip_tags($this->description), 200, '...');
    }

    /**
     * Get the reviews of the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeDefault($query)
    {
        return $query->where('product_type', 'default');
    }

    public function scopeGiftCard($query)
    {
        return $query->where('product_type', 'gift_card');
    }
}
