<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'url', 'is_active'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }

    public function scopeWithAncestors($query)
    {
        return $query->with('parent');
    }
}
