<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'image',
        'body',
    ];

    public function getImageAttribute($image){
        if ($image) {
            return asset('/assets/images/' . $image);
        } else {
            return asset('/assets/images/empty.jpg');
        }
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
