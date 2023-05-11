<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * [index GET Dashboard]
     * @return [View] [Returns Dashboard]
     */
    public function index(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $blogs = Blog::where('status', 0)->paginate(3);
            $statistics = getStatistics();

            if ($request->ajax()) {
                $blogs = getBlogs($request);
                return view('backend.layout.admintable', compact('blogs'));
            }

            return view('backend.admin', ['blogs' => $blogs, 'statistics' => $statistics]);
        }

        //For User
        $blogs = Blog::where('user_id', auth()->user()->id);
        $statistics['totalblogs'] = count($blogs->get());
        $statistics['views'] = $blogs->sum('views');

        if ($request->ajax()) {
            $blogs = getBlogs($request);
            return view('backend.blog.table', compact('blogs'));
        }

        $blogs = $blogs->where('status', 0)->paginate(3);
        return view('backend.user', ['blogs' => $blogs, 'statistics' => $statistics]);
    }
}
