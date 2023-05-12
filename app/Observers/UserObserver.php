<?php

namespace App\Observers;

use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // dd($user);

    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {

        $blogs =  Blog::where('user_id', $user->id)->get();
        foreach ($blogs as $blog) {

            deleteOneImage('blog-cover-images' ,$blog->image); //blog-cover-images
            //Get a Images of Description and Delete it
            $blogImages = BlogImage::where('blog_id', $blog->id);
            $images = $blogImages->pluck('image')->toArray();
            deleteImages($images, $blog->id);
            $blogImages->delete();
            $blog->delete();
        }

        Log::info("This user $user->name , and their blogs Deleted.");
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
