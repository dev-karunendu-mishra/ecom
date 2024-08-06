<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'sub_title', 'shop_link','image'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
