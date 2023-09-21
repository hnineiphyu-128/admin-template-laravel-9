<?php

namespace App\Traits;

use Storage;
use File;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

trait ImageTrait
{

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function getImageName($fileName)
    {
        $array  = explode('/', $fileName);
        return $array[count($array)-1];
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function moveImage($fileName, $path, $type, $model)
    {
        try {
            $newPath = '';
            $imagePath = '';
            if ($fileName) {
                $oldPath = 'uploads/temp/'.$model.'/'. Auth::id() .'/'.$fileName;
                $newPath = public_path($path.$type);
                    if (!File::isDirectory($newPath)) {
                        File::makeDirectory($newPath, 0777, true, true);
                    }

                    // Move the file to the destination directory
                    File::copy($oldPath, $newPath.'/'.$fileName);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                    $imagePath = '/'.$path.$type.'/'.$fileName;
            }
            return $imagePath;
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return array
     */
    public static function moveImages($fileNames, $path, $type, $model)
    {
        try {
            $newPath = '';
            $imagePaths = [];
            if ($fileNames) {
                foreach ($fileNames as $key => $fileName) {
                    $oldPath = 'uploads/temp/'.$model.'/'. Auth::id() .'/'.$fileName;
                    $newPath = public_path($path.$type);
                        if (!File::isDirectory($newPath)) {
                            File::makeDirectory($newPath, 0777, true, true);
                        }

                        // Move the file to the destination directory
                        File::copy($oldPath, $newPath.'/'.$fileName);
                        if (File::exists($oldPath)) {
                            File::delete($oldPath);
                        }
                        array_push($imagePaths, '/'.$path.$type.'/'.$fileName);
                }
            }
            return $imagePaths;
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function makeImage($file, $path)
    {
        try {
            $fileName = '';
            if (! empty($file)) {
                $extension = $file->getClientOriginalExtension(); // getting image extension
                if (! in_array(strtolower($extension), ['jpg', 'gif', 'png', 'jpeg'])) {
                    return redirect()->back()->with('fail','Invalid image');
                }
                $date = Carbon::now()->format('Y-m-d');
                $fileName = $path.$date.'_'.uniqid().'.'.$extension;
                Storage::disk('public')->put($fileName,file_get_contents($file));
            }

            return $fileName;
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function makeImageFromTextEditor($model, $files, $path ,$column_name)
    {
        try {
            $fileName = '';
            if (! empty($files)) {
                // Get the contents of the Summernote textarea
                $content =  $files;
                // Parse the HTML with DOMDocument
                $dom = new \DOMDocument();
                $dom->loadHTML($content);
                // Find all image elements and save them
                $images = $dom->getElementsByTagName('img');
                foreach ($images as $key=>$image)
                {
                    $src = $image->getAttribute('src');
                    // list($type, $src) = explode(';', $src);
                    // list(, $extension) = explode('/', $type);
                    $fileName = time().$key.'.jpg';
                    $filePath = $path.$fileName;

                    // Get the image data from the data URI
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $src));
                    // Create a temporary file to save the image
                    $tempFile = tempnam(sys_get_temp_dir(), 'image_');
                    file_put_contents($tempFile, $imageData);

                    // Use Laravel's file handling functions to move the file to its final destination
                    Storage::disk('public')->putFileAs($path, new \Illuminate\Http\File($tempFile), $fileName);

                    // Delete the temporary file
                    unlink($tempFile);

                    $model->files()->create([
                        'file_url'=>$filePath,
                        'column_name'=>$column_name,
                    ]);
                }
            }

            return $fileName;
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function makeImageFromBase64($file, $path ,$img_id)
    {

        try {
            $fileName = '';
            if (! empty($file)) {

                $fileName = $img_id.time().'.jpg';
                $filePath = $path.$fileName;

                // Get the image data from the data URI
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));

                // Create a temporary file to save the image
                $tempFile = tempnam(sys_get_temp_dir(), 'image_');
                file_put_contents($tempFile, $imageData);

                // Use Laravel's file handling functions to move the file to its final destination
                Storage::disk('public')->putFileAs($path, new \Illuminate\Http\File($tempFile), $fileName);

                // Delete the temporary file
                unlink($tempFile);

            }

            return $filePath;
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function makeImageFromURL($file, $path ,$img_id)
    {

        try {
            $fileName = '';
            if (! empty($file)) {

                $imageData = file_get_contents($file);
                $filePath = $path.$img_id.time().'.jpg';
                Storage::disk('public')->put($filePath,$imageData);
            }

            return $filePath;
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * @param  UploadedFile  $file
     * @param  string  $path
     *
     * @param  null  $disk
     * @return string
     */
    public static function makeAttachment($file, $path)
    {
        try {
            $fileName = '';
            if (! empty($file)) {
                $extension = $file->getClientOriginalExtension();
                if (! in_array(strtolower($extension), ['pdf', 'doc', 'docx', 'txt','jpg', 'gif', 'png', 'jpeg'])) {
                    return redirect()->back()->with('fail','Invalid file');
                }
                $date = Carbon::now()->format('Y-m-d');
                $fileName = $path.$date.'_'.uniqid().'.'.$extension;
                Storage::disk('public')->put($fileName,file_get_contents($file));
            }

            return $fileName;
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * @param string $file
     * @return bool
     */
    public static function deleteImage($file)
    {
        if (Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);

            return true;
        }
        return false;
    }

    /**
     * @param  UploadedFile  $file
     * @param  string  $path
     *
     * @param  null  $disk
     * @return string
     */
    public static function makeAttachmentSEO($file, $path)
    {

        try {
            $fileName = '';
            if (! empty($file)) {
                $fileName = $file->getClientOriginalName();
                Storage::disk('main')->put($fileName,file_get_contents($file));
            }

            return $fileName;
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * @param string $file
     * @return bool
     */
    public static function deleteFileSEO($file)
    {
        if (Storage::disk('main')->exists($file)) {
            Storage::disk('main')->delete($file);

            return true;
        }
        return false;
    }
}
