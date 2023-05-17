<?php

use App\Models\BlogImage;
use Illuminate\Support\Facades\Storage;

class BlogHelpers extends Helpers
{
    //upload images of blog
    public static function descriptionCheckImage($data)
    {
        $dom = new \DomDocument();
        @$dom->loadHtml($data, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');
        $ImgNames = [];
        foreach ($imageFile as  $imageTag) {
            $path =  explode("/", $imageTag->getAttribute('src'));
            if ($path[0] !== 'http' || $path[0] !== 'https') {
                $image = $path[count($path) - 1];
                $url  = url('/blog-post-images/' . $image);
                $imageTag->setAttribute('src', $url);
                array_push($ImgNames, $image);
            }
        }
        $result = [];
        $result['ImgNames'] = $ImgNames;
        $result['description'] = $dom->saveHTML();
        return $result;
    }


    //move images of blog
    public static  function moveImages($ImageArray, $id)
    {
        if (!empty($ImageArray)) {
            foreach ($ImageArray as  $image) {
                Storage::disk('public_uploads')->move("temp-blog-images/$image", "blog-post-images/$image");
                BlogImage::create(['blog_id' => $id, 'image' => $image]);
            }
        }
    }

    //delete images of blog
    public static function deleteImages($array)
    {
        if (!empty($array)) {
            foreach ($array as $image) {
                if (file_exists(public_path("blog-post-images/$image"))) {
                    unlink(public_path("blog-post-images/$image"));
                }
            }
        }
    }

    //get blogs for index page
    public static function getBlogs($request, $blogs)
    {
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $blogs =  $blogs->where(function ($q) use ($query) {
            $q->where('id', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orWhere('slug', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%');
        })->orderBy($sort_by, $sort_type)->paginate(3);
        return $blogs;
    }



    //For Blog View Count
    public static function blogViewed($request, $blog)
    {
        $viewed = $request->session()->get('viewed_post', []);
        if (auth()->user()) {
            if (!in_array($blog->id, $viewed) && $blog->user_id != auth()->user()->id) {
                $blog->incrementViews();
                $request->session()->push('viewed_post', $blog->id);
            }
        } else {
            if (!in_array($blog->id, $viewed)) {
                $blog->incrementViews();
                $request->session()->push('viewed_post', $blog->id);
            }
        }
    }

    //for save a image in temp folder
    public static function saveTempImages($request)
    {
        $data = $request->all();
        $myImage = time() . '.' . $data['file']->extension();
        $request->file->move(public_path('temp-blog-images/'), $myImage);
        $url  = url('/temp-blog-images/' . $myImage);
        return $url;
    }
}
