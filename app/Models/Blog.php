<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['blog_category_id','name','heading','url','author','short_description','long_description','seo_title','seo_keywords','seo_description', 'is_active', 'popular'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

}
