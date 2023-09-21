<?php

namespace App\Helpers;

use Carbon\Carbon;
use File;


class common
{
    /**
     * Model Common find method
     */
    public static function find($type,$type_id)
    {
        return $type::find($type_id);
    }

    /**
     * set name mm as name en
     * @param Illuminate\Http\Request $request
     */
    static public function setNameMM($request)
    {
        if (empty($request['name_mm'])) {
            $request['name_mm'] = $request['name_en'];
        }
        return $request;
    }

    /**
     * set name mm as name en
     * @param Illuminate\Http\Request $request
     */
    static public function getImageSrc($path)
    {
        $src = '/default_image.png';
        if ($path && str_contains($path, '/')) {
            if(file_exists(explode('/', $path, 2)[1])) {
                $src = $path;
            }
        }
        return $src;
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function storeMedia($path, $file)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $extension = $file->getClientOriginalExtension(); // getting image extension
        $name = Carbon::now()->format('Ymd').uniqid().'.'.$extension;

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function removeMedia($model, $model_id, $type, $fileName)
    {
        // dd($model::IMAGE_PATH.$type.'/'.$fileName, File::exists($model::IMAGE_PATH.$type.'/'.$fileName));
        if (File::exists($model::IMAGE_PATH.$type.'/'.$fileName)) {
            File::delete($model::IMAGE_PATH.$type.'/'.$fileName);
        }

        $modelObject = $model::find($model_id);
        //'/user-avatar.png'
        $modelObject->$type = NULL;
        $modelObject->save();

        return response()->json(['message' => 'success']);
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function removeMediaTwoModels($parent_model, $parent_model_id, $type, $child_model, $child_model_column_name, $fileName)
    {
        if (File::exists($parent_model::IMAGE_PATH.$type.'/'.$fileName)) {
            File::delete($parent_model::IMAGE_PATH.$type.'/'.$fileName);
        }

        $child_model::where($child_model_column_name, $parent_model_id)->where('path', '/'.$parent_model::IMAGE_PATH.$type.'/'.$fileName)->forceDelete();

        return response()->json(['message' => 'success']);
    }
    public static function getMorph($model,$type,$type_id)
    {
        return $model::where('type',$type)->where('type_id',$type_id)->latest()->get();
    }
}
