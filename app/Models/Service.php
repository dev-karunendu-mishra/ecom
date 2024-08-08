<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'parent_id', 'url', 'seo_title', 'seo_keywords', 'seo_description', 'is_active'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    /**
     * Get the child categories.
     */
    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    /**
     * Get all categories with their ancestors.
     */
    public function scopeWithAncestors($query)
    {
        return $query->with('parent');
    }
}
