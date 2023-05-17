
<?php

use Illuminate\Support\Facades\Storage;


class UserHelpers extends Helpers
{

    public static function saveProfilePic($user, $imageData)
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
}

?>
