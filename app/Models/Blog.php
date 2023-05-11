<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory , SoftDeletes ;

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'image',
        'description',
        'slug',
        'short_description'
    ];


    public function user()
    {
        return $this->hasOne(User::class , 'id','user_id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'blog_categories');
    }

    public function incrementViews() {
        $this->views++;
        return $this->save();
    }


    public function totalViews()
    {
        return $this->sum('views');
    }

}
