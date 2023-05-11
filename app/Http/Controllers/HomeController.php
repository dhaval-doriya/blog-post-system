<?php

namespace App\Http\Controllers;

use App\Models\Blog;
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
        $blogs = Blog::where('status', 1)->Paginate(8);
        $response = homepageData();
        $response['blogs'] = $blogs;
        return view('frontend.blogs', $response);
    }

    /**
     * [blog GET One  Blog By Slug]
     * @return [Object] [Returns OneBlog]
     */
    public function blog(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstorfail();
        blogViewed($request, $blog);
        $response = homepageData();
        $response['blog'] = $blog;
        return view('frontend.oneblog',  $response);
    }


    /**
     * [category GET    All Blog By Category]
     * @return [Array] [Returns All Blogs By Categories]
     */
    public function category($slug)
    {
        $cat = Category::where('slug', $slug)->firstorfail();
        $message = "Category : $cat->name ";

        $response = homepageData();
        $response['blogs'] = $cat->blog;
        $response['message'] = $message;

        return view('frontend.searchblog',  $response);
    }



    /**
     * [Search POST  All Blog By Search query]
     * @return [Array] [Returns All Blogs By Search]
     */
    public function Search(Request $request)
    {
        $blogs = [];
        if ($request->search) {
            $blogs = Blog::where('name', 'like', '%' . $request->search . '%')->where('status', 1)->Paginate(8);
        }

        $message = "Result for $request->search ";
        $response = homepageData();
        $response['blogs'] = $blogs;
        $response['message'] = $message;

        return view('frontend.searchblog', $response);
    }



    /**
     * [profile GET All Blog By USER]
     * @return [Array] [Returns All Blogs By USER]
     */

    public function blogsByUser($id)
    {
        $user = User::where('id', $id)->firstorfail();
        $response = homepageData();
        $response['blogs'] = $user->blogs;
        $response['message'] = "All the Blogs by $user->name ";

        return view('frontend.searchblog', $response);
    }
}
