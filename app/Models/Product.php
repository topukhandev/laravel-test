<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'active',
        'price',
        'images',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function setImagesAttribute($values)
    {
        foreach ($values as $image) {
            $this->addMedia($image)->toMediaCollection('images');
        }
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function getFirstMediaId($img)
    {
        $firstImage = $this->getFirstMedia($img);
        if ($firstImage) {
            $firstImageUuid = $firstImage->id;
        } else {
            $firstImageUuid = null;
        }
        return $firstImageUuid;
    }

    
}
