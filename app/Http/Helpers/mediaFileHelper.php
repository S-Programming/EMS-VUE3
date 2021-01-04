<?php

use App\Http\Models\MediaFile;

if (!function_exists('uploadFile')) {

    function uploadFile($request, $fileData)
    {
        try {
            $type = isset($fileData['type']) ? $fileData['type'] : '';
            $fileId = isset($fileData['file_id']) ? intval($fileData['file_id']) : 0;
            $fileArr = [];
            $userId = Auth::user()->id;
            if ($request->hasFile($type . 'file')) {
                if ($fileId > 0) {
                    $fileArr = Files::where('id', '=', $fileId)->first();
                }
                $file = $request->file($type . 'file');
                $name = $type . rand(11111, 99999) . '_' . $file->getClientOriginalName();
                $fileSize = $file->getSize();
                $dirName = date('Y') . '/' . date('m');
                $moveFileDir = config('app.file_path') . $dirName;
                $viewFileDir = config('app.view_file_path') . $dirName;
                $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $viewFileDir;
                if (!is_dir($targetFolder)) {
                    mkdir($targetFolder, 0777, true);
                }
                $request->file($type . 'file')->move($moveFileDir, $name);
                if (is_null($fileArr) || count($fileArr) == 0) {
                    $fileArr = new Files();
                } else {
                    deleteFile($fileArr);
                }

                $request['name'] = $name;
                $request['file_size'] = $fileSize;
                $request['file_path'] = $dirName . '/' . $name;
                $request['created_by'] = $userId;
                saveFile($request, $fileArr);
            } else if (isset($request['custom_file_url']) && $request['custom_file_url'] != '' && $fileId == 0) {

                $fileArr = new Files();
                $request['created_by'] = $userId;
                unset($request['file_path']);
                saveFile($request, $fileArr);
            } else {
                $fileArr = Files::where('id', '=', $fileId)->first();
                unset($request['file_path']);
                saveFile($request, $fileArr);
            }
            activityLog(45, $fileArr->id, $userId);
            $fileArr->file_path = (isset($fileArr->file_path) && $fileArr->file_path != '' && fileExists(config('app.image_path') . $fileArr->file_path)) ? URL::to(config('app.file_path') . $fileArr->file_path) : URL::to(config('app.file_path') . 'placeholder.png');
            return array('status_code' => 200, 'message' => 'success', 'file' => $fileArr);
        } catch (Illuminate\Filesystem\FileNotFoundException $e) {
            failureLog('save' . ucfirst(substr($type, 0, -1)), $e->getMessage());
            return array('status_code' => 400, 'message' => ucfirst(substr($type, 0, -1)) . ' saved successfully, But File fails to upload');
        }
    }
}

if (!function_exists('saveFile')) {

    function saveFile($request, $fileArr)
    {

        if (isset($request) && count($request) > 0) {

            $count = 0;
            if (isset($request['file_title']) && !empty($request['file_title'])) {

                $fileArr->title = $request['file_title'];
                $count++;
            }

            if (isset($request['name']) && !empty($request['name'])) {

                $fileArr->name = $request['name'];
                $count++;
            }

            if (isset($request['file_desc']) && !empty($request['file_desc'])) {

                $fileArr->description = $request['file_desc'];
                $count++;
            }

            if (isset($request['file_size']) && !empty($request['file_size'])) {

                $fileArr->file_size = $request['file_size'];
                $count++;
            }

            if (isset($request['file_path']) && !empty($request['file_path'])) {

                $filePath = str_replace(['https://api.TheErrandApp.com/uploads/', 'http://api.TheErrandApp.com/uploads/', 'https://stage.TheErrandApp.com/uploads/', 'http://stage.TheErrandApp.com/uploads/'], '', $request['file_path']);
                $fileArr->file_path = $filePath;
                $fileArr->custom_file_url = '';
                $count++;
            }

            if (isset($request['artist_name']) && !empty($request['artist_name'])) {

                $fileArr->artist_name = $request['artist_name'];
                $count++;
            }

            if (isset($request['album']) && !empty($request['album'])) {

                $fileArr->album = $request['album'];
                $count++;
            }

            if (isset($request['caption']) && !empty($request['caption'])) {

                $fileArr->caption = $request['caption'];
                $count++;
            }

            if (isset($request['type']) && !empty($request['type'])) {

                $fileArr->type = $request['type'];
                $count++;
            } else {

                $fileArr->type = 'audio';
                $count++;
            }

            if (isset($request['created_by']) && !empty($request['created_by'])) {

                $fileArr->created_by = $request['created_by'];
                $count++;
            }

            if (isset($request['custom_file_url']) && !empty($request['custom_file_url'])) {

                $fileArr->custom_file_url = $request['custom_file_url'];
                deleteFile($fileArr);
                $fileArr->name = $request['custom_file_url'];
                $fileArr->file_size = '';
                $fileArr->file_path = '';
                $count++;
            }

            if ($count > 0) {

                $fileArr->save();
            }
            return $fileArr;
        }
        return [];
    }
}

if (!function_exists('deleteFile')) {

    function deleteFile($fileArr)
    {
        if (isset($fileArr->file_path) && $fileArr->file_path != '') {
            $oldFileFullPath = config('app.file_path') . $fileArr->file_path;
            if (fileExists($oldFileFullPath)) {
                unlink($oldFileFullPath);
            }
        }
        return true;
    }
}
