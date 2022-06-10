<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserVerification extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('doc')
            ->singleFile();

        $this->addMediaCollection('user_photo')
            ->singleFile();
    }
}
