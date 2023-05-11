<?php

use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


//Used For Update a Img tag inside Blog Description
function descriptionCheckImage($data)
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


//For Move a Multiple Blog Images
function moveImages($ImageArray, $id)
{
    if (!empty($ImageArray)) {
        foreach ($ImageArray as  $image) {
            Storage::disk('public_uploads')->move("temp-blog-images/$image", "blog-post-images/$image");
            BlogImage::create(['blog_id' => $id, 'image' => $image]);
        }
    }
}

//For Delete a Multiple Blog Images
function deleteImages($array)
{
    if (!empty($array)) {
        foreach ($array as $image) {
            if (file_exists(public_path("blog-post-images/$image"))) {
                unlink(public_path("blog-post-images/$image"));
            }
        }
    }
}


// For Save Image
function saveOneImage($path, $saveImg)
{
    if ($saveImg) {
        $myImage = time() . '.' . $saveImg->extension();
        $saveImg->move(public_path($path), $myImage);
        return  $myImage;
    }
}

// For Delete Image
function deleteOneImage($path, $deleteImg)
{
    if ($deleteImg) {
        if (file_exists(public_path("$path/$deleteImg"))) {
            unlink(public_path("$path/$deleteImg"));
        }
    }
}


// Get Statistics for dashboard
function getStatistics()
{
    $statistics = [];
    $statistics['totalblogs'] = count(Blog::all());
    $statistics['totalusers'] = count(User::all());
    $statistics['totalcategories'] = count(Category::all());

    return $statistics;
}



//Get Blogs for AJAX Request
function getBlogs($request)
{
    if (auth()->user()->role == 'user') {
        $blogs = Blog::where('user_id', auth()->user()->id);
    } else {
        // $blogs =   Blog::where('id', '>' , '0');
        $blogs =   Blog::where('status', '0');
    }

    $sort_by = $request->get('sortby');
    $sort_type = $request->get('sorttype');
    $query = $request->get('query');
    $query = str_replace(" ", "%", $query);

    if ($query != '') {
        $blogs =   $blogs->where('id', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->orWhere('slug', 'like', '%' . $query . '%')
            ->orWhere('status', 'like', '%' . $query . '%');
    }

    $blogs =   $blogs->orderBy($sort_by, $sort_type)->paginate(3);
    return $blogs;
}





//For Blog View Count
function blogViewed($request, $blog)
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


// Save Profile Picture convet base64 to png and save to database
function  saveProfilePic($user, $imageData)
{
    $base64_image = $imageData;
    $base64_image = str_replace('data:image/png;base64,', '', $base64_image);
    // Decode the base64 data
    $image_data = base64_decode($base64_image);
    $file_name =   $user->id . "_" . time() . '.png';
    $imageStored = Storage::disk('public_uploads')->put('profile-images/' . $file_name, $image_data);

    if ($imageStored) {
        return $file_name;
    } else {
        return false;
    }
}

//For Homepage //returns a recent blog  categories  and popular categories
function homepageData()
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

    return  ['recentblogs' => $recentBlogs, 'categories' => $categories, 'popularcat' => $popular];
}
