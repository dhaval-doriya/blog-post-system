<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * [blogs GET All the Blogs Homepage]
     * @return [View] [Returns Blogs]
     */
    public function blogs()
    {
        $RecentBlog = Blog::latest()->where('status', 1)->take(3)->get();
        $categories = Category::where('status', 1)->get();
        $blogs = Blog::where('status', 1)->Paginate(8);
        $popular = popularCategories($categories);

        $response = ['blogs' => $blogs, 'recentblogs' => $RecentBlog, 'categories' => $categories, 'popularcat' => $popular];
        return view('frontend.blogs', $response);
    }

    /**
     * [blog GET One  Blog By Slug]
     * @return [Object] [Returns OneBlog]
     */
    public function blog(Request $request, $slug)
    {
        $RecentBlog = Blog::latest()->where('status', 1)->take(3)->get();
        $categories = Category::where('status', 1)->get();
        $blog = Blog::where('slug', $slug)->firstorfail();
        $popular = popularCategories($categories);
        blogViewed($request, $blog);

        $response = ['blog' => $blog, 'recentblogs' => $RecentBlog, 'categories' => $categories, 'popularcat' => $popular];
        return view('frontend.oneblog',  $response);
    }


    /**
     * [category GET    All Blog By Category]
     * @return [Array] [Returns All Blogs By Categories]
     */
    public function category($slug)
    {
        $cat = Category::where('slug', $slug)->firstorfail();
        $RecentBlog = Blog::latest()->where('status', 1)->take(3)->get();
        $categories = Category::where('status', 1)->get();
        $popular = popularCategories($categories);
        $massage = "Category : $cat->name ";

        $response = ['blogs' => $cat->blog, 'recentblogs' => $RecentBlog, 'categories' => $categories, 'popularcat' => $popular, 'massage' => $massage];
        return view('frontend.searchblog',  $response);
    }



    /**
     * [Search POST  All Blog By Search query]
     * @return [Array] [Returns All Blogs By Search]
     */
    public function Search(Request $request)
    {

        if ($request->search) {
            $blogs = Blog::where('name', 'like', '%' . $request->search . '%')->where('status', 1)->Paginate(8);
        } else {
            $blogs = [];
        }
        $RecentBlog = Blog::latest()->where('status', 1)->take(3)->get();
        $categories = Category::where('status', 1)->get();
        $popular = popularCategories($categories);
        $massage = "Result for $request->search ";

        $response = ['blogs' => $blogs, 'recentblogs' => $RecentBlog, 'categories' => $categories, 'popularcat' => $popular, 'massage' => $massage];

        return view('frontend.searchblog', $response);
    }



    /**
     * [profile GET All Blog By USER]
     * @return [Array] [Returns All Blogs By USER]
     */

    public function blogsByUser($id)
    {
        $user = User::where('id', $id)->firstorfail();
        $RecentBlog = Blog::latest()->where('status', 1)->take(3)->get();
        $categories = Category::where('status', 1)->get();
        $massage = "All the Blogs by $user->name ";

        $response =  ['blogs' => $user->blogs,  'recentblogs' => $RecentBlog, 'categories' => $categories,  'massage' => $massage];
        return view('frontend.searchblog', $response);
    }
}
