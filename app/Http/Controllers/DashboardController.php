<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use BlogHelpers;
use Helpers;
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
            $blogs = Blog::where('status', 0);
            $statistics = Helpers::getStatistics();
            if ($request->ajax()) {
                $blogs = BlogHelpers::getBlogs($request, $blogs);
                return view('backend.layout.admintable', compact('blogs'));
            }
            return view('backend.admin', ['blogs' => $blogs->paginate(3), 'statistics' => $statistics]);
        }

        //For User
        $blogs = Blog::where('user_id', auth()->user()->id);
        $statistics['totalBlogs'] = $blogs->count();
        $statistics['views'] = $blogs->sum('views');

        $blogs =  $blogs->where('status', 0);
        $statistics['totalPendingBlogs'] = $blogs->count();

        if ($request->ajax()) {
            $blogs = BlogHelpers::getBlogs($request, $blogs);
            return view('backend.blog.table', compact('blogs'));
        }

        return view('backend.user', ['blogs' => $blogs->paginate(3), 'statistics' => $statistics]);
    }
}
