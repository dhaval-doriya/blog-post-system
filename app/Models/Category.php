<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'id',
        'name',
        'slug',
    ];

    protected $primaryKey = 'id';

    public function blog()
    {
        return $this->belongsToMany(Blog::class, 'blog_categories')->where('status', 1);
    }



}
