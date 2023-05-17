<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use BlogHelpers as BlogHelper;
use Helpers;

class BlogController extends Controller
{
    /**
     * [index fetch Blogs according the user or admin]
     * @return [Array] [Returns list of Blogs]
     */
    public function index(Request $request)
    {
        try {
            if (auth()->user()->role == 'admin') {
                $blogs = Blog::whereNotNull('status');
            } else {
                $blogs = Blog::where('user_id', auth()->user()->id);
            }

            if ($request->ajax()) {
                $blogs = BlogHelper::getBlogs($request, $blogs);
                return view('backend.blog.table', compact('blogs'));
            }
            return view('backend.blog.index', ['blogs' => $blogs->paginate(3)]);
        } catch (\Throwable $th) {
            return redirect()->route('backend.blog.index')->with('error', ' ');
        }
    }


    /**
     * [create GET createPage of Blog]
     * @return [] [Returns CreatePage of Blog]
     */
    public function create()
    {
        try {
            if (auth()->user()->role !== 'user') {
                return redirect()->route('dashboard')->with('error', "Your Admin Can't Create Blog");
            }
            $categories = Category::where('status', 1);
            if ($categories->count() > 0) {
                return view('backend.blog.create', ['categories' => $categories->get()]);
            }
            return redirect()->route('dashboard')->with('error', "Don't Have any Active Category");
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', ' ');
        }
    }


    /**
     * [store POST  Save Blog]
     * @return [JSON] [Returns Redirect to AllBlogs]
     */
    public function store(StoreBlogRequest $request)
    {
        try {
            $data = $request->all();
            $data['image'] =  Helpers::saveOneImage('blog-cover-images', $request->image); //blog-cover-images
            $data['user_id'] = auth()->user()->id;

            $result = BlogHelper::descriptionCheckImage($data['description']); //this function return array of images and description
            $data['description'] =  $result['description'];
            $blog =  Blog::create($data);
            $blog->category()->attach($request->input('categories'));

            $result = BlogHelper::moveImages($result['ImgNames'], $blog->id);  //Move Images to Blog-post-image folder
            return redirect()->route('blog.index')->with(['message' => 'Blog Created Successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('blog.index')->with('error', 'something went wrong please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect()->route('blog.index'); //Currently Blog Don't Require This Route
    }

    /**
     * [edit GET editPage of Blog]
     * @return [] [Returns EditPage of Blog]
     */
    public function edit($id)
    {
        try {
            $blog = Blog::find($id);
            if (!$blog) {
                return redirect()->route('blog.index')->with('error', "Can't Find Blog");
            }

            //check for authorization of blog
            if (auth()->user()->role !== 'admin' && auth()->user()->id !== $blog->user_id) {
                return redirect()->route('blog.index')->with('error', 'unauthorized.');
            }

            $categories = Category::where('status', 1)->get();
            $selected = [];
            foreach ($blog->category as $value) {
                array_push($selected, $value->id);
            }
            $response = ['blog' => $blog, 'categories' => $categories, 'selected' => $selected];
            return view('backend.blog.update',    $response);
        } catch (\Throwable $th) {
            return redirect()->route('blog.index')->with('error', 'something went wrong please try again');
            // throw $th;
        }
    }

    /**
     * [update PUT  Update Blog]
     * @return [] [Returns Redirect to AllBlogs]
     */
    public function update(UpdateBlogRequest $request,  $id)
    {
        try {
            $blog = Blog::find($id);
            //check blog
            if (!$blog) {
                return redirect()->route('blog.index')->with('error', 'Can`t Find Blog ');
            }

            //check for authorization of blog
            if (auth()->user()->role !== 'admin' && auth()->user()->id !== $blog->user_id) {
                return redirect()->route('blog.index')->with('error', 'unauthorized.');
            }

            $data = $request->all();
            $result = BlogHelper::descriptionCheckImage($data['description']); //this function return array of images and html for description
            $data['slug'] =  Str::slug($data['slug']);
            $data['description'] =  $result['description'];
            $blog->category()->sync($data['categories']);

            $query = BlogImage::where('blog_id', $blog->id);
            $images = $query->pluck('image')->toArray();
            $selected_images = $result['ImgNames'];

            //Add image from db and storage
            $add_image = array_diff($selected_images, $images); //add to db
            BlogHelper::moveImages($add_image, $blog->id);  //Move Images to Blog-post-image folder

            //remove image from db and storage
            $remove_image =  array_diff($images, $selected_images); //remove from db
            BlogHelper::deleteImages($remove_image, $blog->id);  //Move Images to Blog-post-image folder
            $query->whereIn('image', $remove_image)->delete();

            if ($request->image) {
                Helpers::deleteOneImage('blog-cover-images', $blog->image); //blog-cover-images
                $data['image'] =  Helpers::saveOneImage('blog-cover-images', $request->image); //blog-cover-images
            }

            $result =  $blog->update($data);
            return redirect()->route('blog.index')->with('message', 'Blog Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->route('blog.index')->with('error', 'something went wrong please try again');
        }
    }


    /**
     * [destroy DELETE  delete Blog]
     * @return [JSON] [Returns Redirect to AllBlogs]
     */
    public function destroy(Request $request,  $id)
    {
        try {
            $blog = Blog::find($id);
            if (!$blog) {
                return redirect()->route('blog.index')->with('error', 'Can`t Find Blog ');
            }
            //check for authorization of blog
            if (auth()->user()->role !== 'admin' && auth()->user()->id !== $blog->user_id) {
                return response()->json(['success' => false, 'message' => 'Unauthenticated!']);
            }

            //Get a Images of Description and Delete it
            $blogImages = BlogImage::where('blog_id', $blog->id);
            //Delete Images from Blog-post-image folder
            $images = $blogImages->pluck('image')->toArray();
            BlogHelper::deleteImages($images, $blog->id);
            $blogImages->whereIn('image', $images)->delete();

            $blog->category()->detach(); //delete Records of Blog From Bridge table
            Helpers::deleteOneImage('blog-cover-images', $blog->image); //blog-cover-images

            $blog->delete();
            return response()->json(['success' => true, 'message' => 'Record Deleted Successfully !!']);
        } catch (\Throwable $th) {
            return redirect()->route('blog.index')->with('error', 'something went wrong please try again');
            // throw $th;
        }
    }

    /**
     * [status PATCH  update Blog Status]
     * @return [JSON] [Returns Redirect to AllBlogs]
     */
    public function status(Request $request, $id)
    {
        $model = Blog::find($id);
        $model->status == '1' ? $model->status = '0' : $model->status = '1';
        $model->save();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Blog Status Changed!!']);
        }
        return redirect()->back();
    }

    /**
     * [blogSlugCheck POST Check Slug ]
     * @return [JSON] [Returns Slug Taken Or Not]
     */
    public function blogSlugCheck(Request $request)
    {
        $request->validate([
            'slug' => 'required|max:200',
        ]);
        $slug = Str::slug($request->input('slug'));
        $data = Blog::where('slug', $slug);

        if ($request->id) {
            $data = $data->where('id', '!=', $request->id);
        }
        $data = $data->get();
        if (count($data) > 0) {
            return response()->json(['success' => false,  'message' => 'This Slug is Already Taken !!', 'slug' => $slug]);
        }
        return response()->json(['success' => true, 'message' => 'This Slug is Available', 'slug' => $slug]);
    }


    /**
     * [checkDescription POST UploadImage ]
     * @return [JSON] [Returns Image URL]
     */
    public function checkDescription(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $request->validate([
            'file' => 'required|max:2048',
        ]);
        $url = BlogHelper::saveTempImages($request);
        return response()->json(['success' => true,  'url' => $url]);
    }
}
