<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Band extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'origin',
        'genre',
        'bio',
        'website_url',
        'bandcamp_url',
        'spotify_url',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('band-photos')
            ->singleFile();
    }

    public function registerMediaConversions(Media  $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10);
    }

    /**
     * Get the URL of the band's photo.
     */
    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $thumbUrl = $this->getFirstMediaUrl('band-photos', 'thumb');
                if ($thumbUrl) {
                    return $thumbUrl;
                }

                $originalUrl = $this->getFirstMediaUrl('band-photos');
                if ($originalUrl) {
                    return $originalUrl;
                }

                return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
            }
        );
    }
}
