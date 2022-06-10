<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MessageDesigns extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'description', 'message_category_id'];

    protected $appends = ['featured_image','featured_thumbnail_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(300)
                    ->height(300)
                    ->sharpen(10)
                    ->format('webp')
                    ->fit(Manipulations::FIT_CROP, 300,300)
                    ->nonQueued();
            });
    }

    public function getFeaturedThumbnailUrlAttribute(){
        return $this->getFirstMediaUrl('featured_image', 'thumb');
    }

    public function getFeaturedImageAttribute(){
        return $this->getFirstMediaUrl('featured_image');
    }
}
