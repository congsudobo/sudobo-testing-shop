<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait StorageTrait {

    /**
     * Execute deleteing file.
     *
     * @param   String $path
     * @return Bool
     */
    private function deleteFile($path){

        if(Storage::disk('public')->exists($path)) {
            if(!Storage::disk('public')->delete($path)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Execute move file.
     *
     * @param   String $currentPath, $movePath, $fileName
     * @return Bool
     */
    private function moveFile($currentFilePath, $moveFilePath)
    {
        $isComplete = false;

        if($currentFilePath == $moveFilePath) {
            return true;
        }

        if(Storage::disk('public')->exists($currentFilePath)) {
            if(!Storage::disk('public')->exists(dirname($moveFilePath))) {
                $this->createDir(dirname($moveFilePath));
            }

            if(Storage::disk('public')->exists($moveFilePath)) {
                Storage::disk('public')->delete($moveFilePath);
            }

            $isComplete = Storage::disk('public')->move($currentFilePath, $moveFilePath);
        }

        return $isComplete;
     }

    private function createDir($dir)
    {
        if(!is_dir($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }
    }

    /* Execute upload file.
     *
     * @param object $file
     * @return string
     */
    function uploadFile($file, $path)
    {
        $file->store($path, 'public');
        $fileName = $file->hashName();

        return $fileName;
    }
}
