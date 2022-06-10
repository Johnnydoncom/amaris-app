<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Platform extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('featured_image')
            ->useFallbackUrl(Storage::url('itunes.webp'))
            ->useFallbackPath(Storage::url('itunes.webp'))
            ->singleFile();
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
