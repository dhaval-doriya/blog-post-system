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
    public function blogs(Request $request)
    {
        $blogs = Blog::where('status', 1)->Paginate(3);
        $response = homepageData();

        $query  = $request->get('search');

        if ($query) {
            $response['blogs'] = Blog::where('status', '1')->Where('name', 'like', '%' . $query . '%')->get();
            return view('frontend.searchblog', $response);
        }
        if ($request->ajax()) {
            return  view('frontend.layout.blogList', compact('blogs'))->render();
        }

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
    public function category(Request $request, $slug)
    {
        $cat = Category::where('slug', $slug)->firstorfail();
        $message = "Category : $cat->name ";

        $response = homepageData();
        $response['blogs'] = $cat->blog()->Paginate(3);
        $response['message'] = $message;

        if ($request->ajax()) {
            $blogs = $response['blogs'];
            return  view('frontend.layout.blogList', compact('blogs'))->render();
        }

        return view('frontend.searchblog',  $response);
    }


    /**
     * [profile GET All Blog By USER]
     * @return [Array] [Returns All Blogs By USER]
     */

    public function blogsByUser(Request $request, $id)
    {
        $user = User::where('id', $id)->firstorfail();
        $response = homepageData();
        $response['blogs'] = $user->blogs()->Paginate(3);
        $response['message'] = "All the Blogs by $user->name ";

        if ($request->ajax()) {
            $blogs = $response['blogs'];
            return  view('frontend.layout.blogList', compact('blogs'))->render();
        }

        return view('frontend.searchblog', $response);
    }
}
