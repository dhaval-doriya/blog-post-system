<?php

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;

class Helpers
{

    // For Save Image
    public static function saveOneImage($path, $saveImg)
    {
        if ($saveImg) {
            $myImage = time() . '.' . $saveImg->extension();
            $saveImg->move(public_path($path), $myImage);
            return  $myImage;
        }
    }
    // For Delete Image
    public static function deleteOneImage($path, $deleteImg)
    {
        if ($deleteImg) {
            if (file_exists(public_path("$path/$deleteImg"))) {
                unlink(public_path("$path/$deleteImg"));
            }
        }
    }


    // Get Statistics for dashboard
    public static function getStatistics()
    {

        if (auth()->user()->role === 'admin') {
            $statistics['totalPendingBlogs'] = Blog::where('status', '0')->count();
            $statistics['totalBlogs'] = Blog::count();
            $statistics['totalUsers'] = User::where('role', 'user')->count();
            $statistics['totalCategories'] = Category::count();
        }else{


        }

        return $statistics;
    }

    //For Homepage //returns a recent blog  categories  and popular categories
    public static function homepageData()
    {
        $recentBlogs = Blog::latest()->where('status', 1)->take(3)->get();

        $categories = Category::where('status', 1)->get();

        $popular = [];

        for ($i = 0; $i < count($categories); $i++) {
            $popular[$i]['name'] = $categories[$i]->name;
            $popular[$i]['slug'] = $categories[$i]->slug;
            $popular[$i]['total'] = count($categories[$i]->blog);
        }

        usort($popular, function ($a, $b) {
            return strcmp($b['total'], $a['total']);
        });

        $popular = array_slice($popular, 0, 5);

        return  ['recentBlogs' => $recentBlogs, 'categories' => $categories, 'popularCategories' => $popular];
    }
}
