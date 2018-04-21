<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;

abstract class Job
{
    /*
    |--------------------------------------------------------------------------
    | Queueable Jobs
    |--------------------------------------------------------------------------
    |
    | This job base class provides a central location to place any logic that
    | is shared across all of your jobs. The trait included with the class
    | provides access to the "onQueue" and "delay" queue helper methods.
    |
    */

    use Queueable;

    public function setImage($file, $path)
    {
        $path = 'uploads/images/' . $path . '/';
        $destinationPath = public_path($path);
        $imageName = $file->getClientOriginalName();
        $name = date('Y_m_d_H_i_s') . '_' . str_slug(pathinfo($imageName, PATHINFO_FILENAME));
        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
        $fileName = $name.'.'.$ext;
        $file->move($destinationPath , $fileName);
        return $path . $fileName;
    }

    public function destroyImage($oldImage)
    {
        $destinationPath = public_path($oldImage);
        if ( \File::isFile($destinationPath) ) {
            \File::delete($destinationPath);
        }
    }
}
