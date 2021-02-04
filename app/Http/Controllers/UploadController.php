<?php

namespace App\Http\Controllers;

use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Image;
use Storage;
use Auth;
use App\Models\User;

class UploadController extends Controller
{

    /**
     * Retrieves and return the image
     *
     * @param  $imageId  this id is the image filename with extension
     * @return \Intervention\Image\Illuminate\Http\Response
     */
    public function loadImage($category, $imageId)
    {
        /**
         * undocumented constant
         **/
       // dd(12 );
        // Filepond uses an XHR call to load the image. Not sure why it has to do that but hopefully we can change that behavoir in the future
        // Because it's XHR we cannot just redirect to the CDN because of CORS. So here, we just load the image from CDN and serve.

        // Floor-layout view also will use this call because it also loads the image via XHR call.

        $domain = url('/');
        $folder = "";
        switch ($category) {
            case 'profile':
                //$folder = 'images/vendors/products';
                $folder = Config::get('constants.images.profile');
                break;
        }
        try {
            $remoteFile = $domain . '/' . $folder . '/' . $imageId;
            $path=Storage::get("$folder/$imageId");
            $response = Response::make($path);
            return $response->header('Content-Type', 'image/*');
            return $remoteFile;
            // $cURL = curl_init($remoteFile);
            // curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
            // curl_exec($cURL);
            // $curl_info = curl_getinfo($cURL, CURLINFO_CONTENT_TYPE);
            // $curl_size = curl_getinfo($cURL, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
            // header('Content-type:' . $curl_info);
            // header('Content-Length:' . $curl_size);
            // $myInputStream = fopen($remoteFile, 'rb');
            // $myOutputStream = fopen('php://output', 'wb');
            // stream_copy_to_stream($myInputStream, $myOutputStream);
            // fclose($myOutputStream);
            // fclose($myInputStream);

        } catch (\Exception $e) {
            Log::info("Call to API to load image failed to fetch from cloud: " . $imageId);
            abort(404);
        }
    }

    /**
     * Uploads the event image to the images directory. If
     * the image is uploaded and resized successfully, the image filename
     * (with extension) is returned.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request,$userId=0)
    {
        // dd('test');
        // dd($user_id);
        // dd($request->all(),$user_id);
        $imageFile='image_file';
        if ($request->hasFile($imageFile)) {
            if ($request->file($imageFile)->isValid()) {
                $imageFile = $request->file($imageFile);
                $fileToStore = $imageFile->store(Config::get('constants.images.profile'));
                //dd($imageFile);
                $imagePath = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($fileToStore);
                $imageToResize = Image::make($imagePath)->orientate()->encode();
                Storage::put($fileToStore, $imageToResize);
               //d(basename($fileToStore),$userId);

                // validate here user id present or not 
                if(isset($userId) && !empty($userId))
                {
                    $user = User::find($userId);
                    $user->image_path = basename($fileToStore);
                    $user->save();
                }
                
                return response()->json(basename($fileToStore));
            }
            // $user = user::all();
            // dd($user);
                // $user->image_path = basename($fileToStore);
                // $user->save();
            return Response::make('The uploaded image is not a valid file.', 400);
        }
        

        return Response::make('The uploaded image is missing.', 400);
    }
}
