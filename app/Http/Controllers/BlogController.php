<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
                $blogs = Blog::paginate(3);
            } else {
                $blogs = Blog::where('user_id', auth()->user()->id)->paginate(3);
            }

            if ($request->ajax()) {
                $sort_by = $request->get('sortby');
                $sort_type = $request->get('sorttype');
                $query = $request->get('query');
                $query = str_replace(" ", "%", $query);

                $blogs =   $blogs->where('id', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->orWhere('slug', 'like', '%' . $query . '%');

                $blogs =   $blogs->orderBy($sort_by, $sort_type)->paginate(3);
                return view('backend.blog.table', compact('blogs'));
            }

            return view('backend.blog.index', ['blogs' => $blogs]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'something went wrong');
            // throw $th;
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
            $categories = Category::where('status', 1)->get();
            if (count($categories) > 0) {
                return view('backend.blog.create', ['categories' => $categories]);
            }
            return redirect()->route('dashboard')->with('error', "Don't Have any Active Category");
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'something went wrong');
            // throw $th;
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
            $data['image'] = saveOneImage('blog-cover-images', $request->image); //blog-cover-images
            $data['user_id'] = auth()->user()->id;

            $result = descriptionCheckImage($data['description']); //this function return array of images and html for description

            $data['description'] =  $result['description'];
            $blog =  Blog::create($data);
            $blog->category()->attach($request->input('categories'));

            $result = moveImages($result['ImgNames'], $blog->id);  //Move Images to Blog-post-image folder

            if ($blog) {
                return redirect()->route('blog.index')->with(['message' => 'Blog Created Successfully']);
            } else {
                return redirect()->route('blog.index')->with('error', "Can't Create Blog Now ");
            }
        } catch (\Throwable $th) {
            return redirect()->route('blog.index')->with('error', 'something went wrong');
            // throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            throw $th;
            return redirect()->route('blog.index')->with('error', 'something went wrong');
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

            if (!$blog) {
                return redirect()->route('blog.index')->with('error', 'Can`t Find Blog ');
            }


            if (auth()->user()->role !== 'admin' && auth()->user()->id !== $blog->user_id) {
                return redirect()->route('blog.index')->with('error', 'unauthorized.');
            }


            $data = $request->all();
            $result = descriptionCheckImage($data['description']); //this function return array of images and html for description
            $data['slug'] =  Str::slug($data['slug']);
            $data['description'] =  $result['description'];
            $blog->category()->sync($data['categories']);

            $query = BlogImage::where('blog_id', $blog->id);
            $images = $query->pluck('image')->toArray();
            $selected_images = $result['ImgNames'];

            //Add image from db and storage
            $add_image = array_diff($selected_images, $images); //add to db
            moveImages($add_image, $blog->id);  //Move Images to Blog-post-image folder

            //remove image from db and storage
            $remove_image =  array_diff($images, $selected_images); //remove from db
            deleteImages($remove_image, $blog->id);  //Move Images to Blog-post-image folder
            $query->whereIn('image', $remove_image)->delete();

            if ($request->image) {
                deleteOneImage('blog-cover-images', $blog->image); //blog-cover-images
                $data['image'] =  saveOneImage('blog-cover-images', $request->image); //blog-cover-images
            }

            $result =  $blog->update($data);
            if ($result) {
                return redirect()->route('blog.index')->with('message', 'Blog Updated Successfully');
            } else {
                return redirect()->route('blog.index')->with('error', 'Can`t Update Blog Now ');
            }
        } catch (\Throwable $th) {
            return redirect()->route('blog.index')->with('error', 'something went wrong');
            // throw $th;
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

            if (auth()->user()->role === 'admin' || auth()->user()->id === $blog->user_id) {

                //Get a Images of Description and Delete it
                $blogImages = BlogImage::where('blog_id', $blog->id);
                $images = $blogImages->pluck('image')->toArray();
                deleteImages($images, $blog->id);  //Delete Images to Blog-post-image folder
                $blogImages->whereIn('image', $images)->delete();

                $blog->category()->detach(); //delete Records of Blog From Bridge table

                deleteOneImage('blog-cover-images', $blog->image); //blog-cover-images

                $delete = $blog->delete();
                if ($delete && $request->ajax()) {
                    return response()->json(['success' => true, 'message' => 'Record Deleted Successfully !!']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Failed to Delete !!']);
                }
            } else {
                return redirect()->route('blog.index')->with('error', 'Unauthenticated.');
            }
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('blog.index')->with('error', 'something went wrong');
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
     * [checkDescription POST Uploadimage ]
     * @return [JSON] [Returns Image URL]
     */
    public function checkDescription(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        $data = $request->all();
        $myimage = time() . '.' . $data['file']->extension();
        $request->file->move(public_path('temp-blog-images/'), $myimage);
        $url  = url('/temp-blog-images/' . $myimage);

        if ($request->ajax()) {
            return response()->json(['success' => true,  'url' => $url]);
        }
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
